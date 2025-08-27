<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pengajuan', function (Blueprint $table) {
            $table->dropColumn([
                'pemilik_trafo',
                'tegangan_primer_trafo',
                'tegangan_sekunder_trafo',
                'kapasitas_daya_trafo',
                'kabupaten_kota_trafo',
                'provinsi_trafo',
                'latitude_trafo',
                'longitude_trafo',
                'tahun_operasi_trafo',
                
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('pengajuan', function (Blueprint $table) {
            $table->string('pemilik_trafo')->nullable();
            $table->string('tegangan_primer_trafo')->nullable();
            $table->string('tegangan_sekunder_trafo')->nullable();
            $table->string('kapasitas_daya_trafo')->nullable();
            $table->string('kabupaten_kota_trafo')->nullable();
            $table->string('provinsi_trafo')->nullable();
            $table->string('latitude_trafo')->nullable();
            $table->string('longitude_trafo')->nullable();
            $table->string('tahun_operasi_trafo')->nullable();
            $table->string('lainnya')->nullable();
        });
    }
};