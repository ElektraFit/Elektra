<?php

/*
|--------------------------------------------------------------------------
| Test OTP Email Sending
|--------------------------------------------------------------------------
|
| This is a quick test script to verify your email configuration is working.
| Run this file to test sending an OTP email without going through the full
| registration/login process.
|
| Usage: php test_email.php
|
*/

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;

echo "🧪 Testing OTP Email Configuration\n";
echo "====================================\n\n";

// Get email from command line or use default
$email = $argv[1] ?? 'test@example.com';
$testOtp = '1234';

echo "📧 Sending test OTP email to: {$email}\n";
echo "🔢 Test OTP code: {$testOtp}\n\n";

try {
    Mail::to($email)->send(new OtpMail($testOtp, 'Test User'));
    
    echo "✅ SUCCESS! Email sent.\n\n";
    
    if (config('mail.mailer') === 'log') {
        echo "📝 Since you're using the 'log' driver, check the email content in:\n";
        echo "   storage/logs/laravel.log\n\n";
    } else {
        echo "📬 Check your inbox at: {$email}\n";
        echo "   (It may take a few moments to arrive)\n\n";
    }
    
    echo "Current mail configuration:\n";
    echo "  - Driver: " . config('mail.mailer') . "\n";
    echo "  - Host: " . config('mail.mailers.smtp.host', 'N/A') . "\n";
    echo "  - Port: " . config('mail.mailers.smtp.port', 'N/A') . "\n";
    echo "  - From: " . config('mail.from.address') . "\n";
    
} catch (\Exception $e) {
    echo "❌ ERROR! Failed to send email.\n\n";
    echo "Error message: " . $e->getMessage() . "\n\n";
    
    echo "Troubleshooting tips:\n";
    echo "1. Check your .env file for correct MAIL_* settings\n";
    echo "2. Run: php artisan config:clear\n";
    echo "3. Verify your email credentials are correct\n";
    echo "4. Check storage/logs/laravel.log for details\n";
    
    if (config('mail.mailer') === 'smtp') {
        echo "5. For Gmail, make sure you're using an App Password\n";
        echo "6. Check firewall isn't blocking SMTP port\n";
    }
}

echo "\n";
