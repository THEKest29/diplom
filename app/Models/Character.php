<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $fillable = ['manga_id', 'name', 'image_path', 'description'];

    public function manga()
    {
    return $this->belongsTo(Manga::class);
    }
}
