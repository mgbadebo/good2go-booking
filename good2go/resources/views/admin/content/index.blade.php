@extends('admin.layout')

@section('content')
<div class="max-w-4xl">
    <h1 class="text-2xl font-bold text-slate-900 mb-6">Site Content & Settings</h1>

    <form method="POST" action="{{ route('admin.content.update') }}" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- About Us -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold text-slate-900 mb-4">About Us</h2>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Content</label>
                <textarea name="about_content" rows="6" class="w-full rounded-lg border border-slate-200 px-3 py-2">{{ $settings->get('about')?->first()?->value ?? '' }}</textarea>
            </div>
        </div>

        <!-- Contact Info -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold text-slate-900 mb-4">Contact Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Phone</label>
                    <input type="text" name="contact_phone" value="{{ $settings->get('contact')?->firstWhere('key', 'contact_phone')?->value ?? '' }}" class="w-full rounded-lg border border-slate-200 px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                    <input type="email" name="contact_email" value="{{ $settings->get('contact')?->firstWhere('key', 'contact_email')?->value ?? '' }}" class="w-full rounded-lg border border-slate-200 px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">WhatsApp</label>
                    <input type="text" name="contact_whatsapp" value="{{ $settings->get('contact')?->firstWhere('key', 'contact_whatsapp')?->value ?? '' }}" class="w-full rounded-lg border border-slate-200 px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Working Hours</label>
                    <input type="text" name="contact_hours" value="{{ $settings->get('contact')?->firstWhere('key', 'contact_hours')?->value ?? '' }}" placeholder="e.g., 06:00 – 22:00, 7 days a week" class="w-full rounded-lg border border-slate-200 px-3 py-2">
                </div>
            </div>
        </div>

        <!-- Bank Details -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold text-slate-900 mb-4">Bank Transfer Details</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Bank Name</label>
                    <input type="text" name="bank_name" value="{{ $settings->get('payment')?->firstWhere('key', 'bank_name')?->value ?? '' }}" class="w-full rounded-lg border border-slate-200 px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Account Name</label>
                    <input type="text" name="bank_account_name" value="{{ $settings->get('payment')?->firstWhere('key', 'bank_account_name')?->value ?? '' }}" class="w-full rounded-lg border border-slate-200 px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Account Number</label>
                    <input type="text" name="bank_account_number" value="{{ $settings->get('payment')?->firstWhere('key', 'bank_account_number')?->value ?? '' }}" class="w-full rounded-lg border border-slate-200 px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Sort Code (optional)</label>
                    <input type="text" name="bank_sort_code" value="{{ $settings->get('payment')?->firstWhere('key', 'bank_sort_code')?->value ?? '' }}" class="w-full rounded-lg border border-slate-200 px-3 py-2">
                </div>
            </div>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-500">
                Save Changes
            </button>
        </div>
    </form>
</div>
@endsection

