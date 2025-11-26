<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Good2Go') }}</title>

        {{-- Favicons --}}
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
        <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon-32x32.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 px-4">
            <div class="mb-6 sm:mb-8">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    {{-- Logo image --}}
                    <img src="{{ asset('images/logo/logo.png') }}" 
                         alt="Good2Go" 
                         class="h-16 w-auto sm:h-20"
                         style="max-width: 80px; height: auto; object-fit: contain;"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    {{-- Fallback if image not found --}}
                    <span class="inline-flex h-16 w-16 sm:h-20 sm:w-20 items-center justify-center rounded-lg bg-indigo-600 text-xs font-bold text-white" style="display: none;">
                        G2G
                    </span>
                    {{-- Wordmark --}}
                    <div class="flex flex-col leading-tight">
                        <span class="text-lg font-semibold tracking-tight text-slate-900 sm:text-xl">
                            Good2Go
                        </span>
                        <span class="text-xs text-slate-500 hidden sm:block">
                            Car + Driver • Driver Only
                        </span>
                    </div>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-4 sm:px-6 py-6 sm:py-8 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
