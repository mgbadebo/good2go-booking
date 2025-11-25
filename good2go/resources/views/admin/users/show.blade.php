@extends('admin.layout')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-slate-900">User: {{ $user->name }}</h1>
        <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-slate-200 text-slate-700 rounded-lg text-sm font-medium hover:bg-slate-300">
            Back to List
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- User Details -->
        <div class="bg-white rounded-lg shadow p-6 space-y-4">
            <h2 class="text-lg font-semibold text-slate-900">User Details</h2>
            <div class="space-y-2 text-sm">
                <div><span class="font-medium text-slate-700">Name:</span> {{ $user->name }}</div>
                <div><span class="font-medium text-slate-700">Phone:</span> {{ $user->phone }}</div>
                @if($user->email)
                    <div><span class="font-medium text-slate-700">Email:</span> {{ $user->email }}</div>
                @endif
                <div><span class="font-medium text-slate-700">Phone Verified:</span> 
                    {{ $user->phone_verified_at ? $user->phone_verified_at->format('M d, Y H:i') : 'Not verified' }}
                </div>
                <div><span class="font-medium text-slate-700">Registered:</span> {{ $user->created_at->format('M d, Y H:i') }}</div>
            </div>
        </div>

        <!-- Status Update -->
        <div class="bg-white rounded-lg shadow p-6 space-y-4">
            <h2 class="text-lg font-semibold text-slate-900">Update Status</h2>
            <form method="POST" action="{{ route('admin.users.update-status', $user) }}">
                @csrf
                @method('PATCH')
                <select name="status" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm mb-3">
                    @foreach(['active', 'inactive', 'banned'] as $status)
                        <option value="{{ $status }}" {{ $user->status === $status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="w-full px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-500">
                    Update Status
                </button>
            </form>
        </div>

        <!-- Bookings -->
        <div class="bg-white rounded-lg shadow p-6 md:col-span-2">
            <h2 class="text-lg font-semibold text-slate-900 mb-4">Bookings ({{ $user->bookings->count() }})</h2>
            @if($user->bookings->isEmpty())
                <p class="text-sm text-slate-500">No bookings yet.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">ID</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">Service</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">Date/Time</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">Amount</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">
                            @foreach($user->bookings as $booking)
                                <tr>
                                    <td class="px-4 py-3 text-sm text-slate-900">#{{ $booking->id }}</td>
                                    <td class="px-4 py-3 text-sm text-slate-900">{{ $booking->serviceType->name }}</td>
                                    <td class="px-4 py-3 text-sm text-slate-900">{{ $booking->start_datetime->format('M d, Y H:i') }}</td>
                                    <td class="px-4 py-3 text-sm">
                                        <span class="px-2 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-800">
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
    </div>
</div>
@endsection

