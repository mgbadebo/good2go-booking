@extends('admin.layout')

@section('content')
<div class="max-w-2xl">
    <h1 class="text-2xl font-bold text-slate-900 mb-6">Create Service</h1>

    <form method="POST" action="{{ route('admin.services.store') }}" class="bg-white rounded-lg shadow p-6 space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required class="w-full rounded-lg border border-slate-200 px-3 py-2">
            @error('name')<p class="text-xs text-rose-600 mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Slug</label>
            <input type="text" name="slug" value="{{ old('slug') }}" required class="w-full rounded-lg border border-slate-200 px-3 py-2">
            @error('slug')<p class="text-xs text-rose-600 mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Description</label>
            <textarea name="description" rows="3" class="w-full rounded-lg border border-slate-200 px-3 py-2">{{ old('description') }}</textarea>
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
            <a href="{{ route('admin.services.index') }}" class="px-4 py-2 bg-slate-200 text-slate-700 rounded-lg text-sm font-medium hover:bg-slate-300">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection

