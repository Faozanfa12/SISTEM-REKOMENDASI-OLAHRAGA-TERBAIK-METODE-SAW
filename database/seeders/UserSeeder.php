<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Sistem',
            'email' => 'admin@gmail.com', // Ganti dengan email Anda
            'password' => Hash::make('password123'), // GANTI DENGAN PASSWORD AMAN
        ]);
    }
}