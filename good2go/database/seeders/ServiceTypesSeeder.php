<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\ServiceType::insert([
            [
                'name' => 'Car + Driver',
                'slug' => 'car-driver',
                'description' => 'Chauffeured car with professional driver.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Driver Only',
                'slug' => 'driver-only',
                'description' => 'Professional driver for your own vehicle.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
