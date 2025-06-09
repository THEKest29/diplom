<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manga extends Model
{
    protected $table = 'manga'; 
    
    protected $fillable = [
        'title', 'original_title', 'author', 'artist', 
        'status', 'year', 'end_year', 'description', 'cover_path',
        'publisher', 'volumes'
    ];

    public function genres()
{
    return $this->belongsToMany(Genre::class, 'manga_genre', 'manga_id', 'genre_id');
}

    public function characters()
{
    return $this->hasMany(Character::class);
}
public function reviews()
{
    return $this->hasMany(Review::class);
}
public function ratings()
{
    return $this->hasMany(MangaRating::class);
}

public function averageRating()
{
    return $this->ratings()->avg('rating');
}

public function userRating()
{
    return $this->ratings()
        ->where('user_id', auth()->id())
        ->value('rating');
}
// В модели Manga
protected static function booted()
{
    static::updated(function ($manga) {
        if ($manga->isDirty('average_rating')) {
            Cache::forget("manga_{$manga->id}_rating");
        }
    });
}

public function getCachedAverageRatingAttribute()
{
    return Cache::remember("manga_{$this->id}_rating", now()->addDay(), function () {
        return $this->averageRating();
    });
}

public function favoritedBy()
{
    return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
}

protected $appends = ['cover_url'];

public function getCoverUrlAttribute()
{
    if ($this->cover && file_exists(public_path('img/'.$this->cover_path))) {
        return asset('img/'.$this->cover_path);
    }
    return asset('img/no-cover.jpg');
}
}
