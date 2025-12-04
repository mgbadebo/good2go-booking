@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-4xl px-4 py-10">
    <div class="text-center mb-10">
        <h1 class="text-3xl font-bold tracking-tight text-slate-900 mb-3">Frequently Asked Questions</h1>
        <p class="text-slate-600">
            Find answers to common questions about our services, booking process, and more.
        </p>
    </div>

    <div class="space-y-4" x-data="{ openId: null }">
        @php
            $faqs = [
                [
                    'question' => 'What services does Good2Go offer?',
                    'answer' => 'Good2Go provides two primary services:

• Car + Driver: We supply a professional vehicle and chauffeur for your trips.

• Driver-Only: A licensed, verified driver operates your personal vehicle on an hourly or daily basis.

Both options are available for personal use, business travel, errands, family movement, airport runs, events, and more.'
                ],
                [
                    'question' => 'How do I make a booking?',
                    'answer' => 'You can book directly through our website by:

1. Creating an account
2. Completing phone verification via SMS
3. Selecting your preferred service
4. Checking driver availability
5. Making payment to secure your booking

You will receive email and WhatsApp confirmations immediately after booking.'
                ],
                [
                    'question' => 'Is there a minimum booking duration?',
                    'answer' => 'Yes. All bookings are subject to a minimum charge of 2 hours, whether you choose Car + Driver or Driver-Only services.'
                ],
                [
                    'question' => 'How is pricing calculated?',
                    'answer' => 'Pricing is based on:

• Your chosen service type
• The number of hours or days
• Pickup location
• Additional requests (e.g., waiting time, extra stops)

The website automatically calculates your fee before checkout.'
                ],
                [
                    'question' => 'Do I need to create an account to book a driver?',
                    'answer' => 'Yes. Creating an account allows us to:

• Verify your identity
• Provide accurate updates and notifications
• Securely store your booking history
• Enable fast re-booking in the future

Account verification is done via SMS using Termii.'
                ],
                [
                    'question' => 'How do I pay for a booking?',
                    'answer' => 'Good2Go supports two payment methods:

• Direct bank transfer (details provided during checkout)
• Online card or bank payment via Paystack

Your booking is not confirmed until payment is received.'
                ],
                [
                    'question' => 'Can I modify or cancel a booking?',
                    'answer' => 'Yes. You can:

• Modify dates/times (subject to driver availability)
• Cancel a booking from your dashboard

Cancellation charges may apply depending on how close the trip is to your scheduled time.'
                ],
                [
                    'question' => 'Are your drivers verified?',
                    'answer' => 'Absolutely. Every Good2Go driver is:

• Professionally trained
• Background-checked
• Licensed and safety-approved
• Rated by customers for accountability

Your safety is our top priority.'
                ],
                [
                    'question' => 'What type of vehicles are available? (Car + Driver service)',
                    'answer' => 'Our fleet includes premium sedans, SUVs, and executive vehicles suitable for:

• Corporate travel
• Airport transfers
• VIP movement
• Family outings
• Event transportation

You will see available cars during booking.'
                ],
                [
                    'question' => 'Can I request a driver for multiple days?',
                    'answer' => 'Yes. You may book a driver for:

• A single day
• Several consecutive days
• Long-term monthly arrangements

Discounts may apply for long-term bookings.'
                ],
                [
                    'question' => 'What if my driver arrives late?',
                    'answer' => 'This is rare, but if it occurs, our operations team will notify you immediately and assign a replacement driver if necessary.'
                ],
                [
                    'question' => 'How do I contact support?',
                    'answer' => 'You can reach us via:

• Website contact form
• WhatsApp
• Email

Our support team is available daily to assist you with bookings, changes, or driver issues.'
                ],
                [
                    'question' => 'Is WhatsApp notification available?',
                    'answer' => 'Yes. Once enabled, you will receive:

• Booking confirmations
• Driver assignment updates
• Trip reminders
• Important alerts

This optional feature can be activated from your dashboard.'
                ],
                [
                    'question' => 'Do drivers follow COVID-19 and hygiene protocols?',
                    'answer' => 'Yes. All drivers are trained in:

• Vehicle sanitation
• Personal hygiene standards
• Safe driving practices

Your comfort and safety are guaranteed.'
                ],
                [
                    'question' => 'What happens if I exceed my booked time?',
                    'answer' => 'Excess hourly charges will apply. These charges will be calculated automatically and added to your final bill.'
                ],
                [
                    'question' => 'Can I choose a preferred driver?',
                    'answer' => 'Yes. Returning customers can request their favourite drivers, subject to availability.'
                ],
            ];
        @endphp

        @foreach($faqs as $index => $faq)
            <div class="rounded-2xl bg-white shadow-sm ring-1 ring-slate-200 overflow-hidden transition-all duration-200 hover:shadow-md">
                <button 
                    @click="openId = openId === {{ $index }} ? null : {{ $index }}"
                    class="w-full px-6 py-5 text-left flex items-center justify-between focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-inset transition-colors"
                    :class="openId === {{ $index }} ? 'bg-indigo-50' : 'hover:bg-slate-50'">
                    <h3 class="text-base font-semibold text-slate-900 pr-4">{{ $faq['question'] }}</h3>
                    <svg 
                        class="flex-shrink-0 w-5 h-5 text-indigo-600 transition-transform duration-200"
                        :class="openId === {{ $index }} ? 'rotate-180' : ''"
                        fill="none" 
                        viewBox="0 0 24 24" 
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div 
                    x-show="openId === {{ $index }}"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 transform -translate-y-2"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform -translate-y-2"
                    x-cloak
                    class="px-6 pb-5">
                    <div class="text-sm text-slate-600 leading-relaxed whitespace-pre-line">
                        {{ $faq['answer'] }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-10 text-center">
        <p class="text-sm text-slate-600 mb-4">
            Still have questions? We're here to help!
        </p>
        <a href="{{ route('contact') }}" class="inline-flex items-center px-6 py-3 rounded-xl bg-indigo-600 text-white font-semibold text-sm hover:bg-indigo-500 transition-colors shadow-lg shadow-indigo-600/20">
            Contact Us
        </a>
    </div>
</div>

@endsection
