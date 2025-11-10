<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'membership_plan',
        'membership_status',
        'membership_start_date',
        'membership_end_date',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'membership_start_date' => 'datetime',
            'membership_end_date' => 'datetime',
        ];
    }

    /**
     * Check if user has an active membership
     */
    public function hasActiveMembership(): bool
    {
        return $this->membership_status === 'active' 
            && $this->membership_end_date 
            && $this->membership_end_date->isFuture();
    }

    /**
     * Activate membership after successful payment
     */
    public function activateMembership(string $plan, int $durationMonths = 1): void
    {
        $this->update([
            'membership_plan' => $plan,
            'membership_status' => 'active',
            'membership_start_date' => now(),
            'membership_end_date' => now()->addMonths($durationMonths),
        ]);
    }

    public function trainingSessions()
    {
        return $this->hasMany(TrainingSession::class);
    }
}
