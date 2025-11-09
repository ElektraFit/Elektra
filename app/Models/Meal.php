<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'meal_name',
        'calories',
        'protein',
        'carbohydrates',
        'fat',
        'fiber',
        'sugar',
        'sodium',
        'serving_size',
        'serving_unit',
        'meal_date',
        'meal_type',
    ];

    protected $casts = [
        'meal_date' => 'date',
        'calories' => 'decimal:2',
        'protein' => 'decimal:2',
        'carbohydrates' => 'decimal:2',
        'fat' => 'decimal:2',
        'fiber' => 'decimal:2',
        'sugar' => 'decimal:2',
        'sodium' => 'decimal:2',
        'serving_size' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}