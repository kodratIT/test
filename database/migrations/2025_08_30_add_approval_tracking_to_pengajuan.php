<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pengajuan', function (Blueprint $table) {
            // Add 4-level approval tracking fields
            $table->enum('current_level', ['USER', 'EVALUATOR', 'KADIP', 'KADIS', 'COMPLETED'])->default('USER')->after('status');
            $table->foreignId('current_assignee_id')->nullable()->constrained('users')->after('current_level');
            
            // Progress milestone timestamps
            $table->timestamp('level_1_completed_at')->nullable()->after('current_assignee_id'); // User submission
            $table->timestamp('level_2_completed_at')->nullable()->after('level_1_completed_at'); // Evaluator approval
            $table->timestamp('level_3_completed_at')->nullable()->after('level_2_completed_at'); // Kadip approval
            $table->timestamp('level_4_completed_at')->nullable()->after('level_3_completed_at'); // Kadis approval
            
            // SLA and Priority
            $table->enum('priority', ['LOW', 'NORMAL', 'HIGH', 'URGENT'])->default('NORMAL')->after('level_4_completed_at');
            $table->timestamp('sla_deadline')->nullable()->after('priority');
            
            // Enhanced status for 4-level workflow
            $table->string('status', 50)->change(); // Increase length for new statuses
            
            // Revision tracking
            $table->integer('revision_count')->default(0)->after('sla_deadline');
            $table->text('last_rejection_reason')->nullable()->after('revision_count');
            $table->json('rejection_history')->nullable()->after('last_rejection_reason');
            
            // Add indexes for performance
            $table->index(['current_level', 'status']);
            $table->index(['current_assignee_id', 'status']);
            $table->index(['priority', 'sla_deadline']);
        });
    }

    public function down()
    {
        Schema::table('pengajuan', function (Blueprint $table) {
            $table->dropForeign(['current_assignee_id']);
            $table->dropColumn([
                'current_level',
                'current_assignee_id', 
                'level_1_completed_at',
                'level_2_completed_at',
                'level_3_completed_at',
                'level_4_completed_at',
                'priority',
                'sla_deadline',
                'revision_count',
                'last_rejection_reason',
                'rejection_history'
            ]);
        });
    }
};
