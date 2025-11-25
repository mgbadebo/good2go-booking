<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel - {{ config('app.name', 'Good2Go') }}</title>

    {{-- Favicons --}}
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon-32x32.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r border-slate-200 flex flex-col">
            <div class="p-4 border-b border-slate-200">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center">
                    <img src="{{ asset('images/logo/logo.png') }}" 
                         alt="Good2Go Admin" 
                         class="h-10 w-auto"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                    <h1 class="text-lg font-bold text-indigo-600" style="display: none;">Good2Go Admin</h1>
                </a>
            </div>
            <nav class="flex-1 overflow-y-auto p-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-700 hover:bg-slate-100' }}">
                    Dashboard
                </a>
                <a href="{{ route('admin.bookings.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.bookings.*') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-700 hover:bg-slate-100' }}">
                    Bookings
                </a>
                <a href="{{ route('admin.services.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.services.*') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-700 hover:bg-slate-100' }}">
                    Services
                </a>
                <a href="{{ route('admin.pricing.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.pricing.*') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-700 hover:bg-slate-100' }}">
                    Pricing
                </a>
                <a href="{{ route('admin.availability.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.availability.*') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-700 hover:bg-slate-100' }}">
                    Availability
                </a>
                <a href="{{ route('admin.drivers.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.drivers.*') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-700 hover:bg-slate-100' }}">
                    Drivers
                </a>
                <a href="{{ route('admin.content.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.content.*') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-700 hover:bg-slate-100' }}">
                    Content
                </a>
                <a href="{{ route('admin.users.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.users.*') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-700 hover:bg-slate-100' }}">
                    Users
                </a>
            </nav>
            <div class="p-4 border-t border-slate-200">
                <div class="text-xs text-slate-500 mb-2">{{ auth()->user()->name }}</div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-3 py-2 rounded-lg text-sm text-slate-700 hover:bg-slate-100">
                        Logout
                    </button>
                </form>
                <a href="{{ route('home') }}" class="block mt-2 px-3 py-2 rounded-lg text-sm text-slate-700 hover:bg-slate-100">
                    View Site
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto">
            <div class="p-6">
                @if (session('success'))
                    <div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-4 rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-800">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>

