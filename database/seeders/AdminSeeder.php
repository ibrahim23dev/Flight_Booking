<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $user= User::create([
            'name' => 'User',
            'email' => 'user@laravel.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$jA7fWijeQNu06fKSUDDXLe4KdvzSFj5haPNLN9l8sftLLQyg/Z1eG', // password 12345678
           
        ]);
        $user->assignRole('user');
    }
}
