<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Soft_skills extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'soft_skills_id',
    ];
}
