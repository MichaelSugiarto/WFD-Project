<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'id' => Str::uuid(),
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => Hash::make('password123'),
                'telephone_number' => '081234567890',
                'address' => 'Jl. Merdeka No. 1',
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'password' => Hash::make('password123'),
                'telephone_number' => '081298765432',
                'address' => 'Jl. Sudirman No. 99',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
