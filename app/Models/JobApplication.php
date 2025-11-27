<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'job_id',
        'status',
        'cover_letter',
        'admin_note',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

}
