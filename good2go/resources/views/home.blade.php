@extends('layouts.app')

@section('content')
<div class="container">
    <div class="py-5">
        <h1>Welcome to Good2Go</h1>
        <p class="lead">Professional driver services at your fingertips.</p>
        
        <div class="mt-4">
            <a href="{{ route('services.index') }}" class="btn btn-primary me-2">View Services</a>
            <a href="{{ route('bookings.create') }}" class="btn btn-outline-primary">Book Now</a>
        </div>
    </div>
</div>
@endsection

