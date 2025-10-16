<?php
// database/migrations/2024_01_01_000002_create_membership_plans_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('membership_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->integer('duration_months');
            $table->json('features'); // Store array of features
            $table->boolean('gym_access')->default(true);
            $table->boolean('trainer_access')->default(false);
            $table->boolean('group_classes')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('membership_plans');
    }
};