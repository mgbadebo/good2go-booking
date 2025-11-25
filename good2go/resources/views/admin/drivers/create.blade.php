@extends('admin.layout')

@section('content')
<div class="max-w-2xl">
    <h1 class="text-2xl font-bold text-slate-900 mb-6">Create Driver</h1>

    <form method="POST" action="{{ route('admin.drivers.store') }}" class="bg-white rounded-lg shadow p-6 space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">User (optional)</label>
            <select name="user_id" class="w-full rounded-lg border border-slate-200 px-3 py-2">
                <option value="">None</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->phone }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">First Name</label>
                <input type="text" name="first_name" value="{{ old('first_name') }}" required class="w-full rounded-lg border border-slate-200 px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Last Name</label>
                <input type="text" name="last_name" value="{{ old('last_name') }}" required class="w-full rounded-lg border border-slate-200 px-3 py-2">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Phone</label>
                <input type="text" name="phone" value="{{ old('phone') }}" required class="w-full rounded-lg border border-slate-200 px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Email (optional)</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full rounded-lg border border-slate-200 px-3 py-2">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">License Number</label>
            <input type="text" name="license_number" value="{{ old('license_number') }}" required class="w-full rounded-lg border border-slate-200 px-3 py-2">
        </div>

        <div class="grid grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Vehicle Make</label>
                <input type="text" name="vehicle_make" value="{{ old('vehicle_make') }}" class="w-full rounded-lg border border-slate-200 px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Vehicle Model</label>
                <input type="text" name="vehicle_model" value="{{ old('vehicle_model') }}" class="w-full rounded-lg border border-slate-200 px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Year</label>
                <input type="number" name="vehicle_year" value="{{ old('vehicle_year') }}" class="w-full rounded-lg border border-slate-200 px-3 py-2">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Vehicle Color</label>
                <input type="text" name="vehicle_color" value="{{ old('vehicle_color') }}" class="w-full rounded-lg border border-slate-200 px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">License Plate</label>
                <input type="text" name="license_plate" value="{{ old('license_plate') }}" class="w-full rounded-lg border border-slate-200 px-3 py-2">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Status</label>
            <select name="status" required class="w-full rounded-lg border border-slate-200 px-3 py-2">
                <option value="available" {{ old('status') === 'available' ? 'selected' : '' }}>Available</option>
                <option value="on_duty" {{ old('status') === 'on_duty' ? 'selected' : '' }}>On Duty</option>
                <option value="off_duty" {{ old('status') === 'off_duty' ? 'selected' : '' }}>Off Duty</option>
                <option value="unavailable" {{ old('status') === 'unavailable' ? 'selected' : '' }}>Unavailable</option>
            </select>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-500">
                Create
            </button>
            <a href="{{ route('admin.drivers.index') }}" class="px-4 py-2 bg-slate-200 text-slate-700 rounded-lg text-sm font-medium hover:bg-slate-300">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection

