<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Dewa Sheva Dzaky',
                'email' => 'admin1@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('Password123@'),
                'role' => 'admin',
                'remember_token' => Str::random(10),
            ],
            [
                'name' => 'Admin Detik',
                'email' => 'admin2@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('Password123@'),
                'role' => 'admin',
                'remember_token' => Str::random(10),
            ],
            [
                'name' => 'Lionel Messi',
                'email' => 'messi@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('Password123@'),
                'role' => 'user',
                'remember_token' => Str::random(10),
            ]
        ];

        User::insert($users);
    }
}
