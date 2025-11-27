<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mentor_schedules', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(User::class, 'mentor_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            // slot waktu
            $table->dateTime('start_at');
            $table->dateTime('end_at');

            // available / booked / canceled
            $table->enum('status', ['available', 'booked', 'canceled'])
                  ->default('available');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mentor_schedules');
    }
};
