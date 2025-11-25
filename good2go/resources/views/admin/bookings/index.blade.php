@extends('admin.layout')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-slate-900">Bookings</h1>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow p-4">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <div>
                <label class="block text-xs font-medium text-slate-700 mb-1">Search</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Name or phone" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-700 mb-1">Status</label>
                <select name="status" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm">
                    <option value="">All</option>
                    @foreach(['pending', 'confirmed', 'in_progress', 'completed', 'cancelled'] as $status)
                        <option value="{{ $status }}" {{ request('status') === $status ? 'selected' : '' }}>
                            {{ ucfirst(str_replace('_', ' ', $status)) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-700 mb-1">Payment Status</label>
                <select name="payment_status" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm">
                    <option value="">All</option>
                    @foreach(['pending', 'paid', 'failed', 'cancelled', 'refunded'] as $status)
                        <option value="{{ $status }}" {{ request('payment_status') === $status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-700 mb-1">From Date</label>
                <input type="date" name="date_from" value="{{ request('date_from') }}" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-700 mb-1">To Date</label>
                <input type="date" name="date_to" value="{{ request('date_to') }}" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm">
            </div>
            <div class="md:col-span-5">
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-500">
                    Filter
                </button>
                <a href="{{ route('admin.bookings.index') }}" class="ml-2 px-4 py-2 bg-slate-200 text-slate-700 rounded-lg text-sm font-medium hover:bg-slate-300">
                    Clear
                </a>
            </div>
        </form>
    </div>

    <!-- Bookings Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">ID</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">Customer</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">Service</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">Date/Time</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">Payment</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">Amount</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse($bookings as $booking)
                        <tr>
                            <td class="px-4 py-3 text-sm text-slate-900">#{{ $booking->id }}</td>
                            <td class="px-4 py-3 text-sm text-slate-900">{{ $booking->user->name }}</td>
                            <td class="px-4 py-3 text-sm text-slate-900">{{ $booking->serviceType->name }}</td>
                            <td class="px-4 py-3 text-sm text-slate-900">
                                {{ $booking->start_datetime->format('M d, Y H:i') }}
                            </td>
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
                            <td class="px-4 py-3 text-sm text-slate-900">₦{{ number_format($booking->total_price, 2) }}</td>
                            <td class="px-4 py-3 text-sm">
                                <a href="{{ route('admin.bookings.show', $booking) }}" class="text-indigo-600 hover:text-indigo-800">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-8 text-center text-sm text-slate-500">No bookings found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-4 py-3 border-t border-slate-200">
            {{ $bookings->links() }}
        </div>
    </div>
</div>
@endsection

