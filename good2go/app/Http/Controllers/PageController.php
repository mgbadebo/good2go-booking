<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        return view('pages.about');
    }

    public function pricing()
    {
        return view('pages.pricing');
    }

    public function faqs()
    {
        $faqs = Faq::where('is_active', true)->orderBy('sort_order')->get();

        return view('pages.faqs', compact('faqs'));
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function driverRecruitment()
    {
        return view('pages.driver-recruitment');
    }
}
