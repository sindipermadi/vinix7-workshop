<?php

use App\Models\User;
use App\Models\Job;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();

            // student yang melamar
            $table->foreignIdFor(User::class, 'student_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            // job yang dilamar (ingat: tabelnya job_posts)
            $table->foreignIdFor(Job::class, 'job_id')
                  ->constrained('job_posts')
                  ->cascadeOnDelete();

            // status lamaran
            $table->enum('status', ['pending', 'reviewed', 'accepted', 'rejected'])
                  ->default('pending');

            // optional cover letter / catatan
            $table->text('cover_letter')->nullable();

            $table->timestamps();

            // 1 student hanya boleh apply 1x ke job yang sama
            $table->unique(['student_id', 'job_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
