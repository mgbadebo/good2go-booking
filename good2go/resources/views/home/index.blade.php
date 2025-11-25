@extends('layouts.app')

@section('content')
<section class="bg-gradient-to-b from-indigo-50 via-white to-slate-50 relative overflow-hidden">
    <div class="mx-auto flex max-w-6xl flex-col gap-6 px-4 py-8 sm:gap-8 sm:py-12 md:flex-row md:items-start md:gap-10">
        <div class="md:w-1/2 z-10">
            <p class="text-xs uppercase tracking-[0.2em] text-indigo-600 font-semibold sm:text-sm">Chauffeur & Driver Service</p>
            <h1 class="mt-3 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl md:text-4xl">
                Safe, professional drivers<br class="hidden sm:block"> for every journey.
            </h1>
            <p class="mt-4 text-sm leading-relaxed text-slate-700 sm:text-base">
                Good2Go offers premium car-and-driver and driver-only services designed for busy professionals, families, and everyday travellers who value safety, convenience, and reliability. Whether you need a chauffeured ride for an important meeting, help with school runs, or simply want a trusted driver behind the wheel of your own car, we make the process effortless. Book online in minutes, get matched with a fully vetted and verified driver, and enjoy every journey with total peace of mind and comfort.
            </p>
            <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:gap-3">
                <a href="{{ route('bookings.create') }}"
                   class="inline-flex items-center justify-center rounded-full bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 active:bg-indigo-700 touch-manipulation">
                    Book a driver
                </a>
                <a href="{{ route('services.index') }}"
                   class="inline-flex items-center justify-center rounded-full border-2 border-slate-300 px-6 py-3 text-sm font-semibold text-slate-700 hover:border-slate-400 hover:bg-slate-50 active:bg-slate-100 touch-manipulation">
                    View services
                </a>
            </div>
            <p class="mt-4 text-xs text-slate-600 sm:text-[11px]">
                Minimum 2-hour hire • Flexible daily packages • SMS-verified customers.
            </p>
        </div>

        <div class="md:w-1/2 mt-6 relative z-10 space-y-6">
            {{-- Hero Image --}}
            <div class="rounded-2xl overflow-hidden shadow-xl ring-1 ring-slate-200 sm:rounded-3xl">
                <img src="{{ asset('images/hero/hero-image.png') }}" 
                     alt="Professional chauffeur service"
                     class="w-full h-auto object-cover"
                     onerror="this.style.display='none';">
            </div>
            
            {{-- Why choose Good2Go? Section --}}
            <div class="rounded-2xl bg-white p-4 shadow-lg ring-1 ring-slate-200 sm:rounded-3xl sm:p-5">
                <h2 class="text-base font-semibold tracking-tight text-slate-900 sm:text-lg">Why choose Good2Go?</h2>
                <p class="mt-2 text-xs leading-relaxed text-slate-600 sm:text-sm">
                    We combine professional drivers, flexible hiring options, and simple online booking
                    to make every trip safe, comfortable, and stress-free.
                </p>
                <div class="mt-4 grid grid-cols-1 gap-3 text-xs sm:gap-4">
                    <div class="rounded-xl bg-slate-50 p-3 ring-1 ring-slate-100 sm:rounded-2xl">
                        <h3 class="text-xs font-semibold text-slate-900 sm:text-sm">Safety first</h3>
                        <p class="mt-1 text-xs leading-relaxed text-slate-600">Verified drivers, responsible driving, and a clear commitment to your safety.</p>
                    </div>
                    <div class="rounded-xl bg-slate-50 p-3 ring-1 ring-slate-100 sm:rounded-2xl">
                        <h3 class="text-xs font-semibold text-slate-900 sm:text-sm">Reliable & on time</h3>
                        <p class="mt-1 text-xs leading-relaxed text-slate-600">We respect your schedule. Punctual pickups and predictable service.</p>
                    </div>
                    <div class="rounded-xl bg-slate-50 p-3 ring-1 ring-slate-100 sm:rounded-2xl">
                        <h3 class="text-xs font-semibold text-slate-900 sm:text-sm">Flexible packages</h3>
                        <p class="mt-1 text-xs leading-relaxed text-slate-600">Hourly or daily hire, with a simple minimum 2-hour charge.</p>
                    </div>
                </div>
            </div>
            
            {{-- Quick Snapshot --}}
            <div class="rounded-2xl bg-white p-4 shadow-lg ring-1 ring-slate-200 sm:rounded-3xl sm:p-5">
                <p class="text-xs font-medium uppercase tracking-[0.2em] text-indigo-600 mb-3 sm:text-sm">
                    Quick snapshot
                </p>
                <dl class="grid grid-cols-1 gap-3 text-xs sm:grid-cols-2 sm:gap-4">
                    <div class="rounded-xl bg-indigo-50 p-3 ring-1 ring-indigo-100 sm:rounded-2xl sm:p-4">
                        <dt class="text-indigo-700 font-semibold text-sm">Car + Driver</dt>
                        <dd class="mt-2 text-xl font-bold text-slate-900 sm:text-2xl">Executive rides</dd>
                        <p class="mt-1 text-xs text-slate-600 sm:text-[11px]">Clean, insured vehicles with professional drivers.</p>
                    </div>
                    <div class="rounded-xl bg-indigo-50 p-3 ring-1 ring-indigo-100 sm:rounded-2xl sm:p-4">
                        <dt class="text-indigo-700 font-semibold text-sm">Driver Only</dt>
                        <dd class="mt-2 text-xl font-bold text-slate-900 sm:text-2xl">Your car, our driver</dd>
                        <p class="mt-1 text-xs text-slate-600 sm:text-[11px]">We drive, you relax in your own vehicle.</p>
                    </div>
                    <div class="rounded-xl bg-indigo-50 p-3 ring-1 ring-indigo-100 sm:rounded-2xl sm:p-4">
                        <dt class="text-indigo-700 font-semibold text-sm">Flexible hire</dt>
                        <dd class="mt-2 text-xl font-bold text-slate-900 sm:text-2xl">Hourly / Daily</dd>
                        <p class="mt-1 text-xs text-slate-600 sm:text-[11px]">Minimum 2-hour hire, full-day options available.</p>
                    </div>
                    <div class="rounded-xl bg-indigo-50 p-3 ring-1 ring-indigo-100 sm:rounded-2xl sm:p-4">
                        <dt class="text-indigo-700 font-semibold text-sm">Peace of mind</dt>
                        <dd class="mt-2 text-xl font-bold text-slate-900 sm:text-2xl">Vetted drivers</dd>
                        <p class="mt-1 text-xs text-slate-600 sm:text-[11px]">Professionally screened and trained.</p>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</section>
@endsection
