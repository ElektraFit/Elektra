<?php
// database/seeders/TrainerSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Trainer;

class TrainerSeeder extends Seeder
{
    public function run()
    {
        $trainers = [
            [
                'name' => 'Sarah Johnson',
                'email' => 'sarah@elektragym.com',
                'phone' => '+254712345678',
                'bio' => 'Certified fitness trainer with 8+ years of experience in strength training and weight management. Passionate about helping clients achieve their fitness goals.',
                'specializations' => ['Strength Training', 'Weight Loss', 'Bodybuilding', 'Nutrition'],
                'certifications' => ['NASM-CPT', 'ACSM', 'Nutrition Specialist'],
                'years_experience' => 8,
                'hourly_rate' => 3000.00,
                'available_days' => ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'],
                'start_time' => '06:00',
                'end_time' => '18:00',
                'status' => 'active'
            ],
            [
                'name' => 'Michael Chen',
                'email' => 'michael@elektragym.com',
                'phone' => '+254723456789',
                'bio' => 'Former professional athlete turned fitness coach. Specializes in functional fitness and sports performance enhancement.',
                'specializations' => ['Functional Training', 'Sports Performance', 'Injury Recovery', 'Cardio'],
                'certifications' => ['NSCA-CSCS', 'FMS Level 2', 'Sports Medicine'],
                'years_experience' => 12,
                'hourly_rate' => 3500.00,
                'available_days' => ['monday', 'wednesday', 'friday', 'saturday', 'sunday'],
                'start_time' => '07:00',
                'end_time' => '19:00',
                'status' => 'active'
            ],
            [
                'name' => 'Grace Wanjiku',
                'email' => 'grace@elektragym.com',
                'phone' => '+254734567890',
                'bio' => 'Yoga instructor and wellness coach with expertise in mind-body connection and holistic fitness approaches.',
                'specializations' => ['Yoga', 'Pilates', 'Flexibility', 'Meditation', 'Wellness Coaching'],
                'certifications' => ['RYT-500', 'Pilates Certified', 'Wellness Coach'],
                'years_experience' => 6,
                'hourly_rate' => 2800.00,
                'available_days' => ['tuesday', 'thursday', 'saturday', 'sunday'],
                'start_time' => '06:00',
                'end_time' => '16:00',
                'status' => 'active'
            ],
            [
                'name' => 'David Kipchoge',
                'email' => 'david@elektragym.com',
                'phone' => '+254745678901',
                'bio' => 'Marathon runner and endurance coach. Helps clients build cardiovascular fitness and achieve running goals.',
                'specializations' => ['Running', 'Endurance Training', 'Marathon Prep', 'Cardiovascular Fitness'],
                'certifications' => ['RRCA Certified', 'Endurance Coaching', 'Sports Nutrition'],
                'years_experience' => 10,
                'hourly_rate' => 3200.00,
                'available_days' => ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'],
                'start_time' => '05:30',
                'end_time' => '17:30',
                'status' => 'active'
            ]
        ];

        foreach ($trainers as $trainer) {
            Trainer::create($trainer);
        }
    }
}