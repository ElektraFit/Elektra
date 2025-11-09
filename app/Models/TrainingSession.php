<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingSession extends Model
{
    protected $fillable = [
        'user_id',
        'instructor_id',
        'training_type',
        'description',
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

    /**
     * Get numeric intensity value for display (1-10)
     */
    public function getIntensityAttribute($value)
    {
        // If it's already a number, return it
        if (is_numeric($value)) {
            return (int) $value;
        }

        // Map enum values to numeric for display
        return match($value) {
            'low' => 3,
            'moderate' => 5,
            'high' => 8,
            default => 5
        };
    }

    /**
     * Get the duration in minutes (alias for duration_minutes)
     */
    public function getDurationAttribute()
    {
        return $this->duration_minutes;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }
}
