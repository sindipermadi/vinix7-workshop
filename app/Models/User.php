<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Job; 
use App\Models\JobApplication;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public const ROLE_ADMIN = 'admin';
    public const ROLE_STUDENT = 'student';
    public const ROLE_MENTOR = 'mentor';

    /**
     * Fields yang bisa diisi mass assignment
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * Disembunyikan pada serialisasi
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casts
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    //------------------------
    // ROLE HELPERS
    //------------------------

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isStudent(): bool
    {
        return $this->role === self::ROLE_STUDENT;
    }

    public function isMentor(): bool
    {
        return $this->role === self::ROLE_MENTOR;
    }

    public function mentoringSessionsAsStudent()
{
    return $this->hasMany(MentoringSession::class, 'student_id');
}

public function mentoringSessionsAsMentor()
{
    return $this->hasMany(MentoringSession::class, 'mentor_id');
}

public function mentorSchedules()
{
    return $this->hasMany(MentorSchedule::class, 'mentor_id');
}

public function jobsPosted()
{
    return $this->hasMany(Job::class, 'posted_by');
}



public function jobApplications()
{
    return $this->hasMany(JobApplication::class, 'student_id');
}


}
