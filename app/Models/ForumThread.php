<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumThread extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'user_id',
        'title',
        'body',
        'status',
    ];

    // kategori dari thread ini
    public function category()
    {
        return $this->belongsTo(ForumCategory::class, 'category_id');
    }

    // user (student/mentor) yang buat thread
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // balasan-balasan di thread ini
    public function replies()
    {
        return $this->hasMany(ForumReply::class, 'thread_id');
    }
}
