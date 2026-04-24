<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Super Admin
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@prosoundmedia.com',
            'password' => Hash::make('password'),
            'phone' => '+234 800 000 0001',
            'company' => 'Pro-Sound Media',
            'bio' => 'System administrator',
            'email_verified_at' => now(),
        ]);
        $superAdmin->assignRole('super_admin');

        // Admin
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@prosoundmedia.com',
            'password' => Hash::make('password'),
            'phone' => '+234 800 000 0002',
            'company' => 'Pro-Sound Media',
            'bio' => 'Content and operations manager',
            'email_verified_at' => now(),
        ]);
        $admin->assignRole('admin');

        // Staff
        $staff = User::create([
            'name' => 'John Engineer',
            'email' => 'staff@prosoundmedia.com',
            'password' => Hash::make('password'),
            'phone' => '+234 800 000 0003',
            'bio' => 'Audio engineer and producer',
            'email_verified_at' => now(),
        ]);
        $staff->assignRole('staff');

        // Clients
        $clients = [
            ['name' => 'Adebayo Ogunlade', 'email' => 'adebayo@example.com', 'company' => 'Afrobeats Records'],
            ['name' => 'Chioma Nwosu', 'email' => 'chioma@example.com', 'company' => 'Gospel Grace Ministry'],
            ['name' => 'Emeka Obi', 'email' => 'emeka@example.com', 'company' => 'Obi Productions'],
        ];

        foreach ($clients as $clientData) {
            $client = User::create([
                'name' => $clientData['name'],
                'email' => $clientData['email'],
                'password' => Hash::make('password'),
                'company' => $clientData['company'],
                'email_verified_at' => now(),
            ]);
            $client->assignRole('client');
        }
    }
}
