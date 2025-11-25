@extends('admin.layout')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-slate-900">Drivers</h1>
        <div class="flex gap-3">
            <a href="{{ route('admin.drivers.applications') }}" class="px-4 py-2 bg-slate-200 text-slate-700 rounded-lg text-sm font-medium hover:bg-slate-300">
                View Applications
            </a>
            <a href="{{ route('admin.drivers.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-500">
                Add Driver
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">Name</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">Phone</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">License</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">Status</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">Approved</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @foreach($drivers as $driver)
                    <tr>
                        <td class="px-4 py-3 text-sm text-slate-900">{{ $driver->first_name }} {{ $driver->last_name }}</td>
                        <td class="px-4 py-3 text-sm text-slate-900">{{ $driver->phone }}</td>
                        <td class="px-4 py-3 text-sm text-slate-900">{{ $driver->license_number }}</td>
                        <td class="px-4 py-3 text-sm">
                            <span class="px-2 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-800">
                                {{ ucfirst(str_replace('_', ' ', $driver->status)) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <span class="px-2 py-1 rounded-full text-xs font-medium {{ $driver->is_approved ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $driver->is_approved ? 'Yes' : 'No' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <a href="{{ route('admin.drivers.edit', $driver) }}" class="text-indigo-600 hover:text-indigo-800 mr-3">Edit</a>
                            <form method="POST" action="{{ route('admin.drivers.destroy', $driver) }}" class="inline" onsubmit="return confirm('Are you sure?')">
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

