<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(User::class, 'posted_by')
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->string('title');
            $table->string('company')->nullable();
            $table->string('location')->nullable();

            $table->enum('job_type', ['full_time', 'part_time', 'internship', 'freelance'])
                  ->default('internship');

            $table->enum('level', ['junior', 'mid', 'senior'])
                  ->default('junior');

            $table->text('description');
            $table->text('requirements')->nullable();

            $table->integer('salary_min')->nullable();
            $table->integer('salary_max')->nullable();

            $table->date('deadline')->nullable();

            $table->enum('status', ['active', 'closed'])->default('active');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_posts');
    }
};
