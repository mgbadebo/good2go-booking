# Brevo Email Integration Setup

This guide will help you configure Brevo (formerly Sendinblue) for sending transactional emails in Good2Go.

## Step 1: Create a Brevo Account

1. Go to [https://www.brevo.com](https://www.brevo.com)
2. Sign up for a free account (300 emails/day free)
3. Verify your email address

## Step 2: Get Your API Key and SMTP Credentials

### API Key (Recommended for advanced features)

1. Log in to your Brevo dashboard
2. Go to **Settings** → **SMTP & API**
3. Click on **API Keys** tab
4. Click **Generate a new API key**
5. Give it a name (e.g., "Good2Go Production")
6. Copy the API key (you'll only see it once!)

### SMTP Credentials (Alternative/Backup)

1. In the same **SMTP & API** section
2. Click on the **SMTP** tab
3. You'll see your SMTP server details:
   - **SMTP Server**: `smtp-relay.brevo.com`
   - **Port**: `587` (TLS) or `465` (SSL)
4. **SMTP Login (Username)**: 
   - You'll see a unique email address displayed (this is your SMTP login/username)
   - It may look like: `yourname@relay.brevo.com` or similar
   - This is NOT your account email - it's a special SMTP login provided by Brevo
5. **SMTP Password (SMTP Key)**:
   - Scroll down in the SMTP section
   - Look for **"SMTP Keys"** section or **"Generate a new SMTP key"** button
   - Click **"Generate a new SMTP key"**
   - Give it a name (e.g., "Good2Go SMTP")
   - Click **"Generate"**
   - **⚠️ IMPORTANT**: The SMTP key will be displayed **ONLY ONCE**
   - **Copy it immediately** and save it securely - you won't be able to see it again!
   - This generated key is your **SMTP password**
   - If you lose it, you'll need to generate a new one

## Step 3: Configure Environment Variables

Add the following to your `.env` file:

```env
# Mail Configuration
MAIL_MAILER=brevo
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="${APP_NAME}"

# Brevo API Key (Recommended - enables API features)
BREVO_API_KEY=your-api-key-here

# Brevo SMTP Configuration (Alternative/Backup method)
BREVO_SMTP_HOST=smtp-relay.brevo.com
BREVO_SMTP_PORT=587
BREVO_SMTP_USERNAME=your-smtp-login@relay.brevo.com  # The SMTP login email shown in Brevo dashboard
BREVO_SMTP_PASSWORD=your-generated-smtp-key         # The SMTP key you generated (not your account password!)
BREVO_SMTP_ENCRYPTION=tls
```

## Quick Reference: What to Look For in Brevo Dashboard

When you're in **Settings → SMTP & API → SMTP** tab, you should see:

1. **SMTP Server Information**:
   - Server: `smtp-relay.brevo.com`
   - Port: `587` or `465`

2. **SMTP Login** (this is your username):
   - Displayed as an email address like: `xxxxx@relay.brevo.com`
   - Copy this entire email address

3. **SMTP Keys Section**:
   - If you see existing keys, you can use one of them
   - Or click **"Generate a new SMTP key"** to create a new one
   - The key will look like a long random string
   - This is your SMTP password

**Note**: If you don't see an "SMTP Keys" section, some accounts use the API key as the SMTP password. Try using your API key as the SMTP password in that case.

## Step 4: Verify Domain (Recommended)

For better deliverability:

1. In Brevo dashboard, go to **Senders & IP** → **Domains**
2. Add your domain
3. Add the DNS records provided by Brevo to your domain's DNS settings
4. Verify the domain

## Step 5: Test Email Sending

You can test the integration by:

1. Creating a new booking (will send confirmation email)
2. Registering a new user (will send welcome email)
3. Updating a booking status in admin panel (will send status update email)

## Email Templates

The following email templates are available:

- **Booking Confirmation** - Sent when a booking is created
- **Booking Status Update** - Sent when booking status changes
- **Booking Reminder** - Sent 24 hours before booking (via scheduled command)
- **Welcome Email** - Sent to new users upon registration

## Scheduled Reminders

To send booking reminders automatically, add this to your `app/Console/Kernel.php`:

```php
protected function schedule(Schedule $schedule)
{
    $schedule->command('bookings:send-reminders')->daily();
}
```

Or add to your server's cron:
```
0 9 * * * cd /path-to-project && php artisan bookings:send-reminders
```

## Using Brevo API vs SMTP

The application supports both methods:

### SMTP Method (Current Default)
- Uses Laravel's built-in mail system
- Set `MAIL_MAILER=brevo` in `.env`
- Simpler setup, works with existing Mailable classes

### API Method (Recommended for Production)
- More reliable and feature-rich
- Better tracking and analytics
- Supports templates, tags, and advanced features
- Use `BrevoService` class for API calls

**Example using BrevoService:**
```php
use App\Services\BrevoService;

$brevo = app(BrevoService::class);
$brevo->sendEmail(
    to: 'user@example.com',
    subject: 'Booking Confirmation',
    htmlContent: view('emails.booking-confirmation', $data)->render()
);
```

## Troubleshooting

### Emails not sending?

1. Check your `.env` file has correct Brevo credentials
2. Verify API key or SMTP credentials in Brevo dashboard
3. Check Laravel logs: `storage/logs/laravel.log`
4. Ensure `MAIL_MAILER=brevo` in `.env` (for SMTP) or `BREVO_API_KEY` is set (for API)
5. Clear config cache: `php artisan config:clear`
6. Test API connection: `php artisan tinker` then `app(BrevoService::class)->isConfigured()`

### Testing locally

For local development, you can use:
- `MAIL_MAILER=log` to log emails to `storage/logs/laravel.log`
- `MAIL_MAILER=array` to capture emails in memory (for testing)

## Support

For Brevo-specific issues, visit: [https://help.brevo.com](https://help.brevo.com)

