<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->id();

            // ===== Field statis =====
            $table->string('nomor_izin_usaha')->nullable();
            $table->date('tanggal_izin_usaha')->nullable();
            $table->date('masa_berlaku_izin_usaha')->nullable();

            // Lampiran izin usaha (satu file saja)
            $table->string('lampiran_izin_usaha')->nullable();

            // Izin lingkungan
            $table->string('jenis_izin_lingkungan')->nullable();
            $table->string('nomor_izin_lingkungan')->nullable();
            $table->date('tanggal_izin_lingkungan')->nullable();
            $table->date('masa_berlaku_izin_lingkungan')->nullable();
            $table->string('lampiran_izin_lingkungan')->nullable();

            // Sambungan listrik (dropdown atau text input)
            $table->string('sambunganListrik')->nullable();

            // Data trafo (statis — hanya satu set)
            $table->string('pemilik_trafo')->nullable();
            $table->string('tegangan_primer_trafo')->nullable();
            $table->string('tegangan_sekunder_trafo')->nullable();
            $table->string('kapasitas_daya_trafo')->nullable();
            $table->string('kabupaten_kota_trafo')->nullable();
            $table->string('provinsi_trafo')->nullable();
            $table->string('latitude_trafo')->nullable();
            $table->string('longitude_trafo')->nullable();
            $table->string('tahun_operasi_trafo')->nullable();

            // Tagihan listrik (satu file)
            $table->string('lampiran_tagihan_listrik')->nullable();

            // ===== Field dinamis (disimpan sebagai JSON) =====
            $table->json('slo')->nullable();        // Array of objects: nomor_sertifikat_slo, nomor_register_slo, tanggal..., lit, lampiran_slo
            $table->json('skttk')->nullable();      // Array of objects: nomor_sertifikat_skttk, nama_skttk, jabatan, dll, lampiran_skttk
            $table->json('mesin')->nullable();      // Array of objects: jenis_penggerak, mesin_merk_tipe, dll, lampiran_nameplate_mesin
            $table->json('generator')->nullable();  // Array of objects: generator_merk_tipe, kapasitas, dll, lampiran_nameplate_generator

            // JSON gabungan:
            // 'jaringan_distribusi' => array dinamis
            // 'trafo' => objek statis
            $table->json('distribusi')->nullable();

            // Data tambahan lain yang dinamis
            // $table->json('lainnya')->nullable();

            // Dropdown "Apakah ada penjualan kelebihan tenaga listrik?" (Ada / Tidak)
            $table->json('penjualan_listrik')->nullable();

            $table->timestamps();
        });
    }
};
