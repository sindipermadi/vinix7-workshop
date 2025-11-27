<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentorSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'mentor_id',
        'start_at',
        'end_at',
        'status',
        'mentoring_session_id',
    ];

    protected function casts(): array
    {
        return [
            'start_at' => 'datetime',
            'end_at'   => 'datetime',
        ];
    }

    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }

    public function mentoringSession()
    {
        return $this->belongsTo(MentoringSession::class, 'mentoring_session_id');
    }
}
