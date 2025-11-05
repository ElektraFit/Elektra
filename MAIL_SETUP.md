# Email Configuration Guide for OTP System

Your OTP verification is now configured to send emails! Here's how to set up different email services.

## Current Setup

The application now sends OTP codes via email when users:
- Log in (2-factor authentication)
- Register a new account

## Email Service Options

### Option 1: Gmail (Recommended for Testing)

1. **Enable 2-Step Verification** on your Google account
2. **Generate an App Password**:
   - Go to Google Account → Security → 2-Step Verification → App passwords
   - Create a new app password for "Mail"
   - Copy the 16-character password

3. **Update `.env` file**:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-16-character-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@elektrafit.com"
MAIL_FROM_NAME="ElektraFit"
```

### Option 2: Mailtrap (Best for Development/Testing)

Mailtrap catches all emails in a sandbox - perfect for testing without sending real emails.

1. **Sign up** at [mailtrap.io](https://mailtrap.io) (free tier available)
2. **Get SMTP credentials** from your inbox settings
3. **Update `.env` file**:
```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your-mailtrap-username
MAIL_PASSWORD=your-mailtrap-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@elektrafit.com"
MAIL_FROM_NAME="ElektraFit"
```

### Option 3: Log Driver (For Initial Testing)

This writes emails to log files instead of sending them - useful for debugging.

**Update `.env` file**:
```env
MAIL_MAILER=log
```

Then check emails in `storage/logs/laravel.log`

### Option 4: Mailgun (Production)

1. **Sign up** at [mailgun.com](https://mailgun.com)
2. **Verify your domain**
3. **Get API credentials**
4. **Install Mailgun package**:
```bash
composer require symfony/mailgun-mailer symfony/http-client
```

5. **Update `.env` file**:
```env
MAIL_MAILER=mailgun
MAILGUN_DOMAIN=your-domain.com
MAILGUN_SECRET=your-api-key
MAIL_FROM_ADDRESS="noreply@elektrafit.com"
MAIL_FROM_NAME="ElektraFit"
```

### Option 5: SendGrid (Production)

1. **Sign up** at [sendgrid.com](https://sendgrid.com)
2. **Create an API key**
3. **Install SendGrid package**:
```bash
composer require symfony/sendgrid-mailer symfony/http-client
```

4. **Update `.env` file**:
```env
MAIL_MAILER=sendgrid
SENDGRID_API_KEY=your-api-key
MAIL_FROM_ADDRESS="noreply@elektrafit.com"
MAIL_FROM_NAME="ElektraFit"
```

## After Configuration

1. **Clear config cache**:
```bash
php artisan config:clear
```

2. **Test the email** by:
   - Registering a new account
   - Logging in (if you have an existing account)
   - Check your email or logs for the OTP code

## Troubleshooting

### Emails not sending?

1. Check logs: `storage/logs/laravel.log`
2. Verify credentials in `.env`
3. Ensure your email service allows "less secure apps" or use app-specific passwords
4. Check firewall/antivirus isn't blocking SMTP ports

### Gmail not working?

- Make sure 2-Step Verification is enabled
- Use App Password, not your regular password
- Check that "Less secure app access" is enabled (if not using App Password)

### Want to test without real emails?

Use `MAIL_MAILER=log` and check `storage/logs/laravel.log` for email content.

## Email Template

The OTP email includes:
- Professional header with app name
- Personalized greeting (when name is available)
- Large, easy-to-read OTP code
- 5-minute expiration warning
- Security notice

To customize the template, edit: `resources/views/emails/otp.blade.php`

## Security Notes

- Never commit your `.env` file with real credentials
- Use app-specific passwords, not account passwords
- In production, use a dedicated email service (Mailgun, SendGrid, etc.)
- Consider rate limiting OTP requests to prevent abuse
- Log failed OTP attempts for security monitoring
