<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 100; $i++) {
            User::create([
                'name' => "User $i",
                'age' => rand(18, 50),
                'pictures' => json_encode(["https://example.com/pic$i.jpg"]),
                'location' => "City $i",
                'email' => "user$i@example.com",
                'password' => Hash::make('password'),
            ]);
        }
    }
}