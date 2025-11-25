@extends('admin.layout')

@section('content')
<div class="space-y-6">
    <h1 class="text-2xl font-bold text-slate-900">Availability Management</h1>

    <!-- Working Hours -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold text-slate-900 mb-4">Working Hours</h2>
        <form method="POST" action="{{ route('admin.availability.working-hours.store') }}" class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-4">
            @csrf
            <div>
                <label class="block text-xs font-medium text-slate-700 mb-1">Day</label>
                <select name="day_of_week" required class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm">
                    <option value="0">Sunday</option>
                    <option value="1">Monday</option>
                    <option value="2">Tuesday</option>
                    <option value="3">Wednesday</option>
                    <option value="4">Thursday</option>
                    <option value="5">Friday</option>
                    <option value="6">Saturday</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-700 mb-1">Start Time</label>
                <input type="time" name="start_time" required class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-700 mb-1">End Time</label>
                <input type="time" name="end_time" required class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm">
            </div>
            <div>
                <label class="flex items-center mt-6">
                    <input type="checkbox" name="is_available" value="1" checked class="rounded border-slate-300">
                    <span class="ml-2 text-sm text-slate-700">Available</span>
                </label>
            </div>
            <div class="flex items-end">
                <button type="submit" class="w-full px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-500">
                    Add
                </button>
            </div>
        </form>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">Day</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">Time</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @foreach($availabilityRules as $rule)
                        <tr>
                            <td class="px-4 py-3 text-sm text-slate-900">
                                {{ ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'][$rule->day_of_week] }}
                            </td>
                            <td class="px-4 py-3 text-sm text-slate-900">
                                {{ \Carbon\Carbon::parse($rule->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($rule->end_time)->format('H:i') }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <span class="px-2 py-1 rounded-full text-xs font-medium {{ $rule->is_available ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $rule->is_available ? 'Available' : 'Unavailable' }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <form method="POST" action="{{ route('admin.availability.working-hours.destroy', $rule) }}" class="inline" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-rose-600 hover:text-rose-800">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Blackout Dates -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold text-slate-900 mb-4">Blackout Dates</h2>
        <form method="POST" action="{{ route('admin.availability.blackout-dates.store') }}" class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-4">
            @csrf
            <div>
                <label class="block text-xs font-medium text-slate-700 mb-1">Service (optional)</label>
                <select name="service_type_id" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm">
                    <option value="">All Services</option>
                    @foreach($serviceTypes as $service)
                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-700 mb-1">Start Date</label>
                <input type="date" name="start_date" required class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-700 mb-1">End Date</label>
                <input type="date" name="end_date" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-700 mb-1">Reason</label>
                <input type="text" name="reason" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm">
            </div>
            <div class="flex items-end">
                <button type="submit" class="w-full px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-500">
                    Add
                </button>
            </div>
        </form>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">Service</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">Date Range</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">Reason</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @foreach($blackoutDates as $blackout)
                        <tr>
                            <td class="px-4 py-3 text-sm text-slate-900">{{ $blackout->serviceType->name ?? 'All Services' }}</td>
                            <td class="px-4 py-3 text-sm text-slate-900">
                                {{ $blackout->start_date->format('M d, Y') }}
                                @if($blackout->end_date && $blackout->end_date != $blackout->start_date)
                                    - {{ $blackout->end_date->format('M d, Y') }}
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm text-slate-900">{{ $blackout->reason ?? 'N/A' }}</td>
                            <td class="px-4 py-3 text-sm">
                                <form method="POST" action="{{ route('admin.availability.blackout-dates.destroy', $blackout) }}" class="inline" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-rose-600 hover:text-rose-800">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

