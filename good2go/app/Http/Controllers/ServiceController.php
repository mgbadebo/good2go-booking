<?php

namespace App\Http\Controllers;

use App\Models\ServiceType;

class ServiceController extends Controller
{
    public function index()
    {
        $serviceTypes = ServiceType::where('is_active', true)
            ->with(['pricingRules' => function ($query) {
                $query->where('is_active', true);
            }])
            ->orderBy('name')
            ->get();

        return view('services.index', compact('serviceTypes'));
    }
}
