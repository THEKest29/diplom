<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'manga_id',
        'user_id',
        'comment',
        'likes',
        'dislikes',
    ];

    // Связь с мангой
    public function manga()
    {
        return $this->belongsTo(Manga::class);
    }

    // Связь с пользователем
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
