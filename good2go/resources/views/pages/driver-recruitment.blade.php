@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-4xl px-4 py-10">
    <h1 class="text-xl font-semibold tracking-tight text-slate-900">Driver recruitment</h1>
    <p class="mt-2 text-sm text-slate-600">
        We're always on the lookout for professional, responsible drivers to join the Good2Go network.
        If you meet the criteria, submit your details below.
    </p>

    <div class="mt-6 grid gap-6 md:grid-cols-2 text-sm">
        <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-100">
            <h2 class="text-sm font-semibold text-slate-900">Requirements</h2>
            <ul class="mt-3 space-y-1 text-slate-600 text-xs">
                <li>• Minimum age: 25 years</li>
                <li>• Valid driver's licence (3+ years driving experience)</li>
                <li>• Clean driving record</li>
                <li>• Ability to communicate clearly and professionally</li>
                <li>• Familiarity with city routes and traffic patterns</li>
            </ul>
        </div>

        <form class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-100">
            {{-- Hook this up to driver_applications later --}}
            <div class="mb-3">
                <label class="mb-1 block text-xs font-medium text-slate-700">Full name</label>
                <input type="text" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
            </div>
            <div class="mb-3">
                <label class="mb-1 block text-xs font-medium text-slate-700">Phone</label>
                <input type="text" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
            </div>
            <div class="mb-3">
                <label class="mb-1 block text-xs font-medium text-slate-700">Email (optional)</label>
                <input type="email" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
            </div>
            <div class="mb-3">
                <label class="mb-1 block text-xs font-medium text-slate-700">Years of experience</label>
                <input type="number" min="0" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
            </div>
            <button type="button" class="mt-2 w-full rounded-full bg-indigo-600 px-4 py-2 text-xs font-semibold text-white hover:bg-indigo-500">
                Submit application (wire later)
            </button>
        </form>
    </div>
</div>
@endsection

