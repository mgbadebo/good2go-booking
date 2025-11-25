<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PricingRulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carDriver = \App\Models\ServiceType::where('slug', 'car-driver')->first();
        $driverOnly = \App\Models\ServiceType::where('slug', 'driver-only')->first();

        if (! $carDriver || ! $driverOnly) {
            return;
        }

        \App\Models\PricingRule::insert([
            // Car + Driver hourly
            [
                'service_type_id' => $carDriver->id,
                'hire_type' => 'hourly',
                'currency' => 'NGN',
                'base_rate' => 10000,   // example: ₦10,000/hour
                'min_hours' => 2,
                'daily_hours' => null,
                'night_surcharge_type' => 'none',
                'night_surcharge_value' => 0,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Car + Driver daily
            [
                'service_type_id' => $carDriver->id,
                'hire_type' => 'daily',
                'currency' => 'NGN',
                'base_rate' => 70000,   // example daily rate
                'min_hours' => null,
                'daily_hours' => 10,
                'night_surcharge_type' => 'none',
                'night_surcharge_value' => 0,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Driver Only hourly
            [
                'service_type_id' => $driverOnly->id,
                'hire_type' => 'hourly',
                'currency' => 'NGN',
                'base_rate' => 6000,
                'min_hours' => 2,
                'daily_hours' => null,
                'night_surcharge_type' => 'none',
                'night_surcharge_value' => 0,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Driver Only daily
            [
                'service_type_id' => $driverOnly->id,
                'hire_type' => 'daily',
                'currency' => 'NGN',
                'base_rate' => 45000,
                'min_hours' => null,
                'daily_hours' => 10,
                'night_surcharge_type' => 'none',
                'night_surcharge_value' => 0,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
