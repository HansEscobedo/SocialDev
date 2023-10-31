<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Programming_languages extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'programming_languages_id',
    ];
}
