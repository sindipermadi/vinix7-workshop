<?php

use App\Models\MentoringSession;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mentor_schedules', function (Blueprint $table) {
            $table->foreignIdFor(MentoringSession::class, 'mentoring_session_id')
                  ->nullable()
                  ->constrained('mentoring_sessions')
                  ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('mentor_schedules', function (Blueprint $table) {
            $table->dropConstrainedForeignId('mentoring_session_id');
        });
    }
};
