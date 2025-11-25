@extends('admin.layout')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-slate-900">Driver Applications</h1>
        <a href="{{ route('admin.drivers.index') }}" class="px-4 py-2 bg-slate-200 text-slate-700 rounded-lg text-sm font-medium hover:bg-slate-300">
            Back to Drivers
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">Name</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">Phone</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">Email</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">Status</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">Date</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @foreach($applications as $application)
                    <tr>
                        <td class="px-4 py-3 text-sm text-slate-900">{{ $application->first_name }} {{ $application->last_name }}</td>
                        <td class="px-4 py-3 text-sm text-slate-900">{{ $application->phone }}</td>
                        <td class="px-4 py-3 text-sm text-slate-900">{{ $application->email ?? 'N/A' }}</td>
                        <td class="px-4 py-3 text-sm">
                            <span class="px-2 py-1 rounded-full text-xs font-medium
                                {{ $application->status === 'approved' ? 'bg-green-100 text-green-800' : ($application->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                {{ ucfirst($application->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm text-slate-900">{{ $application->created_at->format('M d, Y') }}</td>
                        <td class="px-4 py-3 text-sm">
                            @if($application->status === 'pending')
                                <form method="POST" action="{{ route('admin.drivers.applications.approve', $application) }}" class="inline mr-2">
                                    @csrf
                                    <button type="submit" class="text-green-600 hover:text-green-800">Approve</button>
                                </form>
                                <form method="POST" action="{{ route('admin.drivers.applications.reject', $application) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="text-rose-600 hover:text-rose-800">Reject</button>
                                </form>
                            @else
                                <span class="text-slate-400">-</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

