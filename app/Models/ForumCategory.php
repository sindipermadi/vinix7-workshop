<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumCategory extends Model
{
    use HasFactory;

    // kolom yang boleh diisi mass-assignment
    protected $fillable = [
        'name',
    ];

    // relasi: satu kategori punya banyak thread
    public function threads()
    {
        return $this->hasMany(ForumThread::class, 'category_id');
    }
}
