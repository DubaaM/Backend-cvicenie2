<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'first_name' => 'Adam',
                'last_name' => 'Novak',
                'email' => 'adam@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'premium_until' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Beata',
                'last_name' => 'Kovacova',
                'email' => 'beata@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'premium_until' => now()->addMonths(3),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Cyril',
                'last_name' => 'Toth',
                'email' => 'cyril@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'premium_until' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Dominika',
                'last_name' => 'Horvatova',
                'email' => 'dominika@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'premium_until' => now()->addMonths(1),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Erik',
                'last_name' => 'Kral',
                'email' => 'erik@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'premium_until' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
