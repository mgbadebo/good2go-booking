@extends('admin.layout')

@section('content')
<div class="space-y-6">
    <h1 class="text-2xl font-bold text-slate-900">Dashboard</h1>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-lg shadow p-4">
            <div class="text-sm text-slate-600">Total Bookings</div>
            <div class="text-2xl font-bold text-slate-900 mt-1">{{ number_format($totalBookings) }}</div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <div class="text-sm text-slate-600">Total Revenue</div>
            <div class="text-2xl font-bold text-slate-900 mt-1">₦{{ number_format($totalRevenue, 2) }}</div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <div class="text-sm text-slate-600">Revenue This Month</div>
            <div class="text-2xl font-bold text-slate-900 mt-1">₦{{ number_format($revenueThisMonth, 2) }}</div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <div class="text-sm text-slate-600">Upcoming Bookings</div>
            <div class="text-2xl font-bold text-slate-900 mt-1">{{ $upcomingBookings->count() }}</div>
        </div>
    </div>

    <!-- Bookings by Status -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold text-slate-900 mb-4">Bookings by Status</h2>
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
            @foreach(['pending', 'confirmed', 'in_progress', 'completed', 'cancelled'] as $status)
                <div class="text-center">
                    <div class="text-2xl font-bold text-slate-900">{{ $bookingsByStatus[$status] ?? 0 }}</div>
                    <div class="text-xs text-slate-600 mt-1">{{ ucfirst(str_replace('_', ' ', $status)) }}</div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Upcoming Bookings -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold text-slate-900 mb-4">Upcoming Bookings (Next 7 Days)</h2>
        @if($upcomingBookings->isEmpty())
            <p class="text-sm text-slate-500">No upcoming bookings.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">Date/Time</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">Customer</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">Service</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">Status</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">Amount</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @foreach($upcomingBookings as $booking)
                            <tr>
                                <td class="px-4 py-3 text-sm text-slate-900">
                                    {{ $booking->start_datetime->format('M d, Y H:i') }}
                                </td>
                                <td class="px-4 py-3 text-sm text-slate-900">{{ $booking->user->name }}</td>
                                <td class="px-4 py-3 text-sm text-slate-900">{{ $booking->serviceType->name }}</td>
                                <td class="px-4 py-3 text-sm">
                                    <span class="px-2 py-1 rounded-full text-xs font-medium
                                        {{ $booking->booking_status === 'confirmed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ ucfirst(str_replace('_', ' ', $booking->booking_status)) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm text-slate-900">₦{{ number_format($booking->total_price, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- Recent Bookings -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold text-slate-900 mb-4">Recent Bookings</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">Date</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">Customer</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">Service</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">Payment</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @foreach($recentBookings as $booking)
                        <tr>
                            <td class="px-4 py-3 text-sm text-slate-900">
                                {{ $booking->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-4 py-3 text-sm text-slate-900">{{ $booking->user->name }}</td>
                            <td class="px-4 py-3 text-sm text-slate-900">{{ $booking->serviceType->name }}</td>
                            <td class="px-4 py-3 text-sm">
                                <span class="px-2 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-800">
                                    {{ ucfirst(str_replace('_', ' ', $booking->booking_status)) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <span class="px-2 py-1 rounded-full text-xs font-medium
                                    {{ $booking->payment_status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst($booking->payment_status) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

