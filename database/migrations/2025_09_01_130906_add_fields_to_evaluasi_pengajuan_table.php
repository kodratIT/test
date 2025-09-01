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
        Schema::table('evaluasi_pengajuan', function (Blueprint $table) {
            // Assignment tracking
            $table->timestamp('assigned_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->text('catatan_penugasan')->nullable();
            
            // Performance metrics
            $table->integer('evaluation_days')->nullable(); // Auto calculated
            $table->decimal('rating', 3, 1)->nullable(); // Rating 1-5
            
            // Additional tracking
            $table->json('metadata')->nullable(); // Additional data if needed
            
            // Indexes
            $table->index(['assigned_at']);
            $table->index(['completed_at']);
            $table->index(['status', 'assigned_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('evaluasi_pengajuan', function (Blueprint $table) {
            $table->dropIndex(['assigned_at']);
            $table->dropIndex(['completed_at']);
            $table->dropIndex(['status', 'assigned_at']);
            
            $table->dropColumn([
                'assigned_at',
                'completed_at',
                'catatan_penugasan',
                'evaluation_days',
                'rating',
                'metadata'
            ]);
        });
    }
};
