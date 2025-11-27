<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::updateOrCreate(
            ['email' => 'admin@vinix7.test'],
            [
                'name' => 'Admin Vinix7',
                'password' => Hash::make('password'),
                'role' => User::ROLE_ADMIN,
            ]
        );

        // Student
        User::updateOrCreate(
            ['email' => 'student@vinix7.test'],
            [
                'name' => 'Mahasiswa Vinix7',
                'password' => Hash::make('password'),
                'role' => User::ROLE_STUDENT,
            ]
        );

        // Mentor
        User::updateOrCreate(
            ['email' => 'mentor@vinix7.test'],
            [
                'name' => 'Mentor Vinix7',
                'password' => Hash::make('password'),
                'role' => User::ROLE_MENTOR,
            ]
        );
    }
}
