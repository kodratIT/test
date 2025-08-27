<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
{
    Schema::create('evaluasi_pengajuan', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('pengajuan_id');
        $table->unsignedBigInteger('evaluator_id');
        $table->string('status')->default('menunggu evaluasi');
        $table->timestamps();

        $table->foreign('pengajuan_id')->references('id')->on('pengajuan')->onDelete('cascade');
        $table->foreign('evaluator_id')->references('id')->on('users')->onDelete('cascade');
    });
}

    public function down()
    {
        Schema::dropIfExists('evaluasi_pengajuan');
    }
};
