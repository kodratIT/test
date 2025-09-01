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
            // Kabid approval fields
            $table->timestamp('approved_by_kabid_at')->nullable();
            $table->unsignedBigInteger('approved_by_kabid_id')->nullable();
            $table->text('catatan_kabid')->nullable();
            
            // Kabid rejection fields
            $table->timestamp('rejected_by_kabid_at')->nullable();
            $table->unsignedBigInteger('rejected_by_kabid_id')->nullable();
            $table->string('alasan_penolakan', 500)->nullable();
            
            // Assignment tracking
            $table->timestamp('assigned_at')->nullable();
            $table->unsignedBigInteger('assigned_by')->nullable();
            $table->timestamp('reassigned_at')->nullable();
            $table->unsignedBigInteger('reassigned_by')->nullable();
            
            // Foreign key constraints
            $table->foreign('approved_by_kabid_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('rejected_by_kabid_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('assigned_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('reassigned_by')->references('id')->on('users')->onDelete('set null');
            
            // Indexes for performance
            $table->index(['approved_by_kabid_at']);
            $table->index(['rejected_by_kabid_at']);
            $table->index(['assigned_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan', function (Blueprint $table) {
            $table->dropForeign(['approved_by_kabid_id']);
            $table->dropForeign(['rejected_by_kabid_id']);
            $table->dropForeign(['assigned_by']);
            $table->dropForeign(['reassigned_by']);
            
            $table->dropIndex(['approved_by_kabid_at']);
            $table->dropIndex(['rejected_by_kabid_at']);
            $table->dropIndex(['assigned_at']);
            
            $table->dropColumn([
                'approved_by_kabid_at',
                'approved_by_kabid_id',
                'catatan_kabid',
                'rejected_by_kabid_at',
                'rejected_by_kabid_id',
                'alasan_penolakan',
                'assigned_at',
                'assigned_by',
                'reassigned_at',
                'reassigned_by'
            ]);
        });
    }
};
