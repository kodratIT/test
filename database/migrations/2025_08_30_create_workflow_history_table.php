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
        // Create workflow history table for pengajuan audit trail
        Schema::create('workflow_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_id')->constrained('pengajuan')->cascadeOnDelete();
            
            // State Change Details
            $table->string('from_level', 20)->nullable();
            $table->string('to_level', 20);
            $table->string('from_status', 50)->nullable();
            $table->string('to_status', 50);
            
            // Action Details
            $table->enum('action_type', [
                'submit', 'approve', 'reject', 'request_revision',
                'revise', 'reassign', 'escalate', 'archive'
            ]);
            
            // Actor Information
            $table->foreignId('actor_id')->nullable()->constrained('users');
            $table->string('actor_role', 20)->nullable();
            
            // Comments and Reasons
            $table->text('rejection_reason')->nullable();
            $table->text('revision_notes')->nullable();
            $table->json('metadata')->nullable();
            
            // Timeline
            $table->timestamp('processed_at');
            $table->timestamps();
            
            // Indexes for performance
            $table->index(['pengajuan_id', 'created_at'], 'wf_hist_pengajuan_created_idx');
            $table->index(['action_type', 'created_at'], 'wf_hist_action_created_idx');
            $table->index(['to_level', 'processed_at'], 'wf_hist_level_processed_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workflow_history');
    }
};
