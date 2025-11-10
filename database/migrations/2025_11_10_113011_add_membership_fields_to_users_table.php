<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('membership_plan')->nullable()->after('password');
            $table->enum('membership_status', ['active', 'expired', 'cancelled', 'none'])->default('none')->after('membership_plan');
            $table->timestamp('membership_start_date')->nullable()->after('membership_status');
            $table->timestamp('membership_end_date')->nullable()->after('membership_start_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['membership_plan', 'membership_status', 'membership_start_date', 'membership_end_date']);
        });
    }
};
