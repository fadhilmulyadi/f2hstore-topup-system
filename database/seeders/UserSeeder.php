<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. AKUN ADMIN
        // Login pakai email ini untuk masuk Dashboard Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@f2h.com',
            'phone' => '081299998888', // Nomor Admin (Penting untuk testing WA)
            'password' => Hash::make('password'), // Passwordnya: password
            'role' => 'admin',
        ]);

        // 2. AKUN USER BIASA
        // Login pakai email ini untuk tes fitur Beli
        User::create([
            'name' => 'Pelanggan Setia',
            'email' => 'user@f2h.com',
            'phone' => '081233334444',
            'password' => Hash::make('password'), // Passwordnya: password
            'role' => 'user',
        ]);
    }
}