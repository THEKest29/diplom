<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nick',
        'email',
        'password',
        'status',
        'avatar',
        'description'
    ];

    public function reviews()
    {
    return $this->hasMany(Review::class);
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function isAdmin()
{
    // В данном примере пользователь с ролью 'admin' считается администратором.
    return $this->role === 'admin';
}

public function favorites()
{
    return $this->belongsToMany(Manga::class, 'favorites')->withTimestamps();
}

protected $attributes = [
    'avatar' => null
];

public function getAvatarUrlAttribute()
{
        if (!$this->avatar) {
        return null; // Возвращаем null вместо дефолтной картинки
    }
    
    $fullPath = 'avatars/' . $this->avatar;
    
    return Storage::disk('public')->exists($fullPath)
        ? Storage::disk('public')->url($fullPath)
        : null;
}
public function getAvatarUrl()
{
    if (!$this->avatar) {
        return null;
    }
    
    return Str::startsWith($this->avatar, 'http') 
        ? $this->avatar 
        : asset('storage/'.str_replace('public/', '', $this->avatar));
}
}
