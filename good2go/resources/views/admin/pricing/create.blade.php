@extends('admin.layout')

@section('content')
<div class="max-w-2xl">
    <h1 class="text-2xl font-bold text-slate-900 mb-6">Create Pricing Rule</h1>

    <form method="POST" action="{{ route('admin.pricing.store') }}" class="bg-white rounded-lg shadow p-6 space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Service Type</label>
            <select name="service_type_id" required class="w-full rounded-lg border border-slate-200 px-3 py-2">
                <option value="">Select service</option>
                @foreach($serviceTypes as $service)
                    <option value="{{ $service->id }}" {{ old('service_type_id') == $service->id ? 'selected' : '' }}>
                        {{ $service->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Hire Type</label>
            <select name="hire_type" required class="w-full rounded-lg border border-slate-200 px-3 py-2">
                <option value="hourly" {{ old('hire_type') === 'hourly' ? 'selected' : '' }}>Hourly</option>
                <option value="daily" {{ old('hire_type') === 'daily' ? 'selected' : '' }}>Daily</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Currency</label>
            <input type="text" name="currency" value="{{ old('currency', 'NGN') }}" maxlength="3" required class="w-full rounded-lg border border-slate-200 px-3 py-2">
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Base Rate</label>
            <input type="number" name="base_rate" value="{{ old('base_rate') }}" step="0.01" min="0" required class="w-full rounded-lg border border-slate-200 px-3 py-2">
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Min Hours (for hourly)</label>
            <input type="number" name="min_hours" value="{{ old('min_hours') }}" min="1" class="w-full rounded-lg border border-slate-200 px-3 py-2">
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Daily Hours (for daily)</label>
            <input type="number" name="daily_hours" value="{{ old('daily_hours') }}" min="1" class="w-full rounded-lg border border-slate-200 px-3 py-2">
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Night Surcharge Type</label>
            <select name="night_surcharge_type" required class="w-full rounded-lg border border-slate-200 px-3 py-2">
                <option value="none" {{ old('night_surcharge_type', 'none') === 'none' ? 'selected' : '' }}>None</option>
                <option value="percent" {{ old('night_surcharge_type') === 'percent' ? 'selected' : '' }}>Percent</option>
                <option value="flat" {{ old('night_surcharge_type') === 'flat' ? 'selected' : '' }}>Flat</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Night Surcharge Value</label>
            <input type="number" name="night_surcharge_value" value="{{ old('night_surcharge_value', 0) }}" step="0.01" min="0" required class="w-full rounded-lg border border-slate-200 px-3 py-2">
        </div>

        <div>
            <label class="flex items-center">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="rounded border-slate-300">
                <span class="ml-2 text-sm text-slate-700">Active</span>
            </label>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-500">
                Create
            </button>
            <a href="{{ route('admin.pricing.index') }}" class="px-4 py-2 bg-slate-200 text-slate-700 rounded-lg text-sm font-medium hover:bg-slate-300">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection

