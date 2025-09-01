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
            $table->timestamp('evaluated_at')->nullable()->after('reassigned_by');
            $table->string('evaluator_recommendation')->nullable()->after('evaluated_at'); // 'approve' or 'reject'
            $table->text('evaluator_notes')->nullable()->after('evaluator_recommendation');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan', function (Blueprint $table) {
            $table->dropColumn(['evaluated_at', 'evaluator_recommendation', 'evaluator_notes']);
        });
    }
};
