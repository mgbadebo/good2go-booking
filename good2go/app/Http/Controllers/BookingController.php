<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\ServiceType;
use App\Models\PricingRule;
use App\Mail\BookingConfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::where('user_id', auth()->id())
            ->orderBy('start_datetime', 'desc')
            ->get();

        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $serviceTypes = ServiceType::where('is_active', true)->get();

        return view('bookings.create', compact('serviceTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_type_id' => 'required|exists:service_types,id',
            'hire_type'       => 'required|in:hourly,daily',
            'date'            => 'required|date',
            'start_time'      => 'required',
            'duration_hours'  => 'nullable|integer|min:1',
            'pickup_location' => 'required|string|max:255',
            'dropoff_location'=> 'nullable|string|max:255',
        ]);

        $serviceType = ServiceType::findOrFail($request->service_type_id);

        // Build start/end datetime
        $start = \Carbon\Carbon::parse($request->date.' '.$request->start_time);

        if ($request->hire_type === 'hourly') {
            $requestedHours = (int) $request->input('duration_hours', 2);
            $pricing = PricingRule::where('service_type_id', $serviceType->id)
                ->where('hire_type', 'hourly')
                ->where('is_active', true)
                ->firstOrFail();

            $hoursToCharge = max($requestedHours, $pricing->min_hours ?? 2);
            $totalPrice = $hoursToCharge * $pricing->base_rate;

            $end = (clone $start)->addHours($requestedHours);
        } else {
            // daily
            $pricing = PricingRule::where('service_type_id', $serviceType->id)
                ->where('hire_type', 'daily')
                ->where('is_active', true)
                ->firstOrFail();

            $totalPrice = $pricing->base_rate;
            $dailyHours = $pricing->daily_hours ?? 10;
            $end = (clone $start)->addHours($dailyHours);
        }

        // TODO: check availability (no overlapping bookings, blackout dates etc.)

        $booking = Booking::create([
            'user_id'         => auth()->id(),
            'service_type_id' => $serviceType->id,
            'driver_id'       => null,
            'hire_type'       => $request->hire_type,
            'start_datetime'  => $start,
            'end_datetime'    => $end,
            'duration_hours'  => $request->hire_type === 'hourly' ? $requestedHours : null,
            'pickup_location' => $request->pickup_location,
            'dropoff_location'=> $request->dropoff_location,
            'notes'           => $request->notes,
            'payment_method'  => 'bank_transfer', // for now; Paystack later
            'payment_status'  => 'pending',
            'booking_status'  => 'pending',
            'total_price'     => $totalPrice,
            'currency'        => 'NGN',
        ]);

        // Send booking confirmation email
        if ($booking->user->email) {
            try {
                $booking->load(['user', 'serviceType']);
                Mail::to($booking->user->email)->send(new BookingConfirmation($booking));
            } catch (\Exception $e) {
                // Log error but don't fail the booking creation
                \Log::error('Failed to send booking confirmation email: ' . $e->getMessage());
            }
        }

        return redirect()
            ->route('bookings.index')
            ->with('success', 'Booking created! We will confirm availability and payment instructions.');
    }
}
