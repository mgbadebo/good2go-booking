@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-4xl px-4 py-10">
    <h1 class="text-xl font-semibold tracking-tight text-slate-900">Frequently Asked Questions</h1>
    <p class="mt-2 text-sm text-slate-600">
        If you don't find what you're looking for, just reach out using the contact page.
    </p>

    <div class="mt-6 divide-y divide-slate-100 rounded-2xl bg-white shadow-sm ring-1 ring-slate-100">
        @forelse($faqs as $faq)
            <div class="px-5 py-4 text-sm">
                <h2 class="font-semibold text-slate-900">{{ $faq->question }}</h2>
                <p class="mt-1 text-slate-600">{{ $faq->answer }}</p>
            </div>
        @empty
            <div class="px-5 py-4 text-sm text-slate-500">
                FAQs coming soon.
            </div>
        @endforelse
    </div>
</div>
@endsection

