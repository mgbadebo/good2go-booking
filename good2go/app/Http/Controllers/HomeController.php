<?php

namespace App\Http\Controllers;

use App\Models\ServiceType;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $serviceTypes = ServiceType::where('is_active', true)->take(2)->get();
        $testimonials = Testimonial::where('is_active', true)->orderBy('id', 'desc')->take(3)->get();

        return view('home.index', compact('serviceTypes', 'testimonials'));
    }
}
