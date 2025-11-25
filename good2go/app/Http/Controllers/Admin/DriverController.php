<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\DriverApplication;
use App\Models\User;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.drivers.index', compact('drivers'));
    }

    public function create()
    {
        $users = User::where('is_admin', false)->get();
        return view('admin.drivers.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'phone' => 'required|string|max:30',
            'email' => 'nullable|email|max:191',
            'license_number' => 'required|string|max:100',
            'vehicle_make' => 'nullable|string|max:100',
            'vehicle_model' => 'nullable|string|max:100',
            'vehicle_year' => 'nullable|integer',
            'vehicle_color' => 'nullable|string|max:50',
            'license_plate' => 'nullable|string|max:20',
            'status' => 'required|in:available,on_duty,off_duty,unavailable',
        ]);

        Driver::create([
            'user_id' => $request->user_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'license_number' => $request->license_number,
            'vehicle_make' => $request->vehicle_make,
            'vehicle_model' => $request->vehicle_model,
            'vehicle_year' => $request->vehicle_year,
            'vehicle_color' => $request->vehicle_color,
            'license_plate' => $request->license_plate,
            'status' => $request->status,
            'is_approved' => true,
            'approved_at' => now(),
        ]);

        return redirect()->route('admin.drivers.index')
            ->with('success', 'Driver created successfully.');
    }

    public function edit(Driver $driver)
    {
        $users = User::where('is_admin', false)->get();
        return view('admin.drivers.edit', compact('driver', 'users'));
    }

    public function update(Request $request, Driver $driver)
    {
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'phone' => 'required|string|max:30',
            'email' => 'nullable|email|max:191',
            'license_number' => 'required|string|max:100',
            'vehicle_make' => 'nullable|string|max:100',
            'vehicle_model' => 'nullable|string|max:100',
            'vehicle_year' => 'nullable|integer',
            'vehicle_color' => 'nullable|string|max:50',
            'license_plate' => 'nullable|string|max:20',
            'status' => 'required|in:available,on_duty,off_duty,unavailable',
            'is_approved' => 'boolean',
        ]);

        $driver->update([
            'user_id' => $request->user_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'license_number' => $request->license_number,
            'vehicle_make' => $request->vehicle_make,
            'vehicle_model' => $request->vehicle_model,
            'vehicle_year' => $request->vehicle_year,
            'vehicle_color' => $request->vehicle_color,
            'license_plate' => $request->license_plate,
            'status' => $request->status,
            'is_approved' => $request->has('is_approved'),
            'approved_at' => $request->has('is_approved') && !$driver->is_approved ? now() : $driver->approved_at,
        ]);

        return redirect()->route('admin.drivers.index')
            ->with('success', 'Driver updated successfully.');
    }

    public function destroy(Driver $driver)
    {
        if ($driver->bookings()->count() > 0) {
            return redirect()->back()
                ->with('error', 'Cannot delete driver with existing bookings.');
        }

        $driver->delete();
        return redirect()->route('admin.drivers.index')
            ->with('success', 'Driver deleted successfully.');
    }

    // Driver Applications
    public function applications()
    {
        $applications = DriverApplication::orderBy('created_at', 'desc')->get();
        return view('admin.drivers.applications', compact('applications'));
    }

    public function approveApplication(DriverApplication $application)
    {
        // Create driver from application
        $driver = Driver::create([
            'user_id' => $application->user_id,
            'first_name' => $application->first_name,
            'last_name' => $application->last_name,
            'phone' => $application->phone,
            'email' => $application->email,
            'status' => 'available',
            'is_approved' => true,
            'approved_at' => now(),
        ]);

        $application->update([
            'driver_id' => $driver->id,
            'status' => 'approved',
        ]);

        return redirect()->back()->with('success', 'Application approved and driver created.');
    }

    public function rejectApplication(Request $request, DriverApplication $application)
    {
        $request->validate([
            'notes' => 'nullable|string',
        ]);

        $application->update([
            'status' => 'rejected',
            'notes' => $request->notes,
        ]);

        return redirect()->back()->with('success', 'Application rejected.');
    }
}
