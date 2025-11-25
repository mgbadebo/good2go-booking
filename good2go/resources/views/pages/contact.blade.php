@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-4xl px-4 py-10">
    <h1 class="text-xl font-semibold tracking-tight text-slate-900">Contact us</h1>
    <p class="mt-2 text-sm text-slate-600">
        Have a question or want to make a special request? Send us a message and we'll get back to you.
    </p>

    <div class="mt-6 grid gap-6 md:grid-cols-2 text-sm">
        <form class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-100">
            {{-- Hook this up to ContactMessage later --}}
            <div class="mb-3">
                <label class="mb-1 block text-xs font-medium text-slate-700">Name</label>
                <input type="text" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
            </div>
            <div class="mb-3">
                <label class="mb-1 block text-xs font-medium text-slate-700">Email</label>
                <input type="email" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
            </div>
            <div class="mb-3">
                <label class="mb-1 block text-xs font-medium text-slate-700">Phone</label>
                <input type="text" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
            </div>
            <div class="mb-3">
                <label class="mb-1 block text-xs font-medium text-slate-700">Message</label>
                <textarea class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500" rows="4"></textarea>
            </div>
            <button type="button" class="mt-2 w-full rounded-full bg-indigo-600 px-4 py-2 text-xs font-semibold text-white hover:bg-indigo-500">
                Send message (wire later)
            </button>
        </form>

        <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-100">
            <h2 class="text-sm font-semibold text-slate-900">Other ways to reach us</h2>
            <ul class="mt-3 space-y-2 text-sm text-slate-600">
                <li><span class="font-medium">Phone:</span> +234 XXX XXX XXXX</li>
                <li><span class="font-medium">Email:</span> info@good2go.example</li>
                <li><span class="font-medium">WhatsApp:</span> Click-to-chat button coming soon</li>
                <li><span class="font-medium">Hours:</span> 06:00 – 22:00, 7 days a week</li>
            </ul>
        </div>
    </div>
</div>
@endsection

