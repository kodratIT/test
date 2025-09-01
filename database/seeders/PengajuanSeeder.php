<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengajuan;
use App\Models\User;
use Carbon\Carbon;

class PengajuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data pengajuan yang sudah ada dengan menangani foreign key
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Hapus data dari tabel terkait terlebih dahulu
        \DB::table('workflow_history')->truncate();
        \DB::table('evaluasi_pengajuan')->truncate();
        \DB::table('activity_logs')->truncate();
        
        // Kemudian hapus data pengajuan
        \DB::table('pengajuan')->truncate();
        
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        $penggunaUsers = User::where('role_pengguna', 'pengguna')->get();
        $evaluators = User::where('role_pengguna', 'evaluator')->pluck('id')->toArray();
        $kabidUser = User::where('role_pengguna', 'kabid')->first();
        $kadisUser = User::where('role_pengguna', 'kadis')->first();

        // Status workflow yang sesuai dengan sistem baru
        $statusWorkflow = [
            'proses evaluasi', // Belum ditugaskan ke evaluator atau sedang dievaluasi
            'evaluasi',        // Selesai evaluasi, menunggu approval Kabid
            'validasi',        // Disetujui Kabid, menunggu approval Kadis
            'menunggu persetujuan kadis', // Alternatif status untuk Kadis
            'disetujui kadis', // Disetujui Kadis (final)
            'perbaikan'        // Ditolak, perlu perbaikan
        ];

        // Data perusahaan pembangkit yang realistis
        $perusahaanData = [
            ['nama' => 'PT Energi Nusantara', 'tipe' => 'PLTD', 'kapasitas' => '5000 kW'],
            ['nama' => 'PT Bayu Listrik Indonesia', 'tipe' => 'PLTB', 'kapasitas' => '10000 kW'],
            ['nama' => 'PT Solar Mandiri Energy', 'tipe' => 'PLTS', 'kapasitas' => '2000 kW'],
            ['nama' => 'PT Hidropower Jaya', 'tipe' => 'PLTM', 'kapasitas' => '1500 kW'],
            ['nama' => 'PT Gas Turbin Indonesia', 'tipe' => 'PLTG', 'kapasitas' => '25000 kW'],
            ['nama' => 'PT Biomassa Energi', 'tipe' => 'PLTBm', 'kapasitas' => '3000 kW'],
            ['nama' => 'PT Geothermal Nusantara', 'tipe' => 'PLTP', 'kapasitas' => '15000 kW']
        ];

        $teknisiNames = [
            'Ir. Ahmad Wijaya, M.T.', 'Budi Santoso, S.T.', 'Andi Rahman, S.T.', 
            'Siti Nurhaliza, S.T.', 'Denny Prasetyo, M.T.', 'Rina Kartika, S.T.',
            'Agus Setiawan, S.T.', 'Maya Sari, M.T.'
        ];

        $counter = 1;
        
        foreach ($penggunaUsers as $userIndex => $user) {
            $numPengajuan = rand(2, 4); // Setiap user punya 2-4 pengajuan
            
            for ($i = 0; $i < $numPengajuan; $i++) {
                $createdDate = Carbon::now()->subDays(rand(1, 90));
                $tanggal = $createdDate->format('Ymd');
                $nomorUrut = str_pad($counter, 4, '0', STR_PAD_LEFT);
                
                // Pilih status berdasarkan probabilitas untuk simulasi workflow yang realistis
                $statusProbability = [
                    'proses evaluasi' => 30,     // 30% sedang proses evaluasi
                    'evaluasi' => 25,            // 25% menunggu approval kabid
                    'validasi' => 15,            // 15% menunggu approval kadis
                    'menunggu persetujuan kadis' => 10, // 10% menunggu kadis
                    'disetujui kadis' => 15,     // 15% sudah disetujui
                    'perbaikan' => 5             // 5% perlu perbaikan
                ];
                
                $randomValue = rand(1, 100);
                $cumulativeProb = 0;
                $selectedStatus = 'proses evaluasi';
                
                foreach ($statusProbability as $status => $prob) {
                    $cumulativeProb += $prob;
                    if ($randomValue <= $cumulativeProb) {
                        $selectedStatus = $status;
                        break;
                    }
                }

                $perusahaan = $perusahaanData[array_rand($perusahaanData)];
                $teknisi = $teknisiNames[array_rand($teknisiNames)];
                
                // Set evaluator_id jika status bukan proses evaluasi awal
                $evaluatorId = null;
                $assignedAt = null;
                $approvedKabidAt = null;
                $approvedKadisAt = null;
                
                if (in_array($selectedStatus, ['evaluasi', 'validasi', 'menunggu persetujuan kadis', 'disetujui kadis', 'perbaikan'])) {
                    $evaluatorId = $evaluators[array_rand($evaluators)];
                    $assignedAt = $createdDate->copy()->addDays(rand(1, 3));
                }
                
                if (in_array($selectedStatus, ['validasi', 'menunggu persetujuan kadis', 'disetujui kadis'])) {
                    $approvedKabidAt = $assignedAt->copy()->addDays(rand(2, 7));
                }
                
                if ($selectedStatus === 'disetujui kadis') {
                    $approvedKadisAt = $approvedKabidAt->copy()->addDays(rand(1, 5));
                }
                
                Pengajuan::create([
                    'pengguna_id' => $user->id,
                    'no_pengajuan' => 'LB-' . $tanggal . '-' . $nomorUrut,
                    'status' => $selectedStatus,
                    'evaluator_id' => $evaluatorId,
                    'assigned_at' => $assignedAt,
                    'approved_by_kabid_at' => $approvedKabidAt,
                    'approved_by_kabid_id' => $approvedKabidAt ? $kabidUser?->id : null,
                    
                    // Catatan sesuai status
                    'catatan_kabid' => in_array($selectedStatus, ['validasi', 'menunggu persetujuan kadis', 'disetujui kadis']) 
                        ? 'Laporan telah dievaluasi dan memenuhi persyaratan teknis. Disetujui untuk diteruskan ke Kadis.' 
                        : null,
                    
                    // Izin Usaha
                    'nomor_izin_usaha' => 'IUPTL/' . rand(100, 999) . '/DESDM/' . (2020 + rand(0, 4)),
                    'tanggal_izin_usaha' => Carbon::now()->subMonths(rand(6, 48)),
                    'masa_berlaku_izin_usaha' => Carbon::now()->addYears(rand(5, 15)),
                    'kelebihan_listrik' => rand(0, 1) ? 'PT PLN (Persero)' : 'Industri Sekitar',
                    'lampiran_izin_usaha' => 'uploads/izin_usaha/' . $user->id . '_' . $counter . '.pdf',
                    
                    // Izin Lingkungan
                    'jenis_izin_lingkungan' => ['AMDAL', 'UKL-UPL', 'SPPL'][rand(0, 2)],
                    'nomor_izin_lingkungan' => 'AMDAL/' . rand(100, 999) . '/DLH/' . (2019 + rand(0, 5)),
                    'tanggal_izin_lingkungan' => Carbon::now()->subMonths(rand(3, 36)),
                    'masa_berlaku_izin_lingkungan' => Carbon::now()->addYears(rand(3, 10)),
                    'lampiran_izin_lingkungan' => 'uploads/izin_lingkungan/' . $user->id . '_' . $counter . '.pdf',
                    
                    // Sambungan Listrik
                    'sambunganListrik' => ['Tegangan Menengah 20 kV', 'Tegangan Tinggi 150 kV', 'Tegangan Rendah 380 V'][rand(0, 2)],
                    'lampiran_tagihan_listrik' => 'uploads/tagihan_listrik/' . $user->id . '_' . $counter . '.pdf',
                    
                    // SLO (JSON)
                    'slo' => $this->generateSLOData($perusahaan['tipe']),
                    'lampiran_slo' => 'uploads/slo/' . $user->id . '_' . $counter . '.pdf',
                    
                    // SKTTK (JSON)
                    'skttk' => $this->generateSKTTKData($teknisi, $perusahaan['tipe']),
                    'lampiran_skttk' => 'uploads/skttk/' . $user->id . '_' . $counter . '.pdf',
                    
                    // Mesin (JSON)
                    'mesin' => $this->generateMesinData($perusahaan['tipe'], $perusahaan['kapasitas']),
                    'lampiran_nameplate_mesin' => 'uploads/nameplate_mesin/' . $user->id . '_' . $counter . '.pdf',
                    
                    // Generator (JSON)
                    'generator' => $this->generateGeneratorData($perusahaan['tipe'], $perusahaan['kapasitas']),
                    'lampiran_nameplate_generator' => 'uploads/nameplate_generator/' . $user->id . '_' . $counter . '.pdf',
                    
                    // Distribusi (JSON)
                    'distribusi' => $this->generateDistribusiData($perusahaan['kapasitas']),
                    
                    // Pemakaian Sendiri (JSON)
                    'pemakaian_sendiri' => [
                        'kapasitas' => rand(5, 15) . '% dari total kapasitas',
                        'faktor_daya' => '0.' . rand(80, 95),
                        'jam_nyala' => rand(16, 24) . ' jam/hari',
                        'daya_terpakai' => rand(100, 500) . ' kW',
                        'efisiensi' => rand(85, 95) . '%'
                    ],
                    
                    // Penjualan Listrik
                    'penjualan_listrik' => rand(0, 1) ? [
                        'status' => 'yes',
                        'kontrak' => 'PPA dengan PT PLN',
                        'tarif' => 'Rp ' . rand(800, 1200) . '/kWh',
                        'excess_power' => [
                            rand(500, 2000) . ' kW ke PT PLN',
                            rand(100, 500) . ' kW ke Industri Lokal'
                        ]
                    ] : [
                        'status' => 'no',
                        'alasan' => 'Untuk kebutuhan sendiri'
                    ],
                    
                    // Checkbox
                    'checkbox' => rand(0, 1) ? true : false,
                    
                    'created_at' => $createdDate,
                    'updated_at' => $createdDate->copy()->addDays(rand(0, 10))
                ]);
                
                $counter++;
            }
        }
    }
    
    private function generateSLOData($tipe)
    {
        $sloCount = rand(1, 3);
        $sloData = [];
        
        for ($i = 0; $i < $sloCount; $i++) {
            $sloData[] = [
                'nomor_sertifikat_slo' => 'SLO/' . rand(1000, 9999) . '/2024',
                'nomor_register_slo' => 'REG-SLO-' . rand(10000, 99999),
                'tanggal_terbit_slo' => Carbon::now()->subMonths(rand(1, 18))->format('Y-m-d'),
                'tanggal_masa_berlaku_slo' => Carbon::now()->addMonths(rand(12, 60))->format('Y-m-d'),
                'lit' => 'LIT-' . rand(1000, 9999),
                'tipe_pembangkit' => $tipe
            ];
        }
        
        return $sloData;
    }
    
    private function generateSKTTKData($teknisi, $tipe)
    {
        return [
            [
                'nomor_sertifikat_skttk' => 'SKTTK/' . rand(1000, 9999) . '/2024',
                'nomor_register_skttk' => 'REG-SKTTK-' . rand(10000, 99999),
                'nama_skttk' => $teknisi,
                'jabatan_skttk' => ['Kepala Teknik', 'Manager Operasi', 'Supervisor Pembangkit'][rand(0, 2)],
                'kode_kualifikasi_skttk' => 'KT-' . rand(100, 999),
                'kompetensi_inti1_skttk' => 'Sistem Tenaga Listrik',
                'kompetensi_inti2_skttk' => 'Operasi dan Pemeliharaan ' . $tipe,
                'kompetensi_pilihan1_skttk' => 'Proteksi dan Kontrol',
                'kompetensi_pilihan2_skttk' => 'SCADA dan Monitoring System',
                'tanggal_terbit_skttk' => Carbon::now()->subMonths(rand(6, 36))->format('Y-m-d'),
                'tanggal_masa_berlaku_skttk' => Carbon::now()->addYears(rand(2, 5))->format('Y-m-d'),
                'lsk_skttk' => 'LSK-' . rand(100, 999)
            ]
        ];
    }
    
    private function generateMesinData($tipe, $kapasitas)
    {
        $kapasitasNum = intval(str_replace(' kW', '', $kapasitas));
        
        $mesinConfig = [
            'PLTD' => [
                'jenis_penggerak' => 'Diesel Engine',
                'energi_primer' => 'Solar/HSD',
                'merk' => ['Caterpillar', 'Cummins', 'Perkins', 'MAN'][rand(0, 3)],
                'putaran' => '1500 RPM'
            ],
            'PLTG' => [
                'jenis_penggerak' => 'Gas Turbine',
                'energi_primer' => 'Gas Alam',
                'merk' => ['GE', 'Siemens', 'Mitsubishi', 'Ansaldo'][rand(0, 3)],
                'putaran' => '3000 RPM'
            ],
            'PLTS' => [
                'jenis_penggerak' => 'Solar Panel',
                'energi_primer' => 'Sinar Matahari',
                'merk' => ['Trina Solar', 'JinkoSolar', 'Canadian Solar'][rand(0, 2)],
                'putaran' => 'N/A'
            ],
            'PLTB' => [
                'jenis_penggerak' => 'Wind Turbine',
                'energi_primer' => 'Angin',
                'merk' => ['Vestas', 'Gamesa', 'GE Wind'][rand(0, 2)],
                'putaran' => '15-30 RPM'
            ]
        ];
        
        $config = $mesinConfig[$tipe] ?? $mesinConfig['PLTD'];
        
        return [
            [
                'jenis_penggerak' => $config['jenis_penggerak'],
                'jenis_pembangkit' => $tipe,
                'energi_primer' => $config['energi_primer'],
                'mesin_merk_tipe' => $config['merk'] . ' ' . strtoupper(substr($tipe, 0, 3)) . '-' . rand(100, 999),
                'mesin_pabrikan' => $config['merk'] . ' Corporation',
                'mesin_kapasitas' => $kapasitas,
                'mesin_putaran' => $config['putaran']
            ]
        ];
    }
    
    private function generateGeneratorData($tipe, $kapasitas)
    {
        $kapasitasNum = intval(str_replace(' kW', '', $kapasitas));
        $dayaKVA = intval($kapasitasNum * 1.25); // Asumsi cos φ = 0.8
        
        $generatorBrands = ['Stamford', 'Leroy Somer', 'Marathon', 'Mecc Alte'];
        $brand = $generatorBrands[rand(0, 3)];
        
        return [
            [
                'generator_merk_tipe' => $brand . ' ' . strtoupper(substr($tipe, 0, 2)) . rand(100, 999),
                'generator_pabrikan' => $brand . ' International',
                'generator_daya_mampu' => $dayaKVA . ' kVA',
                'generator_tegangan' => $kapasitasNum > 5000 ? '6300 V' : '400 V',
                'generator_arus' => intval($dayaKVA * 1000 / 400) . ' A',
                'generator_cos_phi' => '0.8',
                'generator_putaran' => ['1500 RPM', '3000 RPM'][rand(0, 1)],
                'generator_frekuensi' => '50 Hz'
            ]
        ];
    }
    
    private function generateDistribusiData($kapasitas)
    {
        $kapasitasNum = intval(str_replace(' kW', '', $kapasitas));
        $isLargeCapacity = $kapasitasNum > 10000;
        
        return [
            'jaringan_distribusi' => [
                [
                    'jenis_jaringan' => $isLargeCapacity ? 'Saluran Udara Tegangan Tinggi' : 'Saluran Udara Tegangan Menengah',
                    'tegangan_operasi' => $isLargeCapacity ? '150 kV' : '20 kV',
                    'panjang_jaringan' => rand(2, 15) . '.' . rand(1, 9) . ' km',
                    'jumlah_gardu_distribusi' => rand(2, 8) . ' unit',
                    'kapasitas_total_gardu' => rand(1000, 5000) . ' kVA'
                ],
                [
                    'jenis_jaringan' => 'Saluran Kabel Tegangan Rendah',
                    'tegangan_operasi' => '380 V',
                    'panjang_jaringan' => rand(1, 5) . '.' . rand(1, 9) . ' km',
                    'jumlah_gardu_distribusi' => rand(1, 3) . ' unit',
                    'kapasitas_total_gardu' => rand(500, 2000) . ' kVA'
                ]
            ]
        ];
    }
}
