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

            // ===== DEBUG: Log existing data BEFORE processing =====
            \Log::info('🔍 BEFORE UPDATE - Existing data for pengajuan ' . $id, [
                'existing_skttk' => $pengajuan->skttk,
                'existing_mesin' => $pengajuan->mesin,
                'existing_generator' => $pengajuan->generator,
                'existing_distribusi' => $pengajuan->distribusi,
            ]);
            
            \Log::info('✅ FIXED CONTROLLER UPDATE - Smart merge untuk preserve data existing', [
                'approach' => 'Merge request data dengan existing data untuk semua field',
                'benefits' => [
                    'Field yang tidak dikirim (disabled/readonly) tetap dipertahankan',
                    'Field yang dikirim akan di-update',
                    'Tidak ada data yang hilang karena kondisi terlalu ketat',
                    'Support partial update untuk semua section'
                ]
            ]);
            
            // ===== DEBUG: Log ALL incoming request data =====
            \Log::info('📥 RAW REQUEST DATA for pengajuan ' . $id, [
                'all_request' => $request->all(),
                'request_method' => $request->method(),
                'content_type' => $request->header('Content-Type'),
            ]);
            
            // ===== DEBUG: Check specific problematic fields =====
            \Log::info('🎯 SPECIFIC FIELD DEBUG for pengajuan ' . $id, [
                // SKTTK tanggal fields
                'has_tanggal_terbit_skttk' => $request->has('tanggal_terbit_skttk'),
                'tanggal_terbit_skttk_data' => $request->input('tanggal_terbit_skttk'),
                'has_tanggal_masa_berlaku_skttk' => $request->has('tanggal_masa_berlaku_skttk'),
                'tanggal_masa_berlaku_skttk_data' => $request->input('tanggal_masa_berlaku_skttk'),
                
                // Mesin jenis pembangkit
                'has_jenis_pembangkit' => $request->has('jenis_pembangkit'),
                'jenis_pembangkit_data' => $request->input('jenis_pembangkit'),
                
                // Generator lokasi fields
                'has_generator_lokasi' => $request->has('generator_lokasi'),
                'generator_lokasi_data' => $request->input('generator_lokasi'),
                'has_generator_latitude' => $request->has('generator_latitude'),
                'generator_latitude_data' => $request->input('generator_latitude'),
                'has_generator_longitude' => $request->has('generator_longitude'),
                'generator_longitude_data' => $request->input('generator_longitude'),
                
                // Distribusi fields
                'has_kabupaten_kota_distribusi' => $request->has('kabupaten_kota_distribusi'),
                'kabupaten_kota_distribusi_data' => $request->input('kabupaten_kota_distribusi'),
                'has_latitude_distribusi' => $request->has('latitude_distribusi'),
                'latitude_distribusi_data' => $request->input('latitude_distribusi'),
                'has_longitude_distribusi' => $request->has('longitude_distribusi'),
                'longitude_distribusi_data' => $request->input('longitude_distribusi'),
                
                // Trafo fields
                'has_kabupaten_kota_trafo' => $request->has('kabupaten_kota_trafo'),
                'kabupaten_kota_trafo_data' => $request->input('kabupaten_kota_trafo'),
                'has_latitude_trafo' => $request->has('latitude_trafo'),
                'latitude_trafo_data' => $request->input('latitude_trafo'),
                'has_longitude_trafo' => $request->has('longitude_trafo'),
                'longitude_trafo_data' => $request->input('longitude_trafo'),
            ]);

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
            // Hanya update SLO jika ada data yang dikirim dan valid
            if ($request->has('nomor_sertifikat_slo') && is_array($request->nomor_sertifikat_slo) && !empty(array_filter($request->nomor_sertifikat_slo))) {
                $sloList = [];
                foreach ($request->nomor_sertifikat_slo as $i => $val) {
                    // Skip baris kosong
                    if (empty(trim($val ?? ''))) continue;
                    
                    $sloList[] = [
                        'nomor_sertifikat_slo'     => $request->nomor_sertifikat_slo[$i] ?? null,
                        'nomor_register_slo'       => $request->nomor_register_slo[$i] ?? null,
                        'tanggal_terbit_slo'       => $request->tanggal_terbit_slo[$i] ?? null,
                        'tanggal_masa_berlaku_slo' => $request->tanggal_masa_berlaku_slo[$i] ?? null,
                        'lit'                      => $request->lit[$i] ?? null,
                    ];
                }
                // Hanya update jika ada data valid
                if (!empty($sloList)) {
                    $data['slo'] = $sloList;
                }
            }
            // Jika tidak ada data SLO baru, pertahankan data lama

            if ($request->hasFile('lampiran_slo')) {
                if ($pengajuan->lampiran_slo) {
                    \Storage::delete($pengajuan->lampiran_slo);
                }
                $data['lampiran_slo'] = $request->file('lampiran_slo')->store('uploads');
            }

            // ===== SKTTK Data =====
            \Log::info('🔧 PROCESSING SKTTK DATA for pengajuan ' . $id, [
                'has_nomor_sertifikat_skttk' => $request->has('nomor_sertifikat_skttk'),
                'nomor_sertifikat_skttk_raw' => $request->nomor_sertifikat_skttk,
                'is_array' => is_array($request->nomor_sertifikat_skttk),
                'array_filter_result' => $request->nomor_sertifikat_skttk ? array_filter($request->nomor_sertifikat_skttk) : null,
            ]);
            
            // ✅ FIX: Update SKTTK jika ada field yang dikirim (tidak harus semua)
            $skttkFields = [
                'nomor_sertifikat_skttk', 'nomor_register_skttk', 'nama_skttk', 'jabatan_skttk',
                'kode_kualifikasi_skttk', 'kompetensi_inti1_skttk', 'kompetensi_inti2_skttk',
                'kompetensi_pilihan1_skttk', 'kompetensi_pilihan2_skttk', 'tanggal_terbit_skttk',
                'tanggal_masa_berlaku_skttk', 'lsk_skttk'
            ];
            
            $hasSkttkData = false;
            foreach ($skttkFields as $field) {
                if ($request->has($field)) {
                    $hasSkttkData = true;
                    break;
                }
            }
            
            if ($hasSkttkData) {
                // Ambil existing data atau buat array kosong
                $existingSkttk = $pengajuan->skttk ?? [];
                $maxRows = 0;
                
                // Tentukan jumlah baris berdasarkan field terpanjang
                foreach ($skttkFields as $field) {
                    if ($request->has($field) && is_array($request->input($field))) {
                        $maxRows = max($maxRows, count($request->input($field)));
                    }
                }
                
                // Jika tidak ada data array, gunakan existing count
                if ($maxRows === 0 && !empty($existingSkttk)) {
                    $maxRows = count($existingSkttk);
                }
                
                $skttkList = [];
                for ($i = 0; $i < $maxRows; $i++) {
                    $skttkItem = [
                        'nomor_sertifikat_skttk'     => $request->has('nomor_sertifikat_skttk') && isset($request->nomor_sertifikat_skttk[$i]) ? $request->nomor_sertifikat_skttk[$i] : ($existingSkttk[$i]['nomor_sertifikat_skttk'] ?? null),
                        'nomor_register_skttk'       => $request->has('nomor_register_skttk') && isset($request->nomor_register_skttk[$i]) ? $request->nomor_register_skttk[$i] : ($existingSkttk[$i]['nomor_register_skttk'] ?? null),
                        'nama_skttk'                 => $request->has('nama_skttk') && isset($request->nama_skttk[$i]) ? $request->nama_skttk[$i] : ($existingSkttk[$i]['nama_skttk'] ?? null),
                        'jabatan_skttk'              => $request->has('jabatan_skttk') && isset($request->jabatan_skttk[$i]) ? $request->jabatan_skttk[$i] : ($existingSkttk[$i]['jabatan_skttk'] ?? null),
                        'kode_kualifikasi_skttk'     => $request->has('kode_kualifikasi_skttk') && isset($request->kode_kualifikasi_skttk[$i]) ? $request->kode_kualifikasi_skttk[$i] : ($existingSkttk[$i]['kode_kualifikasi_skttk'] ?? null),
                        'kompetensi_inti1_skttk'     => $request->has('kompetensi_inti1_skttk') && isset($request->kompetensi_inti1_skttk[$i]) ? $request->kompetensi_inti1_skttk[$i] : ($existingSkttk[$i]['kompetensi_inti1_skttk'] ?? null),
                        'kompetensi_inti2_skttk'     => $request->has('kompetensi_inti2_skttk') && isset($request->kompetensi_inti2_skttk[$i]) ? $request->kompetensi_inti2_skttk[$i] : ($existingSkttk[$i]['kompetensi_inti2_skttk'] ?? null),
                        'kompetensi_pilihan1_skttk'  => $request->has('kompetensi_pilihan1_skttk') && isset($request->kompetensi_pilihan1_skttk[$i]) ? $request->kompetensi_pilihan1_skttk[$i] : ($existingSkttk[$i]['kompetensi_pilihan1_skttk'] ?? null),
                        'kompetensi_pilihan2_skttk'  => $request->has('kompetensi_pilihan2_skttk') && isset($request->kompetensi_pilihan2_skttk[$i]) ? $request->kompetensi_pilihan2_skttk[$i] : ($existingSkttk[$i]['kompetensi_pilihan2_skttk'] ?? null),
                        'tanggal_terbit_skttk'       => $request->has('tanggal_terbit_skttk') && isset($request->tanggal_terbit_skttk[$i]) ? $request->tanggal_terbit_skttk[$i] : ($existingSkttk[$i]['tanggal_terbit_skttk'] ?? null),
                        'tanggal_masa_berlaku_skttk' => $request->has('tanggal_masa_berlaku_skttk') && isset($request->tanggal_masa_berlaku_skttk[$i]) ? $request->tanggal_masa_berlaku_skttk[$i] : ($existingSkttk[$i]['tanggal_masa_berlaku_skttk'] ?? null),
                        'lsk_skttk'                  => $request->has('lsk_skttk') && isset($request->lsk_skttk[$i]) ? $request->lsk_skttk[$i] : ($existingSkttk[$i]['lsk_skttk'] ?? null),
                    ];
                    
                    \Log::info("📝 SKTTK Item $i processed", [
                        'item_data' => $skttkItem,
                        'tanggal_terbit_value' => $skttkItem['tanggal_terbit_skttk'],
                        'tanggal_masa_berlaku_value' => $skttkItem['tanggal_masa_berlaku_skttk'],
                        'was_merged_with_existing' => !$request->has('tanggal_terbit_skttk') || !$request->has('tanggal_masa_berlaku_skttk')
                    ]);
                    
                    // Hanya tambahkan jika ada data yang valid
                    $hasValidData = false;
                    foreach ($skttkItem as $value) {
                        if (!is_null($value) && trim((string)$value) !== '') {
                            $hasValidData = true;
                            break;
                        }
                    }
                    
                    if ($hasValidData) {
                        $skttkList[] = $skttkItem;
                    }
                }
                
                // Update SKTTK data
                if (!empty($skttkList)) {
                    $data['skttk'] = $skttkList;
                    \Log::info('✅ SKTTK will be updated with merged data', [
                        'item_count' => count($skttkList),
                        'sample_item' => $skttkList[0] ?? null,
                    ]);
                } else {
                    \Log::info('🔒 SKTTK data preserved (no valid data after merge)');
                }
            } else {
                \Log::info('🔒 SKTTK data preserved (no fields sent)', [
                    'checked_fields' => $skttkFields
                ]);
            }

            if ($request->hasFile('lampiran_skttk')) {
                if ($pengajuan->lampiran_skttk) {
                    \Storage::delete($pengajuan->lampiran_skttk);
                }
                $data['lampiran_skttk'] = $request->file('lampiran_skttk')->store('uploads');
            }

            // ===== Mesin Data =====
            \Log::info('⚙️ PROCESSING MESIN DATA for pengajuan ' . $id, [
                'has_jenis_penggerak' => $request->has('jenis_penggerak'),
                'jenis_penggerak_raw' => $request->input('jenis_penggerak'),
                'jenis_pembangkit_raw' => $request->input('jenis_pembangkit'),
            ]);
            
            // ✅ FIX: Update Mesin jika ada field yang dikirim (tidak harus semua)
            $mesinFields = [
                'jenis_penggerak', 'jenis_pembangkit', 'energi_primer',
                'mesin_merk_tipe', 'mesin_pabrikan', 'mesin_kapasitas', 'mesin_putaran'
            ];
            
            $hasMesinData = false;
            foreach ($mesinFields as $field) {
                if ($request->has($field)) {
                    $hasMesinData = true;
                    break;
                }
            }
            
            if ($hasMesinData) {
                // Ambil existing data atau buat array kosong
                $existingMesin = $pengajuan->mesin ?? [];
                $maxRows = 0;
                
                // Tentukan jumlah baris berdasarkan field terpanjang
                foreach ($mesinFields as $field) {
                    if ($request->has($field) && is_array($request->input($field))) {
                        $maxRows = max($maxRows, count($request->input($field)));
                    }
                }
                
                // Jika tidak ada data array, gunakan existing count
                if ($maxRows === 0 && !empty($existingMesin)) {
                    $maxRows = count($existingMesin);
                }
                
                $mesinList = [];
                for ($i = 0; $i < $maxRows; $i++) {
                    $mesinItem = [
                        'jenis_penggerak'  => $request->has('jenis_penggerak') && isset($request->input('jenis_penggerak')[$i]) ? $request->input('jenis_penggerak')[$i] : ($existingMesin[$i]['jenis_penggerak'] ?? null),
                        'jenis_pembangkit' => $request->has('jenis_pembangkit') && isset($request->input('jenis_pembangkit')[$i]) ? $request->input('jenis_pembangkit')[$i] : ($existingMesin[$i]['jenis_pembangkit'] ?? null),
                        'energi_primer'    => $request->has('energi_primer') && isset($request->input('energi_primer')[$i]) ? $request->input('energi_primer')[$i] : ($existingMesin[$i]['energi_primer'] ?? null),
                        'mesin_merk_tipe'  => $request->has('mesin_merk_tipe') && isset($request->input('mesin_merk_tipe')[$i]) ? $request->input('mesin_merk_tipe')[$i] : ($existingMesin[$i]['mesin_merk_tipe'] ?? null),
                        'mesin_pabrikan'   => $request->has('mesin_pabrikan') && isset($request->input('mesin_pabrikan')[$i]) ? $request->input('mesin_pabrikan')[$i] : ($existingMesin[$i]['mesin_pabrikan'] ?? null),
                        'mesin_kapasitas'  => $request->has('mesin_kapasitas') && isset($request->input('mesin_kapasitas')[$i]) ? $request->input('mesin_kapasitas')[$i] : ($existingMesin[$i]['mesin_kapasitas'] ?? null),
                        'mesin_putaran'    => $request->has('mesin_putaran') && isset($request->input('mesin_putaran')[$i]) ? $request->input('mesin_putaran')[$i] : ($existingMesin[$i]['mesin_putaran'] ?? null),
                    ];
                    
                    \Log::info("🔧 Mesin Item $i processed", [
                        'item_data' => $mesinItem,
                        'jenis_pembangkit_value' => $mesinItem['jenis_pembangkit'],
                        'was_merged_with_existing' => !$request->has('jenis_pembangkit')
                    ]);
                    
                    // Hanya tambahkan jika ada data yang valid
                    $hasValidData = false;
                    foreach ($mesinItem as $value) {
                        if (!is_null($value) && trim((string)$value) !== '') {
                            $hasValidData = true;
                            break;
                        }
                    }
                    
                    if ($hasValidData) {
                        $mesinList[] = $mesinItem;
                    }
                }
                
                // Update Mesin data
                if (!empty($mesinList)) {
                    $data['mesin'] = $mesinList;
                    \Log::info('✅ MESIN will be updated with merged data', [
                        'item_count' => count($mesinList),
                        'sample_item' => $mesinList[0] ?? null,
                    ]);
                } else {
                    \Log::info('🔒 MESIN data preserved (no valid data after merge)');
                }
            } else {
                \Log::info('🔒 MESIN data preserved (no fields sent)', [
                    'checked_fields' => $mesinFields
                ]);
            }

            if ($request->hasFile('lampiran_nameplate_mesin')) {
                if ($pengajuan->lampiran_nameplate_mesin) {
                    \Storage::delete($pengajuan->lampiran_nameplate_mesin);
                }
                $data['lampiran_nameplate_mesin'] = $request->file('lampiran_nameplate_mesin')->store('uploads');
            }

            // ===== Generator Data =====
            \Log::info('⚡ PROCESSING GENERATOR DATA for pengajuan ' . $id, [
                'has_generator_merk_tipe' => $request->has('generator_merk_tipe'),
                'generator_merk_tipe_raw' => $request->input('generator_merk_tipe'),
                'generator_lokasi_raw' => $request->input('generator_lokasi'),
                'generator_latitude_raw' => $request->input('generator_latitude'),
                'generator_longitude_raw' => $request->input('generator_longitude'),
            ]);
            
            // ✅ FIX: Update Generator jika ada field yang dikirim (tidak harus semua)
            $generatorFields = [
                'generator_merk_tipe', 'generator_pabrikan', 'generator_kapasitas',
                'generator_tegangan', 'generator_arus', 'generator_faktor_daya',
                'generator_fasa', 'generator_frekuensi', 'generator_putaran',
                'generator_lokasi', 'generator_latitude', 'generator_longitude'
            ];
            
            $hasGeneratorData = false;
            foreach ($generatorFields as $field) {
                if ($request->has($field)) {
                    $hasGeneratorData = true;
                    break;
                }
            }
            
            if ($hasGeneratorData) {
                // Ambil existing data atau buat array kosong
                $existingGenerator = $pengajuan->generator ?? [];
                $maxRows = 0;
                
                // Tentukan jumlah baris berdasarkan field terpanjang
                foreach ($generatorFields as $field) {
                    if ($request->has($field) && is_array($request->input($field))) {
                        $maxRows = max($maxRows, count($request->input($field)));
                    }
                }
                
                // Jika tidak ada data array, gunakan existing count
                if ($maxRows === 0 && !empty($existingGenerator)) {
                    $maxRows = count($existingGenerator);
                }
                
                $generatorList = [];
                for ($i = 0; $i < $maxRows; $i++) {
                    $generatorItem = [
                        'generator_merk_tipe'   => $request->has('generator_merk_tipe') && isset($request->input('generator_merk_tipe')[$i]) ? $request->input('generator_merk_tipe')[$i] : ($existingGenerator[$i]['generator_merk_tipe'] ?? null),
                        'generator_pabrikan'    => $request->has('generator_pabrikan') && isset($request->input('generator_pabrikan')[$i]) ? $request->input('generator_pabrikan')[$i] : ($existingGenerator[$i]['generator_pabrikan'] ?? null),
                        'generator_kapasitas'   => $request->has('generator_kapasitas') && isset($request->input('generator_kapasitas')[$i]) ? $request->input('generator_kapasitas')[$i] : ($existingGenerator[$i]['generator_kapasitas'] ?? null),
                        'generator_tegangan'    => $request->has('generator_tegangan') && isset($request->input('generator_tegangan')[$i]) ? $request->input('generator_tegangan')[$i] : ($existingGenerator[$i]['generator_tegangan'] ?? null),
                        'generator_arus'        => $request->has('generator_arus') && isset($request->input('generator_arus')[$i]) ? $request->input('generator_arus')[$i] : ($existingGenerator[$i]['generator_arus'] ?? null),
                        'generator_faktor_daya' => $request->has('generator_faktor_daya') && isset($request->input('generator_faktor_daya')[$i]) ? $request->input('generator_faktor_daya')[$i] : ($existingGenerator[$i]['generator_faktor_daya'] ?? null),
                        'generator_fasa'        => $request->has('generator_fasa') && isset($request->input('generator_fasa')[$i]) ? $request->input('generator_fasa')[$i] : ($existingGenerator[$i]['generator_fasa'] ?? null),
                        'generator_frekuensi'   => $request->has('generator_frekuensi') && isset($request->input('generator_frekuensi')[$i]) ? $request->input('generator_frekuensi')[$i] : ($existingGenerator[$i]['generator_frekuensi'] ?? null),
                        'generator_putaran'     => $request->has('generator_putaran') && isset($request->input('generator_putaran')[$i]) ? $request->input('generator_putaran')[$i] : ($existingGenerator[$i]['generator_putaran'] ?? null),
                        'generator_lokasi'      => $request->has('generator_lokasi') && isset($request->input('generator_lokasi')[$i]) ? $request->input('generator_lokasi')[$i] : ($existingGenerator[$i]['generator_lokasi'] ?? null),
                        'generator_latitude'    => $request->has('generator_latitude') && isset($request->input('generator_latitude')[$i]) ? $request->input('generator_latitude')[$i] : ($existingGenerator[$i]['generator_latitude'] ?? null),
                        'generator_longitude'   => $request->has('generator_longitude') && isset($request->input('generator_longitude')[$i]) ? $request->input('generator_longitude')[$i] : ($existingGenerator[$i]['generator_longitude'] ?? null),
                    ];
                    
                    \Log::info("⚡ Generator Item $i processed", [
                        'item_data' => $generatorItem,
                        'lokasi_value' => $generatorItem['generator_lokasi'],
                        'latitude_value' => $generatorItem['generator_latitude'],
                        'longitude_value' => $generatorItem['generator_longitude'],
                        'was_merged_with_existing' => !$request->has('generator_lokasi') || !$request->has('generator_latitude') || !$request->has('generator_longitude')
                    ]);
                    
                    // Hanya tambahkan jika ada data yang valid
                    $hasValidData = false;
                    foreach ($generatorItem as $value) {
                        if (!is_null($value) && trim((string)$value) !== '') {
                            $hasValidData = true;
                            break;
                        }
                    }
                    
                    if ($hasValidData) {
                        $generatorList[] = $generatorItem;
                    }
                }
                
                // Update Generator data
                if (!empty($generatorList)) {
                    $data['generator'] = $generatorList;
                    \Log::info('✅ GENERATOR will be updated with merged data', [
                        'item_count' => count($generatorList),
                        'sample_item' => $generatorList[0] ?? null,
                    ]);
                } else {
                    \Log::info('🔒 GENERATOR data preserved (no valid data after merge)');
                }
            } else {
                \Log::info('🔒 GENERATOR data preserved (no fields sent)', [
                    'checked_fields' => $generatorFields
                ]);
            }

            if ($request->hasFile('lampiran_nameplate_generator')) {
                if ($pengajuan->lampiran_nameplate_generator) {
                    \Storage::delete($pengajuan->lampiran_nameplate_generator);
                }
                $data['lampiran_nameplate_generator'] = $request->file('lampiran_nameplate_generator')->store('uploads');
            }

            // ===== Pemakaian Sendiri Data =====
            // Hanya update jika ada data yang dikirim
            if ($request->has('pemakaian_sendiri') && !empty($request->pemakaian_sendiri)) {
                $pemakaianData = $this->mapDynamicGroup(
                    $request->pemakaian_sendiri,
                    ['kapasitas', 'faktor_daya', 'jam_nyala', 'daya_terpakai']
                );
                if (!empty($pemakaianData)) {
                    $data['pemakaian_sendiri'] = $pemakaianData;
                }
            }

            // ===== Distribusi Data =====
            \Log::info('🔌 PROCESSING DISTRIBUSI DATA for pengajuan ' . $id);
            
            // ✅ FIX: Update distribusi jika ada field yang dikirim (tidak harus semua)
            $distribusiFields = [
                'pemilik_instalasi_distribusi', 'tegangan_distribusi', 'kapasitas_panjang_distribusi',
                'kabupaten_kota_distribusi', 'provinsi_distribusi', 'latitude_distribusi',
                'longitude_distribusi', 'tahun_operasi_distribusi'
            ];
            
            $trafoFields = [
                'pemilik_trafo', 'tegangan_primer_trafo', 'tegangan_sekunder_trafo',
                'kapasitas_daya_trafo', 'kabupaten_kota_trafo', 'provinsi_trafo',
                'latitude_trafo', 'longitude_trafo', 'tahun_operasi_trafo'
            ];
            
            // Check apakah ada field distribusi yang dikirim
            $hasDistribusiData = false;
            $distribusiFieldStatus = [];
            foreach ($distribusiFields as $field) {
                $hasField = $request->has($field);
                $distribusiFieldStatus[$field] = [
                    'has_field' => $hasField,
                    'value' => $request->input($field)
                ];
                if ($hasField) {
                    $hasDistribusiData = true;
                }
            }
            
            // Check apakah ada field trafo yang dikirim
            $hasTrafoData = false;
            $trafoFieldStatus = [];
            foreach ($trafoFields as $field) {
                $hasField = $request->has($field);
                $trafoFieldStatus[$field] = [
                    'has_field' => $hasField,
                    'value' => $request->input($field)
                ];
                if ($hasField) {
                    $hasTrafoData = true;
                }
            }
            
            \Log::info('🔍 DISTRIBUSI FIELDS STATUS', $distribusiFieldStatus);
            \Log::info('🔍 TRAFO FIELDS STATUS', $trafoFieldStatus);
            
            // Update distribusi jika ada data yang dikirim
            if ($hasDistribusiData || $hasTrafoData) {
                // Ambil data existing atau buat struktur kosong
                $existingDistribusi = $pengajuan->distribusi ?? [
                    'jaringan_distribusi' => [],
                    'trafo' => []
                ];
                
                \Log::info('📊 DISTRIBUSI will be updated', [
                    'has_distribusi_data' => $hasDistribusiData,
                    'has_trafo_data' => $hasTrafoData,
                    'existing_distribusi' => $existingDistribusi,
                ]);
                
                // Update jaringan distribusi dengan merge existing data
                if ($hasDistribusiData) {
                    $existingJaringan = $existingDistribusi['jaringan_distribusi'] ?? [];
                    $maxRows = 0;
                    
                    // Tentukan jumlah baris berdasarkan field terpanjang
                    foreach ($distribusiFields as $field) {
                        if ($request->has($field) && is_array($request->input($field))) {
                            $maxRows = max($maxRows, count($request->input($field)));
                        }
                    }
                    
                    // Jika tidak ada data array, gunakan existing count
                    if ($maxRows === 0 && !empty($existingJaringan)) {
                        $maxRows = count($existingJaringan);
                    }
                    
                    $jaringanDistribusi = [];
                    for ($i = 0; $i < $maxRows; $i++) {
                        $jaringanItem = [
                            'pemilik_instalasi_distribusi' => $request->has('pemilik_instalasi_distribusi') && isset($request->input('pemilik_instalasi_distribusi')[$i]) ? $request->input('pemilik_instalasi_distribusi')[$i] : ($existingJaringan[$i]['pemilik_instalasi_distribusi'] ?? null),
                            'tegangan_distribusi'          => $request->has('tegangan_distribusi') && isset($request->input('tegangan_distribusi')[$i]) ? $request->input('tegangan_distribusi')[$i] : ($existingJaringan[$i]['tegangan_distribusi'] ?? null),
                            'kapasitas_panjang_distribusi' => $request->has('kapasitas_panjang_distribusi') && isset($request->input('kapasitas_panjang_distribusi')[$i]) ? $request->input('kapasitas_panjang_distribusi')[$i] : ($existingJaringan[$i]['kapasitas_panjang_distribusi'] ?? null),
                            'kabupaten_kota_distribusi'    => $request->has('kabupaten_kota_distribusi') && isset($request->input('kabupaten_kota_distribusi')[$i]) ? $request->input('kabupaten_kota_distribusi')[$i] : ($existingJaringan[$i]['kabupaten_kota_distribusi'] ?? null),
                            'provinsi_distribusi'          => $request->has('provinsi_distribusi') && isset($request->input('provinsi_distribusi')[$i]) ? $request->input('provinsi_distribusi')[$i] : ($existingJaringan[$i]['provinsi_distribusi'] ?? null),
                            'latitude_distribusi'          => $request->has('latitude_distribusi') && isset($request->input('latitude_distribusi')[$i]) ? $request->input('latitude_distribusi')[$i] : ($existingJaringan[$i]['latitude_distribusi'] ?? null),
                            'longitude_distribusi'         => $request->has('longitude_distribusi') && isset($request->input('longitude_distribusi')[$i]) ? $request->input('longitude_distribusi')[$i] : ($existingJaringan[$i]['longitude_distribusi'] ?? null),
                            'tahun_operasi_distribusi'     => $request->has('tahun_operasi_distribusi') && isset($request->input('tahun_operasi_distribusi')[$i]) ? $request->input('tahun_operasi_distribusi')[$i] : ($existingJaringan[$i]['tahun_operasi_distribusi'] ?? null),
                        ];
                        
                        // Hanya tambahkan jika ada data yang valid
                        $hasValidData = false;
                        foreach ($jaringanItem as $value) {
                            if (!is_null($value) && trim((string)$value) !== '') {
                                $hasValidData = true;
                                break;
                            }
                        }
                        
                        if ($hasValidData) {
                            $jaringanDistribusi[] = $jaringanItem;
                        }
                    }
                    
                    $existingDistribusi['jaringan_distribusi'] = $jaringanDistribusi;
                    \Log::info('✅ Jaringan Distribusi updated with merged data', [
                        'item_count' => count($jaringanDistribusi),
                        'sample_item' => $jaringanDistribusi[0] ?? null
                    ]);
                }
                
                // Update trafo dengan merge existing data
                if ($hasTrafoData) {
                    $existingTrafo = $existingDistribusi['trafo'] ?? [];
                    
                    $trafoData = [
                        'pemilik_trafo'          => $request->has('pemilik_trafo') ? $request->input('pemilik_trafo') : ($existingTrafo['pemilik_trafo'] ?? null),
                        'tegangan_primer_trafo'  => $request->has('tegangan_primer_trafo') ? $request->input('tegangan_primer_trafo') : ($existingTrafo['tegangan_primer_trafo'] ?? null),
                        'tegangan_sekunder_trafo' => $request->has('tegangan_sekunder_trafo') ? $request->input('tegangan_sekunder_trafo') : ($existingTrafo['tegangan_sekunder_trafo'] ?? null),
                        'kapasitas_daya_trafo'   => $request->has('kapasitas_daya_trafo') ? $request->input('kapasitas_daya_trafo') : ($existingTrafo['kapasitas_daya_trafo'] ?? null),
                        'kabupaten_kota_trafo'   => $request->has('kabupaten_kota_trafo') ? $request->input('kabupaten_kota_trafo') : ($existingTrafo['kabupaten_kota_trafo'] ?? null),
                        'provinsi_trafo'         => $request->has('provinsi_trafo') ? $request->input('provinsi_trafo') : ($existingTrafo['provinsi_trafo'] ?? null),
                        'latitude_trafo'         => $request->has('latitude_trafo') ? $request->input('latitude_trafo') : ($existingTrafo['latitude_trafo'] ?? null),
                        'longitude_trafo'        => $request->has('longitude_trafo') ? $request->input('longitude_trafo') : ($existingTrafo['longitude_trafo'] ?? null),
                        'tahun_operasi_trafo'    => $request->has('tahun_operasi_trafo') ? $request->input('tahun_operasi_trafo') : ($existingTrafo['tahun_operasi_trafo'] ?? null),
                    ];
                    
                    $existingDistribusi['trafo'] = $trafoData;
                    \Log::info('✅ Trafo data updated with merged data', [
                        'trafo_data' => $trafoData,
                        'kabupaten_kota_value' => $trafoData['kabupaten_kota_trafo'],
                        'latitude_value' => $trafoData['latitude_trafo'],
                        'longitude_value' => $trafoData['longitude_trafo'],
                        'was_merged_with_existing' => !$request->has('kabupaten_kota_trafo') || !$request->has('latitude_trafo') || !$request->has('longitude_trafo')
                    ]);
                }
                
                $data['distribusi'] = $existingDistribusi;
                \Log::info('✅ FINAL DISTRIBUSI DATA with merged data', ['final_distribusi' => $existingDistribusi]);
            } else {
                \Log::info('🔒 DISTRIBUSI data preserved (no fields sent)', [
                    'distribusi_fields_checked' => $distribusiFields,
                    'trafo_fields_checked' => $trafoFields
                ]);
            }

            // ===== Penjualan Listrik =====
            // Hanya update jika ada data penjualan listrik
            if ($request->has('penjualan_listrik')) {
                if ($request->input('penjualan_listrik') === 'yes') {
                    $data['penjualan_listrik'] = [
                        'status' => 'yes',
                        'excess_power' => array_values($request->input('excess_power', [])),
                    ];
                } else {
                    $data['penjualan_listrik'] = null;
                }
            }

            // Update status jika diperlukan
            if ($pengajuan->status === 'perbaikan') {
                $data['status'] = 'proses evaluasi'; // Ubah status setelah diperbaiki
            }

            // Log data sebelum update untuk debugging
            \Log::info('Updating pengajuan ID: ' . $id, [
                'user_id' => $userId,
                'old_status' => $pengajuan->status,
                'new_status' => $data['status'] ?? $pengajuan->status,
                'has_slo_data' => isset($data['slo']),
                'has_mesin_data' => isset($data['mesin']),
                'has_generator_data' => isset($data['generator']),
                'has_skttk_data' => isset($data['skttk']),
                'slo_count' => isset($data['slo']) ? count($data['slo']) : 'preserved',
                'mesin_count' => isset($data['mesin']) ? count($data['mesin']) : 'preserved',
                'generator_count' => isset($data['generator']) ? count($data['generator']) : 'preserved',
                'skttk_count' => isset($data['skttk']) ? count($data['skttk']) : 'preserved',
            ]);
            
            // ===== VALIDASI FINAL: Log data yang akan di-update =====
            $arrayFields = ['slo', 'mesin', 'generator', 'skttk', 'pemakaian_sendiri'];
            
            foreach ($arrayFields as $field) {
                if (isset($data[$field])) {
                    \Log::info("✅ Field $field will be updated with merged data", [
                        'new_count' => is_array($data[$field]) ? count($data[$field]) : 'not_array',
                        'sample_data' => is_array($data[$field]) ? (array_slice($data[$field], 0, 1) ?: 'empty_array') : $data[$field] // Log sample untuk debugging
                    ]);
                }
            }
            
            // Log distribusi update
            if (isset($data['distribusi'])) {
                \Log::info('✅ Distribusi will be updated with merged data', [
                    'has_jaringan' => !empty($data['distribusi']['jaringan_distribusi']),
                    'has_trafo' => !empty($data['distribusi']['trafo'])
                ]);
            }
            
            // ===== PERFORM UPDATE =====
            if (!empty($data)) {
                $pengajuan->update($data);
                
                // Refresh pengajuan dari database
                $pengajuan = $pengajuan->fresh();
                
                // ===== VERIFY DATA AFTER UPDATE =====
                \Log::info('AFTER UPDATE - Verifying data for pengajuan ' . $id, [
                    'updated_slo_count' => is_array($pengajuan->slo) ? count($pengajuan->slo) : 'null',
                    'updated_mesin_count' => is_array($pengajuan->mesin) ? count($pengajuan->mesin) : 'null',
                    'updated_generator_count' => is_array($pengajuan->generator) ? count($pengajuan->generator) : 'null',
                    'updated_skttk_count' => is_array($pengajuan->skttk) ? count($pengajuan->skttk) : 'null',
                    'updated_status' => $pengajuan->status,
                    'has_distribusi' => !is_null($pengajuan->distribusi),
                    'has_pemakaian_sendiri' => !is_null($pengajuan->pemakaian_sendiri),
                ]);
                
                // ===== DATA INTEGRITY CHECK =====
                $integrityIssues = [];
                if (is_array($pengajuan->slo)) {
                    foreach ($pengajuan->slo as $i => $slo) {
                        $hasValidData = false;
                        foreach ($slo as $value) {
                            if (!is_null($value) && trim((string)$value) !== '') {
                                $hasValidData = true;
                                break;
                            }
                        }
                        if (!$hasValidData) {
                            $integrityIssues[] = "SLO item $i is empty";
                        }
                    }
                }
                
                if (!empty($integrityIssues)) {
                    \Log::warning('Data integrity issues found after update', [
                        'pengajuan_id' => $id,
                        'issues' => $integrityIssues
                    ]);
                }
                
                \Log::info('Pengajuan updated successfully', [
                    'pengajuan_id' => $id,
                    'final_status' => $pengajuan->status,
                    'updated_fields' => array_keys($data),
                ]);
            } else {
                \Log::info('No data to update for pengajuan ' . $id);
            }

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
