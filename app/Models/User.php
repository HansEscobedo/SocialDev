<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'user_name',
        'birth_date',
        'email',
        'password',
        'pdf_path',
        'role',
        'publications',
    ];

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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }
    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id');
    }

    public function area_skills()
    {
        return $this->belongsToMany(Area_skills::class, 'user__area_skills');
    }

    public function soft_skills()
    {
        return $this->belongsToMany(Soft_skills::class, 'user__soft_skills');
    }

    public function programming_languages()
    {
        return $this->belongsToMany(Programming_languages::class, 'user__programming_languages');
    }
}
