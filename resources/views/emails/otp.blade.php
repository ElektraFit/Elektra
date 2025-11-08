<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your OTP Code</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .container {
            background-color: #f4f4f4;
            border-radius: 5px;
            padding: 30px;
        }
        .header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            border-radius: 5px 5px 0 0;
            text-align: center;
        }
        .content {
            background-color: white;
            padding: 30px;
            border-radius: 0 0 5px 5px;
        }
        .otp-code {
            background-color: #f8f9fa;
            border: 2px dashed #007bff;
            border-radius: 5px;
            padding: 20px;
            text-align: center;
            margin: 20px 0;
        }
        .otp-number {
            color: #007bff;
            font-size: 32px;
            font-weight: bold;
            letter-spacing: 8px;
            font-family: 'Courier New', monospace;
        }
        .warning {
            color: #dc3545;
            font-size: 14px;
            margin-top: 20px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 style="margin: 0;">{{ config('app.name') }}</h1>
        </div>
        <div class="content">
            @if($userName)
                <p>Hello {{ $userName }},</p>
            @else
                <p>Hello,</p>
            @endif
            
            <p>You have requested a One-Time Password (OTP) for authentication. Please use the code below to verify your identity:</p>
            
            <div class="otp-code">
                <p style="margin: 0; font-size: 14px; color: #666;">Your verification code is:</p>
                <div class="otp-number">{{ $otp }}</div>
            </div>
            
            <p class="warning">
                <strong>⚠️ Important:</strong> This code will expire in <strong>5 minutes</strong>. 
                Do not share this code with anyone.
            </p>
            
            <p>If you did not request this code, please ignore this email or contact our support team if you have concerns about your account security.</p>
            
            <p>Best regards,<br>
            The {{ config('app.name') }} Team</p>
        </div>
        <div class="footer">
            <p>This is an automated message, please do not reply to this email.</p>
        </div>
    </div>
</body>
</html>
