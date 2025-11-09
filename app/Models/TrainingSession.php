<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingSession extends Model
{
    protected $fillable = [
        'user_id',
        'instructor_id',
        'training_type',
        'duration_minutes',
        'session_date',
        'session_time',
        'intensity',
        'notes'
    ];

    protected $casts = [
        'session_date' => 'date',
        'session_time' => 'datetime:H:i',
    ];

    protected $appends = ['duration'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    public function getDurationAttribute(): int
    {
        return $this->duration_minutes;
    }

    public function getIntensityAttribute($value): int
    {
        return match($value) {
            'low' => 3,
            'moderate' => 5,
            'high' => 8,
            default => (int) $value
        };
    }
}
