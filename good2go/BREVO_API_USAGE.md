# Brevo API Usage Guide

This guide explains how to use the Brevo API service in Good2Go.

## Configuration

Add your Brevo API key to `.env`:

```env
BREVO_API_KEY=your-api-key-here
```

Get your API key from: Brevo Dashboard → Settings → SMTP & API → API Keys

## Using BrevoService

The `BrevoService` class provides a simple interface to send emails via Brevo API.

### Basic Email Sending

```php
use App\Services\BrevoService;

$brevo = app(BrevoService::class);

$brevo->sendEmail(
    to: 'user@example.com',
    subject: 'Booking Confirmation',
    htmlContent: '<h1>Your booking is confirmed!</h1>',
    textContent: 'Your booking is confirmed!', // Optional
    params: [
        'to_name' => 'John Doe',
        'from_name' => 'Good2Go',
        'from_email' => 'noreply@good2go.com',
        'tags' => ['booking', 'confirmation'],
    ]
);
```

### Using Email Templates

If you have templates set up in Brevo:

```php
$brevo->sendTemplateEmail(
    templateId: 1, // Your Brevo template ID
    to: 'user@example.com',
    templateParams: [
        'NAME' => 'John Doe',
        'BOOKING_ID' => '12345',
        'DATE' => '2025-11-25',
    ],
    params: [
        'to_name' => 'John Doe',
    ]
);
```

### Check if API is Configured

```php
$brevo = app(BrevoService::class);

if ($brevo->isConfigured()) {
    // API is ready to use
} else {
    // Fallback to SMTP or log error
}
```

## Integration Examples

### In a Controller

```php
use App\Services\BrevoService;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        // ... create booking ...
        
        // Send via API
        $brevo = app(BrevoService::class);
        if ($brevo->isConfigured() && $booking->user->email) {
            $htmlContent = view('emails.booking-confirmation', [
                'booking' => $booking,
                'user' => $booking->user,
            ])->render();
            
            $brevo->sendEmail(
                to: $booking->user->email,
                subject: 'Booking Confirmation - Good2Go',
                htmlContent: $htmlContent,
                params: [
                    'to_name' => $booking->user->name,
                    'tags' => ['booking', 'confirmation'],
                ]
            );
        }
    }
}
```

## Benefits of Using API vs SMTP

### API Method (Recommended)
- ✅ Better deliverability
- ✅ Email tracking and analytics
- ✅ Template management
- ✅ Tags and segmentation
- ✅ More reliable
- ✅ Better error handling

### SMTP Method
- ✅ Simpler setup
- ✅ Works with Laravel Mailable classes
- ✅ No API key needed (just SMTP credentials)

## Current Implementation

The application currently uses **SMTP by default** (via Laravel's Mail facade). 

To switch to API method:
1. Set `BREVO_API_KEY` in `.env`
2. Optionally update controllers to use `BrevoService` directly
3. Or use the `BookingConfirmationApi` Mailable class as an example

## Error Handling

The `BrevoService` automatically:
- Logs errors to Laravel logs
- Returns `false` on failure (so you can implement fallback)
- Checks if API is configured before attempting to send

## Testing

Test the API connection:

```bash
php artisan tinker
```

Then:
```php
$brevo = app(BrevoService::class);
$brevo->isConfigured(); // Should return true if API key is set
```

