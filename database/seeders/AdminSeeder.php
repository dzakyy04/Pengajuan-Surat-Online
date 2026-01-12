<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Admin::where('username', 'admin')->exists()) {
            return;
        }

        Admin::create([
            'username' => 'admin',
            'nama' => 'Administrator',
            'email' => 'admin@gmail.com',
            'no_hp' => '081234567890',
            'password' => Hash::make('Admin*2026'),
            'role' => 'admin',
        ]);

        Admin::create([
            'username' => 'kades',
            'nama' => 'Kepala Desa',
            'email' => 'kades@gmail.com',
            'no_hp' => '081298765432',
            'password' => Hash::make('Kades*2026'),
            'role' => 'kades',
        ]);
    }
}
