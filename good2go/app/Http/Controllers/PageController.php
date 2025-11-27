<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\ServiceType;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        return view('pages.about');
    }

    public function pricing()
    {
        $serviceTypes = ServiceType::where('is_active', true)
            ->with(['pricingRules' => function ($query) {
                $query->where('is_active', true);
            }])
            ->orderBy('name')
            ->get();

        return view('pages.pricing', compact('serviceTypes'));
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
