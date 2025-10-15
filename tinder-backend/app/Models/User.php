<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name', 'age', 'pictures', 'location', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'pictures' => 'array',
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function likesGiven()
    {
        return $this->hasMany(Like::class, 'from_user_id');
    }

    public function likesReceived()
    {
        return $this->hasMany(Like::class, 'to_user_id');
    }

    public function dislikesGiven()
    {
        return $this->hasMany(Dislike::class, 'from_user_id');
    }
}