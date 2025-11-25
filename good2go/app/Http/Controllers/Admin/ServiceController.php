<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceType;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = ServiceType::orderBy('name')->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'slug' => 'required|string|max:100|unique:service_types,slug',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        ServiceType::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service type created successfully.');
    }

    public function edit(ServiceType $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, ServiceType $service)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'slug' => 'required|string|max:100|unique:service_types,slug,' . $service->id,
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $service->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service type updated successfully.');
    }

    public function destroy(ServiceType $service)
    {
        // Check if service has bookings
        if ($service->bookings()->count() > 0) {
            return redirect()->back()
                ->with('error', 'Cannot delete service type with existing bookings.');
        }

        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', 'Service type deleted successfully.');
    }
}
