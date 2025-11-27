<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mentoring_sessions', function (Blueprint $table) {
            $table->id();

            // mahasiswa
            $table->foreignIdFor(User::class, 'student_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            // mentor
            $table->foreignIdFor(User::class, 'mentor_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            // tujuan mentoring (siap kerja, skripsi, dll)
            $table->string('goal');     // misal: "Siap Kerja", "Skripsi/Tugas Akhir"
            // topik spesifik
            $table->string('topic');    // misal: "UI/UX Design", "Front End Development"

            // jadwal yang diminta mahasiswa
            $table->dateTime('scheduled_at')->nullable();

            // status sesi: pending, approved, completed, canceled
            $table->enum('status', ['pending', 'approved', 'completed', 'canceled'])
                  ->default('pending');

            // catatan tambahan (misalnya link zoom, feedback, dll)
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mentoring_sessions');
    }
};
