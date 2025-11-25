<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PricingRule;
use App\Models\ServiceType;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    public function index()
    {
        $pricingRules = PricingRule::with('serviceType')
            ->orderBy('service_type_id')
            ->orderBy('hire_type')
            ->get();
        
        $serviceTypes = ServiceType::where('is_active', true)->get();
        
        return view('admin.pricing.index', compact('pricingRules', 'serviceTypes'));
    }

    public function create()
    {
        $serviceTypes = ServiceType::where('is_active', true)->get();
        return view('admin.pricing.create', compact('serviceTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_type_id' => 'required|exists:service_types,id',
            'hire_type' => 'required|in:hourly,daily',
            'currency' => 'required|string|size:3',
            'base_rate' => 'required|numeric|min:0',
            'min_hours' => 'nullable|integer|min:1',
            'daily_hours' => 'nullable|integer|min:1',
            'night_surcharge_type' => 'required|in:none,percent,flat',
            'night_surcharge_value' => 'required|numeric|min:0',
            'is_active' => 'boolean',
        ]);

        PricingRule::create([
            'service_type_id' => $request->service_type_id,
            'hire_type' => $request->hire_type,
            'currency' => $request->currency,
            'base_rate' => $request->base_rate,
            'min_hours' => $request->hire_type === 'hourly' ? $request->min_hours : null,
            'daily_hours' => $request->hire_type === 'daily' ? $request->daily_hours : null,
            'night_surcharge_type' => $request->night_surcharge_type,
            'night_surcharge_value' => $request->night_surcharge_value,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.pricing.index')
            ->with('success', 'Pricing rule created successfully.');
    }

    public function edit(PricingRule $pricing)
    {
        $serviceTypes = ServiceType::where('is_active', true)->get();
        return view('admin.pricing.edit', compact('pricing', 'serviceTypes'));
    }

    public function update(Request $request, PricingRule $pricing)
    {
        $request->validate([
            'service_type_id' => 'required|exists:service_types,id',
            'hire_type' => 'required|in:hourly,daily',
            'currency' => 'required|string|size:3',
            'base_rate' => 'required|numeric|min:0',
            'min_hours' => 'nullable|integer|min:1',
            'daily_hours' => 'nullable|integer|min:1',
            'night_surcharge_type' => 'required|in:none,percent,flat',
            'night_surcharge_value' => 'required|numeric|min:0',
            'is_active' => 'boolean',
        ]);

        $pricing->update([
            'service_type_id' => $request->service_type_id,
            'hire_type' => $request->hire_type,
            'currency' => $request->currency,
            'base_rate' => $request->base_rate,
            'min_hours' => $request->hire_type === 'hourly' ? $request->min_hours : null,
            'daily_hours' => $request->hire_type === 'daily' ? $request->daily_hours : null,
            'night_surcharge_type' => $request->night_surcharge_type,
            'night_surcharge_value' => $request->night_surcharge_value,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.pricing.index')
            ->with('success', 'Pricing rule updated successfully.');
    }

    public function destroy(PricingRule $pricing)
    {
        $pricing->delete();

        return redirect()->route('admin.pricing.index')
            ->with('success', 'Pricing rule deleted successfully.');
    }
}
