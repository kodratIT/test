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
        $penggunaUsers = User::where('role_pengguna', 'pengguna')->get();

        foreach ($penggunaUsers as $index => $user) {
            // Buat beberapa pengajuan dengan status berbeda (sesuai ENUM)
            $statuses = ['proses evaluasi', 'disetujui', 'ditolak'];
            
            for ($i = 0; $i < 2; $i++) {
                $tanggal = now()->subDays(rand(1, 30))->format('Ymd');
                $nomorUrut = str_pad(($index * 2 + $i + 1), 3, '0', STR_PAD_LEFT);
                
                Pengajuan::create([
                    'pengguna_id' => $user->id,
                    'no_pengajuan' => 'LAP-' . $tanggal . '-' . $nomorUrut,
                    'status' => $statuses[$index % count($statuses)],
                    
                    // Izin Usaha
                    'nomor_izin_usaha' => 'IUPTL-' . rand(1000, 9999) . '/2024',
                    'tanggal_izin_usaha' => Carbon::now()->subMonths(rand(6, 24)),
                    'masa_berlaku_izin_usaha' => Carbon::now()->addYears(rand(5, 10)),
                    'kelebihan_listrik' => 'PT PLN (Persero)',
                    'lampiran_izin_usaha' => 'uploads/sample_izin_usaha_' . $user->id . '_' . $i . '.pdf',
                    
                    // Izin Lingkungan
                    'jenis_izin_lingkungan' => 'AMDAL',
                    'nomor_izin_lingkungan' => 'AMDAL-' . rand(100, 999) . '/2024',
                    'tanggal_izin_lingkungan' => Carbon::now()->subMonths(rand(3, 18)),
                    'masa_berlaku_izin_lingkungan' => Carbon::now()->addYears(rand(3, 7)),
                    'lampiran_izin_lingkungan' => 'uploads/sample_izin_lingkungan_' . $user->id . '_' . $i . '.pdf',
                    
                    // Sambungan Listrik
                    'sambunganListrik' => 'Tegangan Menengah 20 kV',
                    'lampiran_tagihan_listrik' => 'uploads/sample_tagihan_listrik_' . $user->id . '_' . $i . '.pdf',
                    
                    // SLO (JSON)
                    'slo' => [
                        [
                            'nomor_sertifikat_slo' => 'SLO-' . rand(1000, 9999) . '/2024',
                            'nomor_register_slo' => 'REG-SLO-' . rand(100, 999),
                            'tanggal_terbit_slo' => Carbon::now()->subMonths(rand(1, 12))->format('Y-m-d'),
                            'tanggal_masa_berlaku_slo' => Carbon::now()->addMonths(rand(6, 18))->format('Y-m-d'),
                            'lit' => 'LIT-' . rand(100, 999)
                        ],
                        [
                            'nomor_sertifikat_slo' => 'SLO-' . rand(1000, 9999) . '/2024',
                            'nomor_register_slo' => 'REG-SLO-' . rand(100, 999),
                            'tanggal_terbit_slo' => Carbon::now()->subMonths(rand(1, 12))->format('Y-m-d'),
                            'tanggal_masa_berlaku_slo' => Carbon::now()->addMonths(rand(6, 18))->format('Y-m-d'),
                            'lit' => 'LIT-' . rand(100, 999)
                        ]
                    ],
                    'lampiran_slo' => 'uploads/sample_slo_' . $user->id . '_' . $i . '.pdf',
                    
                    // SKTTK (JSON)
                    'skttk' => [
                        [
                            'nomor_sertifikat_skttk' => 'SKTTK-' . rand(1000, 9999) . '/2024',
                            'nomor_register_skttk' => 'REG-SKTTK-' . rand(100, 999),
                            'nama_skttk' => 'Andi Wijaya, S.T.',
                            'jabatan_skttk' => 'Kepala Teknik',
                            'kode_kualifikasi_skttk' => 'KT-001',
                            'kompetensi_inti1_skttk' => 'Sistem Tenaga Listrik',
                            'kompetensi_inti2_skttk' => 'Proteksi dan Kontrol',
                            'kompetensi_pilihan1_skttk' => 'SCADA',
                            'kompetensi_pilihan2_skttk' => 'Power Quality',
                            'tanggal_terbit_skttk' => Carbon::now()->subMonths(rand(6, 24))->format('Y-m-d'),
                            'tanggal_masa_berlaku_skttk' => Carbon::now()->addYears(rand(2, 5))->format('Y-m-d'),
                            'lsk_skttk' => 'LSK-' . rand(100, 999)
                        ]
                    ],
                    'lampiran_skttk' => 'uploads/sample_skttk_' . $user->id . '_' . $i . '.pdf',
                    
                    // Mesin (JSON)
                    'mesin' => [
                        [
                            'jenis_penggerak' => 'Diesel Engine',
                            'jenis_pembangkit' => 'PLTD',
                            'energi_primer' => 'Solar/HSD',
                            'mesin_merk_tipe' => 'Caterpillar C32',
                            'mesin_pabrikan' => 'Caterpillar Inc.',
                            'mesin_kapasitas' => '1000 kW',
                            'mesin_putaran' => '1500 RPM'
                        ],
                        [
                            'jenis_penggerak' => 'Gas Engine',
                            'jenis_pembangkit' => 'PLTG',
                            'energi_primer' => 'Gas Alam',
                            'mesin_merk_tipe' => 'Wartsila W20V34SG',
                            'mesin_pabrikan' => 'Wartsila Corporation',
                            'mesin_kapasitas' => '2000 kW',
                            'mesin_putaran' => '750 RPM'
                        ]
                    ],
                    'lampiran_nameplate_mesin' => 'uploads/sample_nameplate_mesin_' . $user->id . '_' . $i . '.pdf',
                    
                    // Generator (JSON)
                    'generator' => [
                        [
                            'generator_merk_tipe' => 'Stamford UCI274H',
                            'generator_pabrikan' => 'Stamford Alternators',
                            'generator_daya_mampu' => '1250 kVA',
                            'generator_tegangan' => '400 V',
                            'generator_arus' => '1804 A',
                            'generator_cos_phi' => '0.8',
                            'generator_putaran' => '1500 RPM',
                            'generator_frekuensi' => '50 Hz'
                        ],
                        [
                            'generator_merk_tipe' => 'Leroy Somer LSA 49.3',
                            'generator_pabrikan' => 'Leroy-Somer',
                            'generator_daya_mampu' => '2500 kVA',
                            'generator_tegangan' => '6300 V',
                            'generator_arus' => '229 A',
                            'generator_cos_phi' => '0.8',
                            'generator_putaran' => '750 RPM',
                            'generator_frekuensi' => '50 Hz'
                        ]
                    ],
                    'lampiran_nameplate_generator' => 'uploads/sample_nameplate_generator_' . $user->id . '_' . $i . '.pdf',
                    
                    // Distribusi (JSON dengan jaringan_distribusi dan trafo)
                    'distribusi' => [
                        'jaringan_distribusi' => [
                            [
                                'jenis_jaringan' => 'Saluran Udara Tegangan Menengah',
                                'tegangan_operasi' => '20 kV',
                                'panjang_jaringan' => '5.2 km',
                                'jumlah_gardu_distribusi' => '3 unit',
                                'kapasitas_total_gardu' => '1500 kVA'
                            ],
                            [
                                'jenis_jaringan' => 'Saluran Kabel Tegangan Rendah',
                                'tegangan_operasi' => '380 V',
                                'panjang_jaringan' => '2.8 km',
                                'jumlah_gardu_distribusi' => '2 unit',
                                'kapasitas_total_gardu' => '800 kVA'
                            ]
                        ]
                    ],
                    
                    // Pemakaian Sendiri (JSON)
                    'pemakaian_sendiri' => [
                        'kapasitas' => rand(100, 500) . ' kW',
                        'faktor_daya' => '0.' . rand(8, 95),
                        'jam_nyala' => rand(8, 24) . ' jam/hari',
                        'daya_terpakai' => rand(50, 300) . ' kW'
                    ],
                    
                    // Penjualan Listrik
                    'penjualan_listrik' => $i % 2 == 0 ? [
                        'status' => 'yes',
                        'excess_power' => [
                            rand(100, 500) . ' kW ke PT PLN',
                            rand(50, 200) . ' kW ke Industri Sekitar'
                        ]
                    ] : null,
                    
                    // Checkbox
                    'checkbox' => $i % 2 == 0 ? true : false,
                    
                    'created_at' => Carbon::now()->subDays(rand(1, 30)),
                    'updated_at' => Carbon::now()->subDays(rand(0, 5))
                ]);
            }
        }
    }
}
