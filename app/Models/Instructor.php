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
        'profile_photo',
    ];

    protected $hidden = [
        'password',
    ];

    /**
     * Get the instructor's profile photo URL from Supabase Storage
     */
    public function getProfilePhotoUrlAttribute()
    {
        if ($this->profile_photo) {
            // Return Supabase public URL
            $supabaseUrl = env('SUPABASE_URL');
            $bucket = env('SUPABASE_STORAGE_BUCKET');
            return $supabaseUrl . '/storage/v1/object/public/' . $bucket . '/' . $this->profile_photo;
        }
        return asset('images/default-avatar.svg');
    }
}