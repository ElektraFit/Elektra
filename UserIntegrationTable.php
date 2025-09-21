<?php
// database/migrations/2024_01_01_000001_integrate_users_with_2fa.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Eric's 2FA fields (already implemented by Eric)
            $table->string('otp')->nullable();
            $table->timestamp('otp_expires_at')->nullable();
            
            // Additional gym member fields
            $table->string('phone')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->text('address')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->string('emergency_phone')->nullable();
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active');
            $table->string('profile_image')->nullable();
            $table->enum('membership_status', ['pending', 'active', 'expired', 'cancelled'])->default('pending');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'otp', 'otp_expires_at', 'phone', 'date_of_birth', 'gender', 
                'address', 'emergency_contact', 'emergency_phone', 'status', 
                'profile_image', 'membership_status'
            ]);
        });
    }
};