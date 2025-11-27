@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-4xl px-4 py-10">
    <h1 class="text-xl font-semibold tracking-tight text-slate-900">Contact us</h1>
    <p class="mt-2 text-sm text-slate-600">
        Have a question or want to make a special request? Send us a message and we'll get back to you.
    </p>

    {{-- Success Message Modal --}}
    @if(session('contact_success'))
    <div id="successModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" x-data="{ show: true }" x-show="show" x-transition>
        <div class="bg-white rounded-2xl p-6 max-w-md mx-4 shadow-xl" @click.away="show = false">
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100 mb-4">
                    <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-slate-900 mb-2">Thank you for your message!</h3>
                <p class="text-sm text-slate-600 mb-4">
                    We've received your message and will get back to you within 48 hours.
                </p>
                <p class="text-xs text-slate-500 mb-6">
                    If your inquiry is urgent, please call us directly at <a href="tel:+2348038464849" class="text-indigo-600 hover:underline">+234 803 846 4849</a> or use the WhatsApp button below.
                </p>
                <button @click="show = false" class="w-full rounded-full bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500">
                    Close
                </button>
            </div>
        </div>
    </div>
    @endif

    <div class="mt-6 grid gap-6 md:grid-cols-2">
        <form method="POST" action="{{ route('contact.store') }}" class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-100 space-y-4">
            @csrf
            <div class="space-y-1.5">
                <label for="name" class="text-xs font-semibold uppercase tracking-wide text-slate-600">Full name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                       class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm font-medium text-slate-900 placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/40 @error('name') border-red-300 @enderror" placeholder="Jane Doe">
                @error('name')
                    <p class="text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="space-y-1.5">
                <label for="email" class="text-xs font-semibold uppercase tracking-wide text-slate-600">Email address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                       class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm font-medium text-slate-900 placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/40 @error('email') border-red-300 @enderror" placeholder="name@email.com">
                @error('email')
                    <p class="text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="space-y-1.5">
                <label for="phone" class="text-xs font-semibold uppercase tracking-wide text-slate-600">Phone number</label>
                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required
                       class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm font-medium text-slate-900 placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/40 @error('phone') border-red-300 @enderror" placeholder="+234 803 846 4849">
                @error('phone')
                    <p class="text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="space-y-1.5">
                <label for="subject" class="text-xs font-semibold uppercase tracking-wide text-slate-600">Subject (optional)</label>
                <input type="text" id="subject" name="subject" value="{{ old('subject') }}"
                       class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm font-medium text-slate-900 placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/40 @error('subject') border-red-300 @enderror" placeholder="How can we help?">
                @error('subject')
                    <p class="text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="space-y-1.5">
                <label for="message" class="text-xs font-semibold uppercase tracking-wide text-slate-600">Message</label>
                <textarea id="message" name="message" rows="4" required
                          class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm font-medium text-slate-900 placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/40 @error('message') border-red-300 @enderror" placeholder="Tell us more...">{{ old('message') }}</textarea>
                @error('message')
                    <p class="text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="w-full rounded-2xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-600/20 transition hover:bg-indigo-500">
                Send message
            </button>
        </form>

        <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-100">
            <h2 class="text-sm font-semibold text-slate-900">Other ways to reach us</h2>
            <ul class="mt-3 space-y-3 text-sm text-slate-600">
                <li>
                    <span class="font-medium">Phone:</span>
                    <a href="tel:+2348038464849" class="text-indigo-600 hover:underline ml-1">+234 803 846 4849</a>
                </li>
                <li>
                    <span class="font-medium">Email:</span>
                    <a href="mailto:info@good2go.ng" class="text-indigo-600 hover:underline ml-1">info@good2go.ng</a>
                </li>
                <li>
                    <span class="font-medium">WhatsApp:</span>
                    <a href="https://wa.me/2348038464849" 
                       target="_blank" 
                       rel="noopener noreferrer"
                       class="inline-flex items-center gap-1 ml-1 text-indigo-600 hover:underline">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                        </svg>
                        Click to chat
                    </a>
                </li>
                <li><span class="font-medium">Hours:</span> 06:00 – 22:00, 7 days a week</li>
            </ul>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Auto-hide success modal after 10 seconds
    document.addEventListener('DOMContentLoaded', function() {
        @if(session('contact_success'))
        setTimeout(function() {
            const modal = document.getElementById('successModal');
            if (modal) {
                modal.style.display = 'none';
            }
        }, 10000);
        @endif
    });
</script>
@endpush
@endsection

