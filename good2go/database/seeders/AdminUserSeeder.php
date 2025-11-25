<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default admin user
        User::updateOrCreate(
            ['email' => 'admin@good2go.com'],
            [
                'name' => 'Admin User',
                'phone' => '+2348000000000',
                'password' => Hash::make('password'),
                'is_admin' => true,
                'status' => 'active',
                'phone_verified_at' => now(),
            ]
        );

        // Also create admin by phone if email is not set
        User::updateOrCreate(
            ['phone' => '+2348000000000'],
            [
                'name' => 'Admin User',
                'email' => 'admin@good2go.com',
                'password' => Hash::make('password'),
                'is_admin' => true,
                'status' => 'active',
                'phone_verified_at' => now(),
            ]
        );
    }
}
