<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area_skills extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    public function user()
    {
        return $this->belongsToMany(User::class, 'User_Area_skills');
    }
}
