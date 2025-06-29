<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin Comic',
            'email' => 'admin@comic.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

        // User Biasa
        User::create([
            'name' => 'User Biasa',
            'email' => 'user@comic.com',
            'password' => Hash::make('password'),
            'role' => 'user'
        ]);
    }
}
