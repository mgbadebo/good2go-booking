<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? 'Good2Go' }}</title>

    {{-- Favicons --}}
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon-32x32.png') }}">

    {{-- Vite Assets - Safari compatible --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- Fallback CSS for Safari compatibility --}}
    @production
        @php
            try {
                $manifestPath = public_path('build/manifest.json');
                if (file_exists($manifestPath)) {
                    $manifest = json_decode(file_get_contents($manifestPath), true);
                    $cssFile = $manifest['resources/css/app.css']['file'] ?? null;
                    if ($cssFile) {
                        echo '<link rel="stylesheet" href="' . asset('build/' . $cssFile) . '">';
                    }
                }
            } catch (\Exception $e) {
                // Silently fail if manifest doesn't exist
            }
        @endphp
    @endproduction
</head>
<body class="min-h-screen bg-slate-50 text-slate-900 antialiased">
    <div class="flex flex-col min-h-screen">

        {{-- NAVBAR --}}
        <header class="border-b border-slate-200 bg-white/80 backdrop-blur sticky top-0 z-50" x-data="{ mobileMenuOpen: false }">
            <nav class="mx-auto flex max-w-6xl items-center justify-between px-4 py-3">
                {{-- Logo / Brand --}}
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    {{-- Logo image --}}
                    <img src="{{ asset('images/logo/logo.png') }}" 
                         alt="Good2Go" 
                         class="h-12 w-auto sm:h-16 md:h-20"
                         style="max-width: 80px; height: auto; object-fit: contain;"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    {{-- Fallback if image not found --}}
                    <span class="inline-flex h-12 w-12 sm:h-16 sm:w-16 md:h-20 md:w-20 items-center justify-center rounded-lg bg-indigo-600 text-xs font-bold text-white" style="display: none;">
                        G2G
                    </span>

                    {{-- Wordmark --}}
                    <div class="flex flex-col leading-tight">
                        <span class="text-sm font-semibold tracking-tight text-slate-900 sm:text-base">
                            Good2Go
                        </span>
                        <span class="text-[11px] text-slate-500 hidden sm:block">
                            Car + Driver • Driver Only
                        </span>
                    </div>
                </a>

                {{-- Desktop Nav --}}
                <div class="hidden items-center gap-6 md:flex text-sm">
                    <a href="{{ route('services.index') }}" class="hover:text-indigo-600">Services</a>
                    <a href="{{ route('pricing') }}" class="hover:text-indigo-600">Pricing</a>
                    <a href="{{ route('faqs') }}" class="hover:text-indigo-600">FAQs</a>
                    <a href="{{ route('contact') }}" class="hover:text-indigo-600">Contact</a>
                </div>

                {{-- Desktop Auth Buttons --}}
                <div class="hidden items-center gap-3 md:flex text-sm">
                    @auth
                        <a href="{{ route('bookings.index') }}" class="rounded-full border border-slate-200 px-3 py-1.5 text-xs font-medium hover:border-indigo-500 hover:text-indigo-600">
                            My Bookings
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="rounded-full bg-slate-900 px-3 py-1.5 text-xs font-semibold text-white hover:bg-slate-800">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-xs hover:text-indigo-600">Log in</a>
                        <a href="{{ route('register') }}" class="rounded-full bg-indigo-600 px-3 py-1.5 text-xs font-semibold text-white hover:bg-indigo-500">
                            Sign up
                        </a>
                    @endauth
                </div>

                {{-- Mobile menu button --}}
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 rounded-md text-slate-600 hover:text-slate-900 hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <svg x-show="!mobileMenuOpen" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg x-show="mobileMenuOpen" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </nav>

            {{-- Mobile Menu Dropdown --}}
            <div x-show="mobileMenuOpen" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-1"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-1"
                 class="md:hidden border-t border-slate-200 bg-white"
                 style="display: none;">
                <div class="px-4 py-3 space-y-1">
                    <a href="{{ route('services.index') }}" class="block px-3 py-2 rounded-md text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-indigo-600">Services</a>
                    <a href="{{ route('pricing') }}" class="block px-3 py-2 rounded-md text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-indigo-600">Pricing</a>
                    <a href="{{ route('faqs') }}" class="block px-3 py-2 rounded-md text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-indigo-600">FAQs</a>
                    <a href="{{ route('contact') }}" class="block px-3 py-2 rounded-md text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-indigo-600">Contact</a>
                    
                    <div class="border-t border-slate-200 pt-2 mt-2">
                        @auth
                            <a href="{{ route('bookings.index') }}" class="block px-3 py-2 rounded-md text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-indigo-600">My Bookings</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-3 py-2 rounded-md text-sm font-medium text-slate-700 hover:bg-slate-50">
                                    Logout
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-indigo-600">Log in</a>
                            <a href="{{ route('register') }}" class="block px-3 py-2 rounded-md text-sm font-medium bg-indigo-600 text-white hover:bg-indigo-500 text-center">Sign up</a>
                        @endauth
                    </div>
                </div>
            </div>
        </header>

        {{-- MAIN CONTENT --}}
        <main class="flex-1">
            {{ $slot ?? '' }}
            @yield('content')
        </main>

        {{-- FOOTER --}}
        <footer class="mt-10 border-t border-slate-200 bg-white">
            <div class="mx-auto flex max-w-6xl flex-col gap-3 px-4 py-6 text-xs text-slate-500 md:flex-row md:items-center md:justify-between">
                <p>&copy; {{ date('Y') }} Good2Go. All rights reserved.</p>
                <div class="flex flex-wrap gap-4">
                    <span>Safe. Reliable. Professional.</span>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
