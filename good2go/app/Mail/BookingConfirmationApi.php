<?php

namespace App\Mail;

use App\Models\Booking;
use App\Services\BrevoService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\View;

/**
 * Alternative BookingConfirmation that uses Brevo API instead of SMTP
 * 
 * To use this instead of the SMTP version, update BookingController
 * to use BookingConfirmationApi instead of BookingConfirmation
 */
class BookingConfirmationApi extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public Booking $booking
    ) {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Booking Confirmation - Good2Go',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.booking-confirmation',
            with: [
                'booking' => $this->booking,
                'user' => $this->booking->user,
                'serviceType' => $this->booking->serviceType,
            ],
        );
    }

    /**
     * Send via Brevo API instead of default mailer
     */
    public function send($mailer)
    {
        $brevo = app(BrevoService::class);
        
        if (!$brevo->isConfigured()) {
            // Fallback to default mailer if API not configured
            return parent::send($mailer);
        }

        $booking = $this->booking->load(['user', 'serviceType']);
        
        $htmlContent = View::make('emails.booking-confirmation', [
            'booking' => $booking,
            'user' => $booking->user,
            'serviceType' => $booking->serviceType,
        ])->render();

        $success = $brevo->sendEmail(
            to: $booking->user->email,
            subject: 'Booking Confirmation - Good2Go',
            htmlContent: $htmlContent,
            params: [
                'to_name' => $booking->user->name,
                'tags' => ['booking', 'confirmation', 'booking-' . $booking->id],
            ]
        );

        if (!$success) {
            // Fallback to default mailer if API fails
            return parent::send($mailer);
        }

        return $this;
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}

