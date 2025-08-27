<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kepala_bidang', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('pangkat');
            $table->string('email')->unique();
            $table->string('password'); // nanti di-hash
            $table->string('peran')->default('Kepala Bidang');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kepala_bidang');
    }
};
