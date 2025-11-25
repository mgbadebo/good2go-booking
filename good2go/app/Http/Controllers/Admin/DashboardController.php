<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Total bookings
        $totalBookings = Booking::count();
        
        // Total revenue (from paid bookings)
        $totalRevenue = Booking::where('payment_status', 'paid')
            ->sum('total_price');
        
        // Upcoming bookings (next 7 days)
        $upcomingBookings = Booking::where('start_datetime', '>=', now())
            ->where('start_datetime', '<=', now()->addDays(7))
            ->whereIn('booking_status', ['pending', 'confirmed'])
            ->orderBy('start_datetime')
            ->with(['user', 'serviceType'])
            ->get();
        
        // Recent bookings
        $recentBookings = Booking::with(['user', 'serviceType'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
        
        // Bookings by status
        $bookingsByStatus = Booking::select('booking_status', DB::raw('count(*) as count'))
            ->groupBy('booking_status')
            ->pluck('count', 'booking_status');
        
        // Revenue this month
        $revenueThisMonth = Booking::where('payment_status', 'paid')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total_price');

        return view('admin.dashboard', compact(
            'totalBookings',
            'totalRevenue',
            'upcomingBookings',
            'recentBookings',
            'bookingsByStatus',
            'revenueThisMonth'
        ));
    }
}
