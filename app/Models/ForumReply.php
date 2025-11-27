<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumReply extends Model
{
    use HasFactory;

    protected $fillable = [
        'thread_id',
        'user_id',
        'body',
        'is_solution',
    ];

    // thread yang dibalas
    public function thread()
    {
        return $this->belongsTo(ForumThread::class, 'thread_id');
    }

    // user yang membalas
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
