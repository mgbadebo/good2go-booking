<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AvailabilityRule;
use App\Models\BlackoutDate;
use App\Models\ServiceType;
use Illuminate\Http\Request;

class AvailabilityController extends Controller
{
    public function index()
    {
        // Working hours (availability rules)
        $availabilityRules = AvailabilityRule::orderBy('day_of_week')
            ->orderBy('start_time')
            ->get();
        
        // Blackout dates
        $blackoutDates = BlackoutDate::with('serviceType')
            ->orderBy('start_date')
            ->get();
        
        $serviceTypes = ServiceType::where('is_active', true)->get();
        
        return view('admin.availability.index', compact('availabilityRules', 'blackoutDates', 'serviceTypes'));
    }

    public function storeWorkingHours(Request $request)
    {
        $request->validate([
            'day_of_week' => 'required|integer|between:0,6', // 0 = Sunday, 6 = Saturday
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'is_available' => 'boolean',
        ]);

        AvailabilityRule::create([
            'driver_id' => null, // Global rule
            'rule_type' => 'weekly',
            'day_of_week' => $request->day_of_week,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'is_available' => $request->has('is_available'),
        ]);

        return redirect()->back()->with('success', 'Working hours added successfully.');
    }

    public function destroyWorkingHours(AvailabilityRule $rule)
    {
        $rule->delete();
        return redirect()->back()->with('success', 'Working hours removed successfully.');
    }

    public function storeBlackoutDate(Request $request)
    {
        $request->validate([
            'service_type_id' => 'nullable|exists:service_types,id',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'reason' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        BlackoutDate::create([
            'service_type_id' => $request->service_type_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date ?? $request->start_date,
            'reason' => $request->reason,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->back()->with('success', 'Blackout date added successfully.');
    }

    public function destroyBlackoutDate(BlackoutDate $blackoutDate)
    {
        $blackoutDate->delete();
        return redirect()->back()->with('success', 'Blackout date removed successfully.');
    }
}
