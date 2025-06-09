<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MangaRating extends Model
{
    protected $fillable = ['user_id', 'manga_id', 'rating'];
}
