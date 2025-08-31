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
        // Create users table if not exists with roles
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->enum('role', ['USER', 'EVALUATOR', 'KADIP', 'KADIS'])->default('USER');
                $table->boolean('active')->default(true);
                $table->rememberToken();
                $table->timestamps();
                $table->softDeletes();
                
                $table->index(['role', 'active']);
            });
        }

        // Create submissions table with 4-level approval tracking
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->string('submission_number', 50)->unique();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            
            // Current State Tracking
            $table->enum('current_status', [
                'DRAFT', 'SUBMITTED',
                'EVALUATOR_REVIEW', 'EVALUATOR_APPROVED', 'EVALUATOR_REJECTED', 'EVALUATOR_REVISION_REQUEST',
                'KADIP_REVIEW', 'KADIP_APPROVED', 'KADIP_REJECTED', 'KADIP_REVISION_REQUEST', 
                'KADIS_REVIEW', 'KADIS_APPROVED', 'KADIS_REJECTED', 'KADIS_REVISION_REQUEST',
                'USER_REVISION', 'EVALUATOR_REVISION', 'KADIP_REVISION',
                'ARCHIVED'
            ])->default('DRAFT');
            
            $table->enum('current_level', ['USER', 'EVALUATOR', 'KADIP', 'KADIS', 'COMPLETED'])->default('USER');
            $table->foreignId('current_assignee_id')->nullable()->constrained('users');
            
            // Progress Tracking - Milestone Timestamps
            $table->timestamp('level_1_completed_at')->nullable(); // User submission
            $table->timestamp('level_2_completed_at')->nullable(); // Evaluator approval  
            $table->timestamp('level_3_completed_at')->nullable(); // Kadip approval
            $table->timestamp('level_4_completed_at')->nullable(); // Kadis approval
            
            // Priority and SLA
            $table->enum('priority', ['LOW', 'NORMAL', 'HIGH', 'URGENT'])->default('NORMAL');
            $table->timestamp('sla_deadline')->nullable();
            
            // Form Data (JSON for flexibility)
            $table->json('form_data');
            
            // Metadata
            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes for performance
            $table->index(['user_id', 'current_status']);
            $table->index(['current_assignee_id', 'current_status']);
            $table->index(['current_level', 'current_status']);
            $table->index(['priority', 'sla_deadline']);
            $table->index(['current_status', 'created_at']);
        });

        // Create workflow history table for audit trail
        Schema::create('submission_workflow_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('submission_id')->constrained()->cascadeOnDelete();
            
            // State Change Details
            $table->string('from_status', 50)->nullable();
            $table->string('to_status', 50);
            $table->string('from_level', 20)->nullable();
            $table->string('to_level', 20);
            
            // Actor Information
            $table->foreignId('actor_id')->constrained('users');
            $table->enum('actor_role', ['USER', 'EVALUATOR', 'KADIP', 'KADIS', 'SYSTEM']);
            
            // Assignment Changes
            $table->foreignId('from_assignee_id')->nullable()->constrained('users');
            $table->foreignId('to_assignee_id')->nullable()->constrained('users');
            
            // Action Details
            $table->enum('action_type', [
                'SUBMIT', 'APPROVE', 'REJECT', 'REQUEST_REVISION',
                'REVISE', 'REASSIGN', 'ESCALATE', 'RETURN', 
                'ARCHIVE', 'RESTORE'
            ]);
            
            $table->text('comments')->nullable();
            $table->text('decision_reason')->nullable();
            
            // System Data
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            
            $table->timestamps();
            
            // Indexes
            $table->index(['submission_id', 'created_at']);
            $table->index(['actor_id', 'created_at']);
            $table->index(['action_type', 'created_at']);
        });

        // Create revisions table for tracking revision requests
        Schema::create('submission_revisions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('submission_id')->constrained()->cascadeOnDelete();
            
            // Revision Details
            $table->integer('revision_number');
            $table->enum('revision_type', ['USER_REVISION', 'EVALUATOR_REVISION', 'KADIP_REVISION']);
            
            // Requester Information
            $table->foreignId('requested_by_id')->constrained('users');
            $table->enum('requested_by_role', ['EVALUATOR', 'KADIP', 'KADIS']);
            $table->text('request_reason');
            $table->json('specific_changes_required')->nullable();
            
            // Assignee Information
            $table->foreignId('assigned_to_id')->constrained('users');
            $table->enum('assigned_to_role', ['USER', 'EVALUATOR', 'KADIP']);
            
            // Revision Status
            $table->enum('status', ['PENDING', 'IN_PROGRESS', 'COMPLETED', 'CANCELLED'])->default('PENDING');
            
            // Form Data Snapshots
            $table->json('original_form_data'); // Before revision
            $table->json('revised_form_data')->nullable(); // After revision
            
            // Timeline
            $table->timestamp('requested_at');
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('deadline')->nullable();
            
            // Revision Notes
            $table->text('revision_notes')->nullable();
            $table->text('completion_comments')->nullable();
            
            $table->timestamps();
            
            // Indexes
            $table->index(['submission_id', 'revision_number']);
            $table->index(['assigned_to_id', 'status']);
            $table->index(['requested_by_id', 'requested_at']);
            
            // Unique constraint
            $table->unique(['submission_id', 'revision_number']);
        });

        // Create evaluations table for assessment tracking
        Schema::create('submission_evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('submission_id')->constrained()->cascadeOnDelete();
            $table->foreignId('evaluator_id')->constrained('users');
            $table->enum('evaluation_level', ['EVALUATOR', 'KADIP', 'KADIS']);
            
            // Evaluation Scores
            $table->decimal('total_score', 5, 2)->nullable();
            $table->decimal('max_score', 5, 2)->default(100.00);
            
            // Individual Criteria Scores (JSON for flexibility)
            $table->json('criteria_scores')->nullable();
            
            // Evaluation Details
            $table->text('strengths')->nullable();
            $table->text('weaknesses')->nullable();
            $table->text('recommendations')->nullable();
            $table->text('decision_comments');
            
            // Decision
            $table->enum('decision', ['APPROVED', 'REJECTED', 'REVISION_REQUEST']);
            $table->text('decision_reason')->nullable();
            
            // Review Time Tracking
            $table->timestamp('assigned_at');
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            
            // Version Control (for revisions)
            $table->integer('version')->default(1);
            $table->boolean('is_current')->default(true);
            $table->foreignId('parent_evaluation_id')->nullable()->constrained('submission_evaluations');
            
            $table->timestamps();
            
            // Indexes (shortened names for MySQL compatibility)
            $table->index(['submission_id', 'evaluation_level'], 'sub_eval_submission_level_idx');
            $table->index(['evaluator_id', 'assigned_at', 'completed_at'], 'sub_eval_evaluator_assigned_idx');
            $table->index(['is_current', 'evaluation_level'], 'sub_eval_current_level_idx');
            
            // Unique constraint for current evaluations
            $table->unique(['submission_id', 'evaluation_level', 'is_current'], 'unique_current_evaluation');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submission_evaluations');
        Schema::dropIfExists('submission_revisions');
        Schema::dropIfExists('submission_workflow_history');
        Schema::dropIfExists('submissions');
    }
};
