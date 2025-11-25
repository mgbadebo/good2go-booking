@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-6xl px-4 py-10">
    <h1 class="text-xl font-semibold tracking-tight text-slate-900">Pricing</h1>
    <p class="mt-2 text-sm text-slate-600">
        Transparent, simple pricing. Adjust actual amounts later in your admin settings.
        All bookings are subject to a minimum 2-hour charge for hourly hire.
    </p>

    <div class="mt-8 grid gap-6 md:grid-cols-2">
        {{-- Car + Driver Card --}}
        <div class="group relative flex flex-col overflow-hidden rounded-3xl bg-gradient-to-br from-indigo-50 via-white to-indigo-50/50 p-6 shadow-lg ring-1 ring-indigo-100/50 transition-all hover:shadow-xl hover:ring-indigo-200 sm:p-8">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 h-24 w-24 rounded-full bg-indigo-200/20 blur-2xl"></div>
            <div class="relative flex flex-1 flex-col">
                <div class="mb-4 flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-600 text-white shadow-md">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-slate-900">Car + Driver</h2>
                        <p class="text-xs text-slate-600">Premium chauffeured service</p>
                    </div>
                </div>
                <p class="mb-6 min-h-[3rem] text-sm leading-relaxed text-slate-700">For when you need a clean, insured car and a professional driver.</p>
                
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div class="flex min-h-[140px] flex-col rounded-xl bg-white/60 p-4 backdrop-blur-sm ring-1 ring-indigo-100/50">
                        <div class="mb-2 h-5">
                            <span class="text-xs font-medium uppercase tracking-wide text-slate-500">Hourly hire</span>
                        </div>
                        <p class="mt-2 text-2xl font-bold text-slate-900">NGN XX,000</p>
                        <p class="mt-1 text-xs text-slate-500">per hour • Min. 2 hours</p>
                    </div>
                    
                    <div class="flex min-h-[140px] flex-col rounded-xl bg-white/60 p-4 backdrop-blur-sm ring-1 ring-indigo-100/50">
                        <div class="mb-2 flex h-5 items-center justify-between">
                            <span class="text-xs font-medium uppercase tracking-wide text-slate-500">Daily hire</span>
                            <span class="rounded-full bg-indigo-100 px-2 py-0.5 text-[10px] font-semibold text-indigo-700">Popular</span>
                        </div>
                        <p class="mt-2 text-2xl font-bold text-slate-900">NGN XX,000</p>
                        <p class="mt-1 text-xs text-slate-500">per day • Up to 10 hours</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Driver Only Card --}}
        <div class="group relative flex flex-col overflow-hidden rounded-3xl bg-gradient-to-br from-slate-50 via-white to-slate-50/50 p-6 shadow-lg ring-1 ring-slate-200/50 transition-all hover:shadow-xl hover:ring-slate-300 sm:p-8">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 h-24 w-24 rounded-full bg-slate-200/20 blur-2xl"></div>
            <div class="relative flex flex-1 flex-col">
                <div class="mb-4 flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-600 text-white shadow-md">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-slate-900">Driver Only</h2>
                        <p class="text-xs text-slate-600">Your car, our expertise</p>
                    </div>
                </div>
                <p class="mb-6 min-h-[3rem] text-sm leading-relaxed text-slate-700">Use your own car, with a vetted professional driver.</p>
                
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div class="flex min-h-[140px] flex-col rounded-xl bg-white/60 p-4 backdrop-blur-sm ring-1 ring-slate-200/50">
                        <div class="mb-2 h-5">
                            <span class="text-xs font-medium uppercase tracking-wide text-slate-500">Hourly hire</span>
                        </div>
                        <p class="mt-2 text-2xl font-bold text-slate-900">NGN XX,000</p>
                        <p class="mt-1 text-xs text-slate-500">per hour • Min. 2 hours</p>
                    </div>
                    
                    <div class="flex min-h-[140px] flex-col rounded-xl bg-white/60 p-4 backdrop-blur-sm ring-1 ring-slate-200/50">
                        <div class="mb-2 flex h-5 items-center justify-between">
                            <span class="text-xs font-medium uppercase tracking-wide text-slate-500">Daily hire</span>
                            <span class="rounded-full bg-slate-100 px-2 py-0.5 text-[10px] font-semibold text-slate-700">Popular</span>
                        </div>
                        <p class="mt-2 text-2xl font-bold text-slate-900">NGN XX,000</p>
                        <p class="mt-1 text-xs text-slate-500">per day • Ideal for busy days</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <p class="mt-6 text-xs text-slate-500">
        Note: Actual pricing will depend on city, time of day, and special requirements.
        This page can later be driven directly from your pricing rules in the admin panel.
    </p>
</div>
@endsection

