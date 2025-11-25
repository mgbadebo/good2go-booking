<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Mail\BookingStatusUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BookingAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with(['user', 'serviceType', 'driver']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('booking_status', $request->status);
        }

        // Filter by payment status
        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->where('start_datetime', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->where('start_datetime', '<=', $request->date_to);
        }

        // Search by user name or phone
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $bookings = $query->orderBy('start_datetime', 'desc')->paginate(20);

        return view('admin.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        $booking->load(['user', 'serviceType', 'driver', 'payments']);
        return view('admin.bookings.show', compact('booking'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'booking_status' => 'required|in:pending,confirmed,in_progress,completed,cancelled',
        ]);

        $oldStatus = $booking->booking_status;
        $newStatus = $request->booking_status;

        $booking->update([
            'booking_status' => $newStatus,
        ]);

        // Send status update email
        if ($oldStatus !== $newStatus && $booking->user && $booking->user->email) {
            try {
                $booking->load(['user', 'serviceType']);
                Mail::to($booking->user->email)->send(
                    new BookingStatusUpdate($booking, $oldStatus, $newStatus)
                );
            } catch (\Exception $e) {
                \Log::error('Failed to send booking status update email: ' . $e->getMessage());
            }
        }

        return redirect()->back()->with('success', 'Booking status updated successfully.');
    }

    public function updatePaymentStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'payment_status' => 'required|in:pending,paid,failed,cancelled,refunded',
        ]);

        $oldPaymentStatus = $booking->payment_status;
        $newPaymentStatus = $request->payment_status;

        $booking->update([
            'payment_status' => $newPaymentStatus,
        ]);

        // If payment is confirmed and booking is still pending, auto-confirm booking
        if ($newPaymentStatus === 'paid' && $booking->booking_status === 'pending') {
            $oldStatus = $booking->booking_status;
            $booking->update(['booking_status' => 'confirmed']);
            
            // Send status update email
            if ($booking->user && $booking->user->email) {
                try {
                    $booking->load(['user', 'serviceType']);
                    Mail::to($booking->user->email)->send(
                        new BookingStatusUpdate($booking, $oldStatus, 'confirmed')
                    );
                } catch (\Exception $e) {
                    \Log::error('Failed to send booking confirmation email: ' . $e->getMessage());
                }
            }
        }

        return redirect()->back()->with('success', 'Payment status updated successfully.');
    }
}
