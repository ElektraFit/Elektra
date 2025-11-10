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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            $table->string('plan_name'); // Basic, Premium, Elite
            $table->decimal('amount', 10, 2);
            $table->enum('payment_method', ['mpesa', 'card', 'bank_transfer'])->default('mpesa');
            $table->enum('status', ['pending', 'completed', 'failed', 'cancelled'])->default('pending');
            
            // Transaction details
            $table->string('transaction_id')->nullable()->unique();
            $table->string('mpesa_receipt')->nullable();
            $table->string('phone_number')->nullable();
            
            // Metadata
            $table->text('payment_details')->nullable(); // JSON for extra details
            $table->timestamp('paid_at')->nullable();
            
            $table->timestamps();
            
            $table->index(['user_id', 'status']);
            $table->index('transaction_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
