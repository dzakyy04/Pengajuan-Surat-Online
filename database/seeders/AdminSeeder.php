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
            'password' => Hash::make('admin123'),
        ]);
    }
}
