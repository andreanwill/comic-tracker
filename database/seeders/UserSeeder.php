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
        User::create([
            'name' => 'Admin Kedua',
            'email' => 'admin2@comic.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

        // User Biasa
        User::create([
            'name' => 'User Satu',
            'email' => 'user1@comic.com',
            'password' => Hash::make('password'),
            'role' => 'user'
        ]);
        User::create([
            'name' => 'User Dua',
            'email' => 'user2@comic.com',
            'password' => Hash::make('password'),
            'role' => 'user'
        ]);
        User::create([
            'name' => 'User Tiga',
            'email' => 'user3@comic.com',
            'password' => Hash::make('password'),
            'role' => 'user'
        ]);
        User::create([
            'name' => 'User Empat',
            'email' => 'user4@comic.com',
            'password' => Hash::make('password'),
            'role' => 'user'
        ]);
        User::create([
            'name' => 'User Lima',
            'email' => 'user5@comic.com',
            'password' => Hash::make('password'),
            'role' => 'user'
        ]);
    }
}
