<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pengajuan', function (Blueprint $table) {
            // Catatan perbaikan per section
            $table->text('catatan_perbaikan_data_pemilik')->nullable()->after('evaluator_notes');
            $table->text('catatan_perbaikan_izin_usaha')->nullable()->after('catatan_perbaikan_data_pemilik');
            $table->text('catatan_perbaikan_izin_lingkungan')->nullable()->after('catatan_perbaikan_izin_usaha');
            $table->text('catatan_perbaikan_slo')->nullable()->after('catatan_perbaikan_izin_lingkungan');
            $table->text('catatan_perbaikan_skttk')->nullable()->after('catatan_perbaikan_slo');
            $table->text('catatan_perbaikan_data_mesin')->nullable()->after('catatan_perbaikan_skttk');
            $table->text('catatan_perbaikan_data_generator')->nullable()->after('catatan_perbaikan_data_mesin');
            $table->text('catatan_perbaikan_sambungan_listrik')->nullable()->after('catatan_perbaikan_data_generator');
            $table->text('catatan_perbaikan_kapasitas_produksi')->nullable()->after('catatan_perbaikan_sambungan_listrik');
            $table->text('catatan_perbaikan_excess_power')->nullable()->after('catatan_perbaikan_kapasitas_produksi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan', function (Blueprint $table) {
            $table->dropColumn([
                'catatan_perbaikan_data_pemilik',
                'catatan_perbaikan_izin_usaha',
                'catatan_perbaikan_izin_lingkungan',
                'catatan_perbaikan_slo',
                'catatan_perbaikan_skttk',
                'catatan_perbaikan_data_mesin',
                'catatan_perbaikan_data_generator',
                'catatan_perbaikan_sambungan_listrik',
                'catatan_perbaikan_kapasitas_produksi',
                'catatan_perbaikan_excess_power'
            ]);
        });
    }
};
