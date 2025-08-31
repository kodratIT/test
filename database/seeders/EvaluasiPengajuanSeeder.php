<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EvaluasiPengajuan;
use App\Models\Pengajuan;
use App\Models\User;

class EvaluasiPengajuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $evaluators = User::where('role_pengguna', 'evaluator')->get();
        $pengajuans = Pengajuan::all();

        foreach ($pengajuans as $index => $pengajuan) {
            // Skip pengajuan dengan status 'proses evaluasi' (belum ada evaluator)
            if ($pengajuan->status === 'proses evaluasi') {
                continue;
            }

            // Assign evaluator secara round-robin
            $evaluator = $evaluators[$index % $evaluators->count()];
            
            // Tentukan status evaluasi berdasarkan status pengajuan
            $statusEvaluasi = match($pengajuan->status) {
                'disetujui' => 'disetujui',
                'ditolak' => 'ditolak',
                default => 'menunggu evaluasi'
            };

            $catatan = match($pengajuan->status) {
                'ditolak' => 'Dokumen SLO perlu diperbaharui. Masa berlaku hampir habis. Mohon upload ulang sertifikat SLO yang masih berlaku.',
                'disetujui' => 'Semua dokumen telah memenuhi persyaratan. Laporan berkala dapat disetujui.',
                default => null
            };

            EvaluasiPengajuan::create([
                'pengajuan_id' => $pengajuan->id,
                'evaluator_id' => $evaluator->id,
                'status' => $statusEvaluasi,
                'catatan' => $catatan,
                'created_at' => $pengajuan->created_at->addHours(rand(1, 24)),
                'updated_at' => $pengajuan->updated_at
            ]);

            // Update evaluator_id di tabel pengajuan
            $pengajuan->update(['evaluator_id' => $evaluator->id]);
        }
    }
}
