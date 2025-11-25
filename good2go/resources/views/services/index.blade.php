@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-6xl px-4 py-10">
    <h1 class="text-xl font-semibold tracking-tight text-slate-900">Our services</h1>
    <p class="mt-2 text-sm text-slate-600">
        Choose the option that fits your day. Whether you need a fully chauffeured car or just a trusted driver
        for your own vehicle, Good2Go has you covered.
    </p>

    <div class="mt-6 grid gap-6 md:grid-cols-2">
        @foreach($serviceTypes as $service)
            @php
                $imagePath = $service->slug === 'car-driver' 
                    ? asset('images/services/car-driver.png')
                    : asset('images/services/driver-only.png');
            @endphp
            <div class="group overflow-hidden rounded-2xl bg-white shadow-lg ring-1 ring-slate-200 transition-all hover:shadow-xl hover:ring-indigo-300">
                {{-- Image Section --}}
                <div class="relative h-48 overflow-hidden bg-gradient-to-br from-indigo-100 to-slate-100">
                    <img src="{{ $imagePath }}" 
                         alt="{{ $service->name }}"
                         class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    {{-- Fallback gradient if image not found --}}
                    <div class="hidden h-full w-full items-center justify-center bg-gradient-to-br from-indigo-500 to-indigo-600">
                        <div class="text-center text-white">
                            <svg class="mx-auto h-12 w-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-sm font-semibold">{{ $service->name }}</p>
                        </div>
                    </div>
                </div>
                
                {{-- Content Section --}}
                <div class="p-6">
                    <div class="mb-4">
                        <h2 class="text-lg font-bold text-slate-900">{{ $service->name }}</h2>
                        @if ($service->description)
                            <p class="mt-2 text-sm text-slate-600">{{ $service->description }}</p>
                        @endif
                        <ul class="mt-4 space-y-2 text-sm text-slate-600">
                            <li class="flex items-start">
                                <svg class="mr-2 h-5 w-5 flex-shrink-0 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Flexible hourly or daily hire</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="mr-2 h-5 w-5 flex-shrink-0 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Minimum 2-hour booking</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="mr-2 h-5 w-5 flex-shrink-0 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Pre-booked and confirmed online</span>
                            </li>
                        </ul>
                    </div>
                    
                    {{-- CTA Section --}}
                    <div class="mt-6 flex items-center justify-between border-t border-slate-100 pt-4">
                        <span class="text-sm font-medium text-slate-700">Starting from</span>
                        @auth
                            <a href="{{ route('bookings.create') }}"
                               class="rounded-full bg-indigo-600 px-5 py-2 text-sm font-semibold text-white transition-colors hover:bg-indigo-500">
                                Book now
                            </a>
                        @else
                            <a href="{{ route('register') }}"
                               class="rounded-full border-2 border-indigo-600 px-5 py-2 text-sm font-semibold text-indigo-600 transition-colors hover:bg-indigo-50">
                                Get started
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
