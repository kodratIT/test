<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DaftarPengajuanController extends Controller
{
    // Menampilkan halaman blade
    public function index()
    {
        return view('pengajuan.index'); // sesuaikan dengan nama blade kamu
    }

    // Mengambil data pengajuan untuk AJAX dengan filtering, search, dan pagination
    public function list(Request $request)
    {
        try {
            // Ambil id pengguna yang sedang login
            $userId = Auth::id();

            // Mulai query builder
            $query = Pengajuan::where('pengguna_id', $userId);

            // Search berdasarkan nomor pengajuan
            if ($request->filled('search')) {
                $searchTerm = $request->search;
                $query->where('no_pengajuan', 'LIKE', '%' . $searchTerm . '%');
            }

            // Filter berdasarkan status
            if ($request->filled('status')) {
                $status = $request->status;
                $query->whereRaw('LOWER(TRIM(status)) = ?', [strtolower($status)]);
            }

            // Filter berdasarkan tanggal
            if ($request->filled('date_filter')) {
                $dateFilter = $request->date_filter;
                $now = Carbon::now();

                switch ($dateFilter) {
                    case 'today':
                        $query->whereDate('created_at', $now->toDateString());
                        break;
                    case 'week':
                        $query->whereBetween('created_at', [
                            $now->startOfWeek()->toDateTimeString(),
                            $now->endOfWeek()->toDateTimeString()
                        ]);
                        break;
                    case 'month':
                        $query->whereMonth('created_at', $now->month)
                              ->whereYear('created_at', $now->year);
                        break;
                    case 'year':
                        $query->whereYear('created_at', $now->year);
                        break;
                }
            }

            // Ordering
            $query->orderBy('created_at', 'desc');

            // Pagination
            $perPage = $request->input('per_page', 10);
            $page = $request->input('page', 1);

            // Get total count before pagination
            $total = $query->count();

            // Apply pagination
            $pengajuan = $query->offset(($page - 1) * $perPage)
                              ->limit($perPage)
                              ->get();

            // Tambahkan URL signed untuk setiap pengajuan
            $pengajuan->transform(function ($item) {
                $status = trim($item->status);

                if (strcasecmp($status, 'ditolak') === 0 || strcasecmp($status, 'perbaikan') === 0) {
                    $item->action_link = URL::signedRoute('laporanperbaikan.perbaiki', ['id' => $item->id]);
                    $item->action_text = 'Perbaiki';
                } elseif (strcasecmp($status, 'disetujui') === 0) {
                    $item->action_link = URL::signedRoute('lembarpengesahanuser.lihat', ['id' => $item->id]);
                    $item->action_text = 'Lihat';
                } else {
                    $item->action_link = '';
                    $item->action_text = '';
                }

                return $item;
            });

            // Prepare pagination info
            $lastPage = ceil($total / $perPage);
            $from = (($page - 1) * $perPage) + 1;
            $to = min($page * $perPage, $total);

            // Response format
            $response = [
                'data' => $pengajuan,
                'pagination' => [
                    'current_page' => (int) $page,
                    'per_page' => (int) $perPage,
                    'total' => $total,
                    'last_page' => $lastPage,
                    'from' => $from,
                    'to' => $to
                ],
                'filters_applied' => [
                    'search' => $request->search ?? '',
                    'status' => $request->status ?? '',
                    'date_filter' => $request->date_filter ?? ''
                ]
            ];

            return response()->json($response);

        } catch (\Exception $e) {
            \Log::error('Error in DaftarPengajuanController@list: ' . $e->getMessage());
            
            return response()->json([
                'message' => 'Terjadi kesalahan saat mengambil data pengajuan',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Menampilkan detail pengajuan
    public function detail($id)
    {
        try {
            $userId = Auth::id();
            $pengajuan = Pengajuan::where('id', $id)
                                ->where('pengguna_id', $userId)
                                ->firstOrFail();
            
            return view('pengajuan.detail', compact('pengajuan'));
        } catch (\Exception $e) {
            return redirect()->route('daftarpengajuanpengguna')
                           ->with('error', 'Pengajuan tidak ditemukan.');
        }
    }

    // Menampilkan form edit pengajuan
    public function edit($id)
    {
        try {
            $userId = Auth::id();
            $pengajuan = Pengajuan::where('id', $id)
                                ->where('pengguna_id', $userId)
                                ->firstOrFail();
            
            // Cek apakah pengajuan bisa diedit (tidak boleh edit jika sudah disetujui atau ditolak)
            $status = strtolower(trim($pengajuan->status));
            if (in_array($status, ['disetujui', 'ditolak'])) {
                return redirect()->route('daftarpengajuanpengguna')
                               ->with('error', 'Pengajuan dengan status "' . ucfirst($status) . '" tidak dapat diedit.');
            }
            
            return view('pengajuan.edit', compact('pengajuan'));
        } catch (\Exception $e) {
            return redirect()->route('daftarpengajuanpengguna')
                           ->with('error', 'Pengajuan tidak ditemukan.');
        }
    }

    // Update pengajuan
    public function update(Request $request, $id)
    {
        try {
            $userId = Auth::id();
            $pengajuan = Pengajuan::where('id', $id)
                                ->where('pengguna_id', $userId)
                                ->firstOrFail();
            
            // Cek apakah pengajuan bisa diupdate
            $status = strtolower(trim($pengajuan->status));
            if (in_array($status, ['disetujui', 'ditolak'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pengajuan dengan status "' . ucfirst($status) . '" tidak dapat diubah.'
                ], 403);
            }

            // Validasi data yang diperlukan
            $validatedData = $request->validate([
                // Data Izin Usaha
                'nomor_izin_usaha' => 'required|string|max:255',
                'tanggal_izin_usaha' => 'required|date',
                'masa_berlaku_izin_usaha' => 'required|date',
                'lampiran_izin_usaha' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
                
                // Data Izin Lingkungan
                'jenis_izin_lingkungan' => 'nullable|string|max:255',
                'nomor_izin_lingkungan' => 'nullable|string|max:255',
                'tanggal_izin_lingkungan' => 'nullable|date',
                'masa_berlaku_izin_lingkungan' => 'nullable|date',
                'lampiran_izin_lingkungan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
                
                // Data Kapasitas Listrik
                'kelebihan_listrik' => 'required|numeric|min:0',
                'sambunganListrik' => 'nullable|string|max:255',
                'lampiran_tagihan_listrik' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
                
                // Data SLO (nested array)
                'slo.nomor' => 'nullable|string|max:255',
                'slo.tanggal' => 'nullable|date',
                'slo.masa_berlaku' => 'nullable|date',
                'slo.penerbit' => 'nullable|string|max:255',
                'lampiran_slo' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
                
                // Data SKTTK (nested array)
                'skttk.nomor' => 'nullable|string|max:255',
                'skttk.tanggal' => 'nullable|date',
                'lampiran_skttk' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
                
                // Data Mesin (nested array)
                'mesin.jenis' => 'nullable|string|max:255',
                'mesin.kapasitas' => 'nullable|numeric|min:0',
                'mesin.merk' => 'nullable|string|max:255',
                'mesin.tahun' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
                'lampiran_nameplate_mesin' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
                
                // Data Generator (nested array)
                'generator.jenis' => 'nullable|string|max:255',
                'generator.kapasitas' => 'nullable|numeric|min:0',
                'generator.merk' => 'nullable|string|max:255',
                'generator.tegangan' => 'nullable|numeric|min:0',
                'lampiran_nameplate_generator' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
                
                // Checkbox dan catatan
                'checkbox' => 'nullable|boolean',
                'catatan' => 'nullable|string|max:1000',
            ]);

            // Handle file uploads
            $fileFields = [
                'lampiran_izin_usaha',
                'lampiran_izin_lingkungan',
                'lampiran_tagihan_listrik',
                'lampiran_slo',
                'lampiran_skttk',
                'lampiran_nameplate_mesin',
                'lampiran_nameplate_generator'
            ];

            foreach ($fileFields as $field) {
                if ($request->hasFile($field)) {
                    // Delete old file if exists
                    if ($pengajuan->$field && \Storage::exists('private/uploads/' . $pengajuan->$field)) {
                        \Storage::delete('private/uploads/' . $pengajuan->$field);
                    }
                    
                    // Store new file
                    $file = $request->file($field);
                    $filename = time() . '_' . $field . '_' . $file->getClientOriginalName();
                    $file->storeAs('private/uploads', $filename);
                    $validatedData[$field] = $filename;
                }
            }

            // Prepare data for update
            $updateData = [];
            
            // Basic fields
            $basicFields = [
                'nomor_izin_usaha', 'tanggal_izin_usaha', 'masa_berlaku_izin_usaha',
                'jenis_izin_lingkungan', 'nomor_izin_lingkungan', 'tanggal_izin_lingkungan', 'masa_berlaku_izin_lingkungan',
                'kelebihan_listrik', 'sambunganListrik', 'checkbox', 'catatan'
            ];
            
            foreach ($basicFields as $field) {
                if (isset($validatedData[$field])) {
                    $updateData[$field] = $validatedData[$field];
                }
            }
            
            // File fields
            foreach ($fileFields as $field) {
                if (isset($validatedData[$field])) {
                    $updateData[$field] = $validatedData[$field];
                }
            }
            
            // JSON fields (nested arrays)
            if (isset($validatedData['slo'])) {
                $updateData['slo'] = array_filter($validatedData['slo'], function($value) {
                    return !is_null($value) && $value !== '';
                });
            }
            
            if (isset($validatedData['skttk'])) {
                $updateData['skttk'] = array_filter($validatedData['skttk'], function($value) {
                    return !is_null($value) && $value !== '';
                });
            }
            
            if (isset($validatedData['mesin'])) {
                $updateData['mesin'] = array_filter($validatedData['mesin'], function($value) {
                    return !is_null($value) && $value !== '';
                });
            }
            
            if (isset($validatedData['generator'])) {
                $updateData['generator'] = array_filter($validatedData['generator'], function($value) {
                    return !is_null($value) && $value !== '';
                });
            }

            // Update data pengajuan
            $pengajuan->update($updateData);

            return response()->json([
                'success' => true,
                'message' => 'Pengajuan berhasil diperbarui.',
                'redirect' => route('daftarpengajuanpengguna')
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Error updating pengajuan: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui pengajuan.'
            ], 500);
        }
    }

    // Hapus pengajuan (hanya untuk draft)
    public function delete($id)
    {
        try {
            $userId = Auth::id();
            $pengajuan = Pengajuan::where('id', $id)
                                ->where('pengguna_id', $userId)
                                ->firstOrFail();
            
            // Hanya bisa hapus pengajuan dengan status draft
            $status = strtolower(trim($pengajuan->status));
            if ($status !== 'draft') {
                return response()->json([
                    'success' => false,
                    'message' => 'Hanya pengajuan dengan status "Draft" yang dapat dihapus.'
                ], 403);
            }

            // Hapus file lampiran jika ada
            $lampiranFields = [
                'lampiran_izin_usaha',
                'lampiran_izin_lingkungan', 
                'lampiran_tagihan_listrik',
                'lampiran_slo',
                'lampiran_skttk',
                'lampiran_nameplate_mesin',
                'lampiran_nameplate_generator'
            ];

            foreach ($lampiranFields as $field) {
                if ($pengajuan->$field && \Storage::exists('private/uploads/' . $pengajuan->$field)) {
                    \Storage::delete('private/uploads/' . $pengajuan->$field);
                }
            }

            $pengajuan->delete();

            return response()->json([
                'success' => true,
                'message' => 'Pengajuan berhasil dihapus.'
            ]);

        } catch (\Exception $e) {
            \Log::error('Error deleting pengajuan: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus pengajuan.'
            ], 500);
        }
    }

    // Download dokumen pengajuan
    public function download($id)
    {
        try {
            $userId = Auth::id();
            $pengajuan = Pengajuan::where('id', $id)
                                ->where('pengguna_id', $userId)
                                ->firstOrFail();
            
            // Generate PDF atau dokumen berdasarkan data pengajuan
            // Untuk sementara, redirect ke halaman detail dengan pesan
            return redirect()->route('pengajuan.detail', $id)
                           ->with('info', 'Fitur download dokumen akan segera tersedia.');
            
        } catch (\Exception $e) {
            return redirect()->route('daftarpengajuanpengguna')
                           ->with('error', 'Pengajuan tidak ditemukan.');
        }
    }
}
