@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-3xl px-4 py-10">
    <h1 class="text-xl font-semibold tracking-tight text-slate-900">Book a driver</h1>
    <p class="mt-2 text-sm text-slate-600">
        Choose your service, date, and time. We'll confirm availability and payment details.
    </p>

    @if (session('success'))
        <div class="mt-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-xs text-emerald-800">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mt-4 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-xs text-rose-800">
            <ul class="list-disc pl-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('bookings.store') }}" class="mt-6 space-y-4 rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-100">
        @csrf

        <div>
            <label class="mb-1 block text-xs font-medium text-slate-700">Service type</label>
            <select name="service_type_id"
                    class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500"
                    required>
                <option value="">-- Select service --</option>
                @foreach($serviceTypes as $type)
                    <option value="{{ $type->id }}" @selected(old('service_type_id') == $type->id)>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="grid gap-4 md:grid-cols-2">
            <div>
                <label class="mb-1 block text-xs font-medium text-slate-700">Hire type</label>
                <select name="hire_type"
                        class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500"
                        required>
                    <option value="hourly" @selected(old('hire_type') === 'hourly')>Hourly (min 2 hours)</option>
                    <option value="daily" @selected(old('hire_type') === 'daily')>Daily</option>
                </select>
            </div>
            <div>
                <label class="mb-1 block text-xs font-medium text-slate-700">Date</label>
                <input type="date" name="date"
                       value="{{ old('date') }}"
                       class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500"
                       required>
            </div>
        </div>

        <div class="grid gap-4 md:grid-cols-2">
            <div>
                <label class="mb-1 block text-xs font-medium text-slate-700">Start time</label>
                <input type="time" name="start_time"
                       value="{{ old('start_time') }}"
                       class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500"
                       required>
            </div>
            <div>
                <label class="mb-1 block text-xs font-medium text-slate-700">Duration (hours)</label>
                <input type="number" name="duration_hours"
                       value="{{ old('duration_hours', 2) }}"
                       min="1"
                       class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                <p class="mt-1 text-[11px] text-slate-500">Minimum charge is 2 hours for hourly hire.</p>
            </div>
        </div>

        <div>
            <label class="mb-1 block text-xs font-medium text-slate-700">Pickup location</label>
            <input type="text" name="pickup_location"
                   value="{{ old('pickup_location') }}"
                   class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500"
                   required>
        </div>

        <div>
            <label class="mb-1 block text-xs font-medium text-slate-700">Drop-off location (optional)</label>
            <input type="text" name="dropoff_location"
                   value="{{ old('dropoff_location') }}"
                   class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
        </div>

        <div>
            <label class="mb-1 block text-xs font-medium text-slate-700">Notes (optional)</label>
            <textarea name="notes" rows="3"
                      class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">{{ old('notes') }}</textarea>
        </div>

        <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
            <p class="text-slate-500">
                Payments are currently via bank transfer. Online card payments (Paystack) coming soon.
            </p>
            <button type="submit"
                    class="rounded-full bg-indigo-600 px-5 py-2 font-semibold text-white hover:bg-indigo-500">
                Submit booking
            </button>
        </div>
    </form>
</div>
@endsection
