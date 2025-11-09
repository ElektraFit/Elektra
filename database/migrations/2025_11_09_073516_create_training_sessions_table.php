<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run  migrations.
     */
    public function up(): void
    {
        Schema::create('training_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('instructor_id')->nullable()->constrained('instructors')->onDelete('set null');
            $table->string('training_type'); // e.g., Cardio, Strength, Yoga, etc.
            $table->text('description')->nullable();
            $table->integer('duration_minutes'); // Duration in minutes
            $table->date('session_date');
            $table->time('session_time');
            $table->enum('intensity', ['low', 'moderate', 'high'])->default('moderate');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_sessions');
    }
};
