<?php
// database/seeders/ServiceSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        $services = [
            [
                'name' => 'Personal Training Session',
                'description' => 'One-on-one training session with a certified personal trainer. Customized workout based on your goals.',
                'type' => 'personal_training',
                'price' => 3000.00,
                'duration_minutes' => 60,
                'max_participants' => 1,
                'is_active' => true
            ],
            [
                'name' => 'Group Fitness Class',
                'description' => 'High-energy group fitness class including cardio, strength training, and flexibility exercises.',
                'type' => 'group_class',
                'price' => 800.00,
                'duration_minutes' => 45,
                'max_participants' => 20,
                'is_active' => true
            ],
            [
                'name' => 'Yoga Class',
                'description' => 'Relaxing yoga session focusing on flexibility, balance, and mindfulness.',
                'type' => 'group_class',
                'price' => 1000.00,
                'duration_minutes' => 60,
                'max_participants' => 15,
                'is_active' => true
            ],
            [
                'name' => 'HIIT Training',
                'description' => 'High-Intensity Interval Training for maximum calorie burn and fitness improvement.',
                'type' => 'group_class',
                'price' => 1200.00,
                'duration_minutes' => 30,
                'max_participants' => 12,
                'is_active' => true
            ],
            [
                'name' => 'Fitness Assessment',
                'description' => 'Comprehensive fitness evaluation including body composition, strength, and cardio tests.',
                'type' => 'assessment',
                'price' => 2000.00,
                'duration_minutes' => 90,
                'max_participants' => 1,
                'is_active' => true
            ],
            [
                'name' => 'Nutrition Consultation',
                'description' => 'Personalized nutrition plan and dietary guidance from certified nutritionist.',
                'type' => 'consultation',
                'price' => 2500.00,
                'duration_minutes' => 60,
                'max_participants' => 1,
                'is_active' => true
            ],
            [
                'name' => 'Strength Training Class',
                'description' => 'Focus on building muscle strength and endurance using various equipment.',
                'type' => 'group_class',
                'price' => 1000.00,
                'duration_minutes' => 50,
                'max_participants' => 18,
                'is_active' => true
            ]
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}