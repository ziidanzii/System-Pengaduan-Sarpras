<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nama_pengguna' => 'Admin Utama',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'nama_pengguna' => 'Petugas Sistem',
            'username' => 'petugas',
            'email' => 'petugas@example.com',
            'password' => Hash::make('password'),
            'role' => 'petugas',
        ]);

        User::create([
            'nama_pengguna' => 'Pengguna Biasa',
            'username' => 'pengguna',
            'email' => 'pengguna@example.com',
            'password' => Hash::make('password'),
            'role' => 'pengguna',
        ]);
    }
}
