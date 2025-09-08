<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\EvaluasiPengajuan;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class DaftarPengajuanController extends Controller
{
    // Menampilkan halaman blade
    public function index()
    {
        return view('daftarlaporanberkalapengguna'); // sesuaikan dengan nama blade kamu
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
                $status = strtolower($request->status);
                
                if ($status === 'proses evaluasi') {
                    // Gabungkan semua status yang masuk kategori "proses evaluasi"
                    $query->whereIn('status', [
                        'proses evaluasi', 'proses verifikasi', 'evaluasi', 
                        'menunggu evaluasi', 'proses pengesahan', 
                        'menunggu persetujuan kadis', 'validasi'
                    ]);
                } elseif ($status === 'perbaikan') {
                    // Gabungkan status yang masuk kategori "perbaikan"
                    $query->whereIn('status', ['perbaikan', 'perlu perbaikan', 'ditolak']);
                } elseif ($status === 'disetujui') {
                    // Status disetujui
                    $query->whereIn('status', ['disetujui', 'disetujui kadis']);
                } else {
                    // Fallback untuk status spesifik
                    $query->whereRaw('LOWER(TRIM(status)) = ?', [$status]);
                }
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
            
            // Ambil data evaluasi terbaru jika ada
            $latestEvaluation = null;
            if ($pengajuan->status == 'perbaikan') {
                $latestEvaluation = EvaluasiPengajuan::where('pengajuan_id', $id)
                                                   ->with('evaluator')
                                                   ->orderBy('created_at', 'desc')
                                                   ->first();
            }
            
            return view('pengajuan.edit', compact('pengajuan', 'latestEvaluation'));
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

            // Simplified validation that matches the actual form structure
            $request->validate([
                'nomor_izin_usaha' => 'nullable|string|max:255',
                'kelebihan_listrik' => 'nullable|string|max:255', // Changed from numeric to string
                'penjualan_listrik' => 'nullable|string|max:10',
                'lampiran_izin_usaha' => 'nullable|file|mimes:pdf|max:5120',
                'lampiran_izin_lingkungan' => 'nullable|file|mimes:pdf|max:5120',
                'lampiran_slo' => 'nullable|file|mimes:pdf|max:5120',
                'lampiran_skttk' => 'nullable|file|mimes:pdf|max:5120',
                'lampiran_nameplate_mesin' => 'nullable|file|mimes:pdf|max:5120',
                'lampiran_nameplate_generator' => 'nullable|file|mimes:pdf|max:5120',
                'lampiran_tagihan_listrik' => 'nullable|file|mimes:pdf|max:5120',
            ]);

            // ===== Field statis =====
            $data = $request->only([
                'nomor_izin_usaha',
                'tanggal_izin_usaha',
                'masa_berlaku_izin_usaha',
                'kelebihan_listrik',
                'jenis_izin_lingkungan',
                'nomor_izin_lingkungan',
                'tanggal_izin_lingkungan',
                'masa_berlaku_izin_lingkungan',
                'sambunganListrik',
            ]);

            // ===== Handle file uploads =====
            if ($request->hasFile('lampiran_izin_usaha')) {
                // Hapus file lama jika ada
                if ($pengajuan->lampiran_izin_usaha) {
                    \Storage::delete($pengajuan->lampiran_izin_usaha);
                }
                $data['lampiran_izin_usaha'] = $request->file('lampiran_izin_usaha')->store('uploads');
            }
            
            if ($request->hasFile('lampiran_izin_lingkungan')) {
                if ($pengajuan->lampiran_izin_lingkungan) {
                    \Storage::delete($pengajuan->lampiran_izin_lingkungan);
                }
                $data['lampiran_izin_lingkungan'] = $request->file('lampiran_izin_lingkungan')->store('uploads');
            }
            
            if ($request->hasFile('lampiran_tagihan_listrik')) {
                if ($pengajuan->lampiran_tagihan_listrik) {
                    \Storage::delete($pengajuan->lampiran_tagihan_listrik);
                }
                $data['lampiran_tagihan_listrik'] = $request->file('lampiran_tagihan_listrik')->store('uploads');
            }

            // ===== SLO Data =====
            if ($request->has('nomor_sertifikat_slo')) {
                $sloList = [];
                foreach ($request->nomor_sertifikat_slo as $i => $val) {
                    $sloList[] = [
                        'nomor_sertifikat_slo'     => $request->nomor_sertifikat_slo[$i] ?? null,
                        'nomor_register_slo'       => $request->nomor_register_slo[$i] ?? null,
                        'tanggal_terbit_slo'       => $request->tanggal_terbit_slo[$i] ?? null,
                        'tanggal_masa_berlaku_slo' => $request->tanggal_masa_berlaku_slo[$i] ?? null,
                        'lit'                      => $request->lit[$i] ?? null,
                    ];
                }
                $data['slo'] = $sloList;
            }

            if ($request->hasFile('lampiran_slo')) {
                if ($pengajuan->lampiran_slo) {
                    \Storage::delete($pengajuan->lampiran_slo);
                }
                $data['lampiran_slo'] = $request->file('lampiran_slo')->store('uploads');
            }

            // ===== SKTTK Data =====
            if ($request->has('nomor_sertifikat_skttk')) {
                $skttkList = [];
                foreach ($request->nomor_sertifikat_skttk as $i => $val) {
                    $skttkList[] = [
                        'nomor_sertifikat_skttk'     => $request->nomor_sertifikat_skttk[$i] ?? null,
                        'nomor_register_skttk'       => $request->nomor_register_skttk[$i] ?? null,
                        'nama_skttk'                 => $request->nama_skttk[$i] ?? null,
                        'jabatan_skttk'              => $request->jabatan_skttk[$i] ?? null,
                        'kode_kualifikasi_skttk'     => $request->kode_kualifikasi_skttk[$i] ?? null,
                        'kompetensi_inti1_skttk'     => $request->kompetensi_inti1_skttk[$i] ?? null,
                        'kompetensi_inti2_skttk'     => $request->kompetensi_inti2_skttk[$i] ?? null,
                        'kompetensi_pilihan1_skttk'  => $request->kompetensi_pilihan1_skttk[$i] ?? null,
                        'kompetensi_pilihan2_skttk'  => $request->kompetensi_pilihan2_skttk[$i] ?? null,
                        'tanggal_terbit_skttk'       => $request->tanggal_terbit_skttk[$i] ?? null,
                        'tanggal_masa_berlaku_skttk' => $request->tanggal_masa_berlaku_skttk[$i] ?? null,
                        'lsk_skttk'                  => $request->lsk_skttk[$i] ?? null,
                    ];
                }
                $data['skttk'] = $skttkList;
            }

            if ($request->hasFile('lampiran_skttk')) {
                if ($pengajuan->lampiran_skttk) {
                    \Storage::delete($pengajuan->lampiran_skttk);
                }
                $data['lampiran_skttk'] = $request->file('lampiran_skttk')->store('uploads');
            }

            // ===== Mesin Data =====
            $mesinList = [];
            if ($request->has('jenis_penggerak')) {
                foreach ($request->input('jenis_penggerak', []) as $i => $jenis) {
                    $mesinList[] = [
                        'jenis_penggerak'  => $request->input("jenis_penggerak.$i"),
                        'jenis_pembangkit' => $request->input("jenis_pembangkit.$i"),
                        'energi_primer'    => $request->input("energi_primer.$i"),
                        'mesin_merk_tipe'  => $request->input("mesin_merk_tipe.$i"),
                        'mesin_pabrikan'   => $request->input("mesin_pabrikan.$i"),
                        'mesin_kapasitas'  => $request->input("mesin_kapasitas.$i"),
                        'mesin_putaran'    => $request->input("mesin_putaran.$i"),
                    ];
                }
            }
            $data['mesin'] = $mesinList;

            if ($request->hasFile('lampiran_nameplate_mesin')) {
                if ($pengajuan->lampiran_nameplate_mesin) {
                    \Storage::delete($pengajuan->lampiran_nameplate_mesin);
                }
                $data['lampiran_nameplate_mesin'] = $request->file('lampiran_nameplate_mesin')->store('uploads');
            }

            // ===== Generator Data =====
            $generatorList = [];
            if ($request->has('generator_merk_tipe')) {
                foreach ($request->input('generator_merk_tipe', []) as $i => $val) {
                    $generatorList[] = [
                        'generator_merk_tipe'   => $request->input("generator_merk_tipe.$i"),
                        'generator_pabrikan'    => $request->input("generator_pabrikan.$i"),
                        'generator_kapasitas'   => $request->input("generator_kapasitas.$i"),
                        'generator_tegangan'    => $request->input("generator_tegangan.$i"),
                        'generator_arus'        => $request->input("generator_arus.$i"),
                        'generator_faktor_daya' => $request->input("generator_faktor_daya.$i"),
                        'generator_fasa'        => $request->input("generator_fasa.$i"),
                        'generator_frekuensi'   => $request->input("generator_frekuensi.$i"),
                        'generator_putaran'     => $request->input("generator_putaran.$i"),
                        'generator_lokasi'      => $request->input("generator_lokasi.$i"),
                        'generator_latitude'    => $request->input("generator_latitude.$i"),
                        'generator_longitude'   => $request->input("generator_longitude.$i"),
                    ];
                }
            }
            $data['generator'] = $generatorList;

            if ($request->hasFile('lampiran_nameplate_generator')) {
                if ($pengajuan->lampiran_nameplate_generator) {
                    \Storage::delete($pengajuan->lampiran_nameplate_generator);
                }
                $data['lampiran_nameplate_generator'] = $request->file('lampiran_nameplate_generator')->store('uploads');
            }

            // ===== Pemakaian Sendiri Data =====
            $data['pemakaian_sendiri'] = $this->mapDynamicGroup(
                $request->pemakaian_sendiri ?? [],
                ['kapasitas', 'faktor_daya', 'jam_nyala', 'daya_terpakai']
            );

            // ===== Distribusi Data =====
            $jaringanDistribusi = $this->mapDynamicGroup($request, [
                'pemilik_instalasi_distribusi',
                'tegangan_distribusi',
                'kapasitas_panjang_distribusi',
                'kabupaten_kota_distribusi',
                'provinsi_distribusi',
                'latitude_distribusi',
                'longitude_distribusi',
                'tahun_operasi_distribusi'
            ]);

            $data['distribusi'] = [
                'jaringan_distribusi' => $jaringanDistribusi,
                'trafo' => [
                    'pemilik_trafo'          => $request->input('pemilik_trafo'),
                    'tegangan_primer_trafo'  => $request->input('tegangan_primer_trafo'),
                    'tegangan_sekunder_trafo' => $request->input('tegangan_sekunder_trafo'),
                    'kapasitas_daya_trafo'   => $request->input('kapasitas_daya_trafo'),
                    'kabupaten_kota_trafo'   => $request->input('kabupaten_kota_trafo'),
                    'provinsi_trafo'         => $request->input('provinsi_trafo'),
                    'latitude_trafo'         => $request->input('latitude_trafo'),
                    'longitude_trafo'        => $request->input('longitude_trafo'),
                    'tahun_operasi_trafo'    => $request->input('tahun_operasi_trafo'),
                ]
            ];

            // ===== Penjualan Listrik =====
            if ($request->input('penjualan_listrik') === 'yes') {
                $data['penjualan_listrik'] = [
                    'status' => 'yes',
                    'excess_power' => array_values($request->input('excess_power', [])),
                ];
            } else {
                $data['penjualan_listrik'] = null;
            }

            // Update status jika diperlukan
            if ($pengajuan->status === 'perbaikan') {
                $data['status'] = 'proses evaluasi'; // Ubah status setelah diperbaiki
            }

            // Update data
            $pengajuan->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Pengajuan berhasil diperbarui dan dikirim kembali untuk evaluasi.',
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

    /**
     * Mengubah kumpulan input array menjadi array of objects (untuk JSON di DB).
     * - Menentukan jumlah baris berdasarkan field terpanjang.
     * - Menyimpan file upload per baris jika ada.
     * - Mengabaikan baris yang kosong semua.
     */
    private function mapDynamicGroup($source, array $fields, $fileField = null)
    {
        if (empty($fields)) {
            return [];
        }

        // 🔹 MODE 1: Kalau sumbernya array nested (contoh: $request->pemakaian_sendiri)
        if (is_array($source)) {
            $nested = [];
            foreach ($source as $jenis => $bulanData) {
                if (!is_array($bulanData)) {
                    continue; // skip kalau bukan array
                }
                foreach ($bulanData as $bulan => $values) {
                    if (!is_array($values)) {
                        continue; // skip kalau bukan array
                    }
                    foreach ($fields as $field) {
                        $nested[$jenis][$bulan][$field] = $values[$field] ?? null;
                    }
                }
            }
            return $nested;
        }

        // 🔹 MODE 2: Kalau sumbernya object Request
        if ($source instanceof \Illuminate\Http\Request) {
            $request = $source;
            $maxRows = 0;

            foreach ($fields as $f) {
                $input = $request->input($f, []);
                $cnt = is_array($input) ? count($input) : 0;
                if ($cnt > $maxRows) {
                    $maxRows = $cnt;
                }
            }

            $result = [];
            for ($i = 0; $i < $maxRows; $i++) {
                $row = [];
                $allEmpty = true;

                foreach ($fields as $field) {
                    if ($field === $fileField) {
                        if ($request->hasFile($fileField) && is_array($request->file($fileField)) && isset($request->file($fileField)[$i])) {
                            $row[$field] = $request->file($fileField)[$i]->store('uploads');
                            $allEmpty = false;
                        } else {
                            $row[$field] = null;
                        }
                    } else {
                        $value = is_array($request->input($field))
                            ? ($request->input($field)[$i] ?? null)
                            : $request->input($field);

                        if (is_string($value) && trim($value) === '') {
                            $value = null;
                        }

                        if (!is_null($value)) {
                            $allEmpty = false;
                        }

                        $row[$field] = $value;
                    }
                }

                if (!$allEmpty) {
                    $result[] = $row;
                }
            }

            return $result;
        }

        // 🔹 Kalau bukan array dan bukan Request
        return [];
    }
}
