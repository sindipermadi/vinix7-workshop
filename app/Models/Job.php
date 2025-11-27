<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\JobApplication;

class Job extends Model
{
    use HasFactory;

    protected $table = 'job_posts';   // ← WAJIB

    protected $fillable = [
        'posted_by',
        'title',
        'company',
        'location',
        'job_type',
        'level',
        'description',
        'requirements',
        'salary_min',
        'salary_max',
        'deadline',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'deadline' => 'date',
        ];
    }

    public function postedBy()
    {
        return $this->belongsTo(User::class, 'posted_by');
    }

    public function applications()
{
    return $this->hasMany(JobApplication::class, 'job_id');
}



}
