<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengajuan', function (Blueprint $table) {
            // tambahkan setelah field terkait
            $table->string('lampiran_slo')->nullable()->after('slo');
            $table->string('lampiran_skttk')->nullable()->after('skttk');
            $table->string('lampiran_nameplate_mesin')->nullable()->after('mesin');
            $table->string('lampiran_nameplate_generator')->nullable()->after('generator');
            $table->boolean('checkbox')->default(false)->after('pemakaian_sendiri');
        });
    }

    public function down(): void
    {
        Schema::table('pengajuan', function (Blueprint $table) {
            $table->dropColumn([
                'lampiran_slo',
                'lampiran_skttk',
                'lampiran_nameplate_mesin',
                'lampiran_nameplate_generator',
                'checkbox',
            ]);
        });
    }
};