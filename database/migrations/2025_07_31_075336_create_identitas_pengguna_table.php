<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('identitas_pengguna', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengguna_id')->constrained('users')->onDelete('cascade');
            $table->string('nama')->nullable();
            $table->string('namabadanusaha')->nullable();
            $table->string('nib')->nullable();
            $table->string('email_perusahaan')->nullable();
            $table->string('alamatkantorpusat')->nullable();
            $table->string('notelpkantorpusat')->nullable();
            $table->string('alamatkantorcabang')->nullable();
            $table->string('notelpkantorcabang')->nullable();
            $table->string('contact_person_nama')->nullable();
            $table->string('contact_person_jabatan')->nullable();
            $table->string('contact_person_email')->nullable();
            $table->string('contact_person_no_telp')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('identitas_pengguna');
    }
};
