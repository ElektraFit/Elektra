<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'date_of_birth',
        'specialization',
        'years_of_experience',
        'bio',
        'phone',
    ];

    protected $hidden = [
        'password',
    ];
}