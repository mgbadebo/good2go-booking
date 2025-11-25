<?php

namespace App\Console\Commands;

use App\Models\Booking;
use App\Mail\BookingReminder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendBookingReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bookings:send-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminder emails for bookings scheduled for tomorrow';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tomorrow = now()->addDay()->startOfDay();
        $dayAfter = now()->addDays(2)->startOfDay();

        $bookings = Booking::where('start_datetime', '>=', $tomorrow)
            ->where('start_datetime', '<', $dayAfter)
            ->whereIn('booking_status', ['pending', 'confirmed'])
            ->with(['user', 'serviceType'])
            ->get();

        $sent = 0;
        $failed = 0;

        foreach ($bookings as $booking) {
            if (!$booking->user || !$booking->user->email) {
                continue;
            }

            try {
                Mail::to($booking->user->email)->send(new BookingReminder($booking));
                $sent++;
            } catch (\Exception $e) {
                $this->error("Failed to send reminder for booking #{$booking->id}: " . $e->getMessage());
                $failed++;
            }
        }

        $this->info("Sent {$sent} reminder emails. {$failed} failed.");

        return Command::SUCCESS;
    }
}
