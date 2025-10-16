<?php
// database/migrations/2024_01_01_000004_create_trainers_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('trainers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->text('bio');
            $table->json('specializations'); // Array of specializations
            $table->json('certifications'); // Array of certifications
            $table->integer('years_experience');
            $table->string('profile_image')->nullable();
            $table->decimal('hourly_rate', 8, 2);
            $table->json('available_days'); // Array of available days
            $table->time('start_time');
            $table->time('end_time');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('trainers');
    }
};