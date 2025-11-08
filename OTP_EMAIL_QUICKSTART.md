# 📧 OTP Email Setup - Quick Start

## ✅ What's Been Done

Your ElektraFit application now sends OTP verification codes via email!

### Files Created/Modified:

1. **`app/Mail/OtpMail.php`** - Email handler class
2. **`resources/views/emails/otp.blade.php`** - Professional email template (updated)
3. **`routes/web.php`** - Updated to send actual emails
4. **`.env`** - Mail configuration (needs your credentials)

## 🚀 Next Steps (Choose One)

### Quick Test (Recommended First)

**Option 1: Log to File (No setup needed)**

1. Open `.env` and change:
   ```env
   MAIL_MAILER=log
   ```

2. Run:
   ```bash
   php artisan config:clear
   php artisan serve
   ```

3. Go to `http://127.0.0.1:8000/register`
4. Register a new account
5. Check `storage/logs/laravel.log` to see the OTP email content

---

### For Real Email Sending

**Option 2: Gmail (Free, Easy Setup)**

1. **Get Gmail App Password:**
   - Go to https://myaccount.google.com/security
   - Enable "2-Step Verification"
   - Go to "App passwords"
   - Generate password for "Mail"
   - Copy the 16-character code

2. **Update `.env`:**
   ```env
   MAIL_MAILER=smtp
   MAIL_HOST=smtp.gmail.com
   MAIL_PORT=587
   MAIL_USERNAME=your-email@gmail.com
   MAIL_PASSWORD=paste-the-16-char-app-password-here
   MAIL_ENCRYPTION=tls
   MAIL_FROM_ADDRESS="noreply@elektrafit.com"
   MAIL_FROM_NAME="ElektraFit"
   ```

3. **Apply changes:**
   ```bash
   php artisan config:clear
   php artisan serve
   ```

4. **Test it:**
   - Register with a real email address
   - Check your inbox for the OTP code

---

**Option 3: Mailtrap (Best for Development)**

Perfect for testing without sending real emails!

1. **Sign up** at https://mailtrap.io (free)
2. **Get credentials** from your inbox settings
3. **Update `.env`:**
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

4. **Apply changes:**
   ```bash
   php artisan config:clear
   ```

5. **Test:** All emails will appear in your Mailtrap inbox

## 🎨 Email Features

Your OTP emails include:
- ✨ Professional design with your app branding
- 👤 Personalized greeting (uses registrant's name)
- 🔢 Large, easy-to-read OTP code
- ⏰ 5-minute expiration warning
- 🔒 Security notices

## 📝 How It Works

1. **User registers or logs in** → OTP generated
2. **Email sent** with 4-digit code
3. **User redirected** to OTP verification page
4. **User enters code** → account verified
5. **Success!** → redirected to homepage

## 🐛 Troubleshooting

**Emails not sending?**
```bash
# Check the logs
cat storage/logs/laravel.log

# Clear all caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

**Gmail authentication failed?**
- Must use App Password (not regular password)
- 2-Step Verification must be enabled
- Check the 16-char code is correct (no spaces)

**Want to see email content without sending?**
```env
MAIL_MAILER=log
```
Then check `storage/logs/laravel.log`

## 📚 More Info

See `MAIL_SETUP.md` for:
- Detailed configuration guides
- Multiple email service options
- Production setup recommendations
- Security best practices

## ⚡ Test Command

```bash
# Start server
php artisan serve

# Visit in browser:
# http://127.0.0.1:8000/register

# Or test login:
# http://127.0.0.1:8000/login
```

---

**Need help?** Check the Laravel logs at `storage/logs/laravel.log`
