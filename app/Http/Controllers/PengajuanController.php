<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Pengajuan;
use App\Models\EvaluasiPengajuan;
use App\Models\User;





class PengajuanController extends Controller
{

    public function show($id)
    {
        $pengajuan = Pengajuan::with(['pengguna.identitas'])->findOrFail($id);

        // 🔹 ambil semua evaluator
        $evaluators = User::where('role_pengguna', 'evaluator')->get();

        // 🔹 ambil evaluasi yang sudah pernah dikirim (opsional, buat ditampilkan di detail)
        $evaluasi = EvaluasiPengajuan::where('pengajuan_id', $id)->get();

        return view('pengajuan.detail', compact('pengajuan', 'evaluators', 'evaluasi'));
    }

    public function edit($id)
    {
        $pengajuan = Pengajuan::with(['pengguna.identitas', 'evaluasiPengajuan.evaluator'])->findOrFail($id);
        
        // Get the latest evaluation if exists
        $latestEvaluation = $pengajuan->evaluasiPengajuan()->latest()->first();
        
        return view('pengajuan.edit', compact('pengajuan', 'latestEvaluation'));
    }

    public function update(Request $request, $id)
    {
        $pengajuan = Pengajuan::findOrFail($id);

        // Validasi minimal
        $request->validate([
            'nomor_izin_usaha' => 'nullable|string|max:255',
            'kelebihan_listrik' => 'nullable|string|max:255',
            'penjualan_listrik' => 'nullable|string|max:10',
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
                Storage::delete($pengajuan->lampiran_izin_usaha);
            }
            $data['lampiran_izin_usaha'] = $request->file('lampiran_izin_usaha')->store('uploads');
        }
        
        if ($request->hasFile('lampiran_izin_lingkungan')) {
            if ($pengajuan->lampiran_izin_lingkungan) {
                Storage::delete($pengajuan->lampiran_izin_lingkungan);
            }
            $data['lampiran_izin_lingkungan'] = $request->file('lampiran_izin_lingkungan')->store('uploads');
        }
        
        if ($request->hasFile('lampiran_tagihan_listrik')) {
            if ($pengajuan->lampiran_tagihan_listrik) {
                Storage::delete($pengajuan->lampiran_tagihan_listrik);
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
                Storage::delete($pengajuan->lampiran_slo);
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
                Storage::delete($pengajuan->lampiran_skttk);
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
                Storage::delete($pengajuan->lampiran_nameplate_mesin);
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
                Storage::delete($pengajuan->lampiran_nameplate_generator);
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

        return redirect()->back()->with('success', 'Data pengajuan berhasil diperbarui.');
    }


    public function store(Request $request)
    {
        //dd($request->all());
        // Validasi minimal (silakan tambah sesuai kebutuhan)
        $request->validate([
            'nomor_izin_usaha' => 'nullable|string|max:255',
            'kelebihan_listrik' => 'nullable|string|max:255',
            'kapasitas',
            'faktor_daya',
            'jam_nyala',
            'daya_terpakai',
            'penjualan_listrik' => 'nullable|string|max:10',
            
        ]);


        // ===== Field statis (kecuali file, file ditangani terpisah) =====
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



        $userId = Auth::id();
        $data['pengguna_id'] = $userId;

        // ambil tanggal hari ini
        $tanggal = now()->format('Ymd');

        // cari data terakhir
        $last = Pengajuan::orderBy('id', 'desc')->first();

        if ($last) {
            // ambil nomor urut dari no_pengajuan terakhir
            $lastNumber = (int) substr($last->no_pengajuan, -3);
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        // format jadi 3 digit
        $nextNumberFormatted = str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        // gabungkan
        $data['no_pengajuan'] = 'LAP-' . $tanggal . '-' . $nextNumberFormatted;

        // status default
        $data['status'] = 'proses evaluasi';


   // ✅ Checkbox
    $data['checkbox'] = $request->has('checkbox') ? 1 : 0;


        // ===== Penjualan Listrik =====
        if ($request->input('penjualan_listrik') === 'yes') {
            // Simpan detail langsung di kolom penjualan_listrik (format JSON)
            $data['penjualan_listrik'] = [
                'status' => 'yes',
                'excess_power' => array_values($request->input('excess_power', [])),
            ];
        } else {
            // Kosongkan kolom penjualan_listrik jika Tidak
            $data['penjualan_listrik'] = null;
        }






        // ===== File statis =====
        if ($request->hasFile('lampiran_izin_usaha')) {
            $data['lampiran_izin_usaha'] = $request->file('lampiran_izin_usaha')->store('uploads');
        }
        if ($request->hasFile('lampiran_izin_lingkungan')) {
            $data['lampiran_izin_lingkungan'] = $request->file('lampiran_izin_lingkungan')->store('uploads');
        }
        if ($request->hasFile('lampiran_tagihan_listrik')) {
            $data['lampiran_tagihan_listrik'] = $request->file('lampiran_tagihan_listrik')->store('uploads');
        }


       // ✅ SLO (JSON) + lampiran_slo (kolom sendiri)
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

        if ($request->hasFile('lampiran_slo')) {
            $data['lampiran_slo'] = $request->file('lampiran_slo')->store('uploads');
        }
    }


  // ✅ SKTTK (JSON) + lampiran_skttk (kolom sendiri)
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

        if ($request->hasFile('lampiran_skttk')) {
            $data['lampiran_skttk'] = $request->file('lampiran_skttk')->store('uploads');
        }
    }

    // ✅ Mesin (JSON) + lampiran_nameplate_mesin (kolom sendiri)
    $mesinList = [];
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
    $data['mesin'] = $mesinList;

    if ($request->hasFile('lampiran_nameplate_mesin')) {
        $data['lampiran_nameplate_mesin'] = $request->file('lampiran_nameplate_mesin')->store('uploads');
    }


  // ✅ Generator (JSON) + lampiran_nameplate_generator (kolom sendiri)
    $generatorList = [];
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
    $data['generator'] = $generatorList;

    if ($request->hasFile('lampiran_nameplate_generator')) {
        $data['lampiran_nameplate_generator'] = $request->file('lampiran_nameplate_generator')->store('uploads');
    }


  // ✅ Pemakaian Sendiri (JSON)
    $data['pemakaian_sendiri'] = $this->mapDynamicGroup(
        $request->pemakaian_sendiri,
        ['kapasitas', 'faktor_daya', 'jam_nyala', 'daya_terpakai']
    );



     // ✅ Distribusi (JSON)
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

    Pengajuan::create($data);

    return back()->with('success', 'Data pengajuan berhasil disimpan.');
}



    public function kirimKeEvaluator(Request $request, $id)
    {
        $request->validate([
            'evaluator_id' => 'required|exists:users,id',
            'catatan_penugasan' => 'nullable|string|max:500',
        ]);

        DB::beginTransaction();
        try {
            $pengajuan = Pengajuan::findOrFail($id);
            
            // Validasi status pengajuan
            if (!in_array($pengajuan->status, ['proses evaluasi', 'masuk'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pengajuan tidak dapat dikirim dengan status: ' . $pengajuan->status
                ], 400);
            }
            
            // Validasi evaluator
            $evaluator = User::where('id', $request->evaluator_id)
                ->where('role_pengguna', 'evaluator')
                ->first();
                
            if (!$evaluator) {
                return response()->json([
                    'success' => false,
                    'message' => 'Evaluator tidak valid atau tidak aktif.'
                ], 400);
            }

            // Cek workload evaluator (opsional - bisa diatur max pending per evaluator)
            $currentWorkload = EvaluasiPengajuan::where('evaluator_id', $request->evaluator_id)
                ->where('status', 'menunggu evaluasi')
                ->count();
                
            if ($currentWorkload >= 10) { // Max 10 pending evaluations
                return response()->json([
                    'success' => false,
                    'message' => 'Evaluator ' . $evaluator->name . ' sudah memiliki terlalu banyak tugas pending (' . $currentWorkload . ').'
                ], 400);
            }

            // Update pengajuan
            $pengajuan->update([
                'evaluator_id' => $request->evaluator_id,
                'status' => 'proses evaluasi',
                'assigned_at' => now(),
                'assigned_by' => Auth::id(),
            ]);

            // Buat atau update record evaluasi
            EvaluasiPengajuan::updateOrCreate(
                [
                    'pengajuan_id' => $pengajuan->id,
                    'evaluator_id' => $request->evaluator_id,
                ],
                [
                    'status' => 'menunggu evaluasi',
                    'catatan_penugasan' => $request->catatan_penugasan,
                    'assigned_at' => now(),
                ]
            );

            // Log activity
            $this->logActivity($pengajuan->id, 'assigned', 
                'Pengajuan ditugaskan ke evaluator: ' . $evaluator->name, 
                $request->catatan_penugasan);

            // TODO: Send notification email to evaluator
            // $this->sendAssignmentNotification($pengajuan, $evaluator);

            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Pengajuan berhasil dikirim ke evaluator: ' . $evaluator->name
            ]);
            
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false, 
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
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

    private function logActivity($pengajuanId, $action, $description, $notes = null)
    {
        DB::table('activity_logs')->insert([
            'pengajuan_id' => $pengajuanId,
            'user_id' => Auth::id(),
            'action' => $action,
            'description' => $description,
            'notes' => $notes,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
