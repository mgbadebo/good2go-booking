@extends('admin.layout')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-slate-900">Pricing Rules</h1>
        <a href="{{ route('admin.pricing.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-500">
            Add Pricing Rule
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">Service</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">Hire Type</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">Base Rate</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">Min Hours</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">Status</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @foreach($pricingRules as $rule)
                    <tr>
                        <td class="px-4 py-3 text-sm text-slate-900">{{ $rule->serviceType->name }}</td>
                        <td class="px-4 py-3 text-sm text-slate-900">{{ ucfirst($rule->hire_type) }}</td>
                        <td class="px-4 py-3 text-sm text-slate-900">₦{{ number_format($rule->base_rate, 2) }}</td>
                        <td class="px-4 py-3 text-sm text-slate-900">{{ $rule->min_hours ?? $rule->daily_hours ?? 'N/A' }}</td>
                        <td class="px-4 py-3 text-sm">
                            <span class="px-2 py-1 rounded-full text-xs font-medium {{ $rule->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $rule->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <a href="{{ route('admin.pricing.edit', $rule) }}" class="text-indigo-600 hover:text-indigo-800 mr-3">Edit</a>
                            <form method="POST" action="{{ route('admin.pricing.destroy', $rule) }}" class="inline" onsubmit="return confirm('Are you sure?')">
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
@endsection

