<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengajuan', function (Blueprint $table) {
            $table->unsignedBigInteger('pengguna_id')->nullable()->after('id');
            $table->string('no_pengajuan')->nullable()->after('pengguna_id');
            $table->enum('status', ['proses evaluasi', 'disetujui', 'ditolak'])->default('proses evaluasi')->after('no_pengajuan');

            // kalau ingin relasi ke tabel users / identitas_pengguna, bisa aktifkan ini:
            // $table->foreign('pengguna_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan', function (Blueprint $table) {
            $table->dropColumn(['pengguna_id', 'no_pengajuan', 'status']);
        });
    }
};

