@extends('admin.layout')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-slate-900">Booking #{{ $booking->id }}</h1>
        <a href="{{ route('admin.bookings.index') }}" class="px-4 py-2 bg-slate-200 text-slate-700 rounded-lg text-sm font-medium hover:bg-slate-300">
            Back to List
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Booking Details -->
        <div class="bg-white rounded-lg shadow p-6 space-y-4">
            <h2 class="text-lg font-semibold text-slate-900">Booking Details</h2>
            <div class="space-y-2 text-sm">
                <div><span class="font-medium text-slate-700">Service:</span> {{ $booking->serviceType->name }}</div>
                <div><span class="font-medium text-slate-700">Hire Type:</span> {{ ucfirst($booking->hire_type) }}</div>
                <div><span class="font-medium text-slate-700">Start:</span> {{ $booking->start_datetime->format('M d, Y H:i') }}</div>
                <div><span class="font-medium text-slate-700">End:</span> {{ $booking->end_datetime?->format('M d, Y H:i') ?? 'N/A' }}</div>
                <div><span class="font-medium text-slate-700">Pickup:</span> {{ $booking->pickup_location }}</div>
                @if($booking->dropoff_location)
                    <div><span class="font-medium text-slate-700">Drop-off:</span> {{ $booking->dropoff_location }}</div>
                @endif
                @if($booking->notes)
                    <div><span class="font-medium text-slate-700">Notes:</span> {{ $booking->notes }}</div>
                @endif
            </div>
        </div>

        <!-- Customer Details -->
        <div class="bg-white rounded-lg shadow p-6 space-y-4">
            <h2 class="text-lg font-semibold text-slate-900">Customer</h2>
            <div class="space-y-2 text-sm">
                <div><span class="font-medium text-slate-700">Name:</span> {{ $booking->user->name }}</div>
                <div><span class="font-medium text-slate-700">Phone:</span> {{ $booking->user->phone }}</div>
                @if($booking->user->email)
                    <div><span class="font-medium text-slate-700">Email:</span> {{ $booking->user->email }}</div>
                @endif
            </div>
        </div>

        <!-- Status Updates -->
        <div class="bg-white rounded-lg shadow p-6 space-y-4">
            <h2 class="text-lg font-semibold text-slate-900">Update Status</h2>
            <form method="POST" action="{{ route('admin.bookings.update-status', $booking) }}">
                @csrf
                @method('PATCH')
                <select name="booking_status" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm mb-3">
                    @foreach(['pending', 'confirmed', 'in_progress', 'completed', 'cancelled'] as $status)
                        <option value="{{ $status }}" {{ $booking->booking_status === $status ? 'selected' : '' }}>
                            {{ ucfirst(str_replace('_', ' ', $status)) }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="w-full px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-500">
                    Update Booking Status
                </button>
            </form>
        </div>

        <!-- Payment Status -->
        <div class="bg-white rounded-lg shadow p-6 space-y-4">
            <h2 class="text-lg font-semibold text-slate-900">Payment</h2>
            <div class="space-y-2 text-sm mb-4">
                <div><span class="font-medium text-slate-700">Amount:</span> ₦{{ number_format($booking->total_price, 2) }}</div>
                <div><span class="font-medium text-slate-700">Method:</span> {{ ucfirst(str_replace('_', ' ', $booking->payment_method)) }}</div>
                <div><span class="font-medium text-slate-700">Status:</span> 
                    <span class="px-2 py-1 rounded-full text-xs font-medium
                        {{ $booking->payment_status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                        {{ ucfirst($booking->payment_status) }}
                    </span>
                </div>
            </div>
            <form method="POST" action="{{ route('admin.bookings.update-payment-status', $booking) }}">
                @csrf
                @method('PATCH')
                <select name="payment_status" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm mb-3">
                    @foreach(['pending', 'paid', 'failed', 'cancelled', 'refunded'] as $status)
                        <option value="{{ $status }}" {{ $booking->payment_status === $status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="w-full px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-500">
                    Update Payment Status
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

