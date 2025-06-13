<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = [
            [
                'name' => 'Willson',
                'email' => 'c14230033@john.petra.ac.id',
                'password' => Hash::make('password123'),
                'role_id' => Role::where('name', 'Manager')->first()?->id,
            ],
            [
                'name' => 'Willson',
                'email' => 'c14230034@john.petra.ac.id',
                'password' => Hash::make('password123'),
                'role_id' => Role::where('name', 'Technician')->first()?->id,
            ],
            [
                'name' => 'Willson',
                'email' => 'c14230035@john.petra.ac.id',
                'password' => Hash::make('password123'),
                'role_id' => Role::where('name', 'Supplier')->first()?->id,
            ],
            [
                'name' => 'Willson',
                'email' => 'c14230036@john.petra.ac.id',
                'password' => Hash::make('password123'),
                'role_id' => Role::where('name', 'Manager')->first()?->id,
            ],
        ];

        foreach ($admins as $admin) {
            Admin::create($admin);
        }
    }
}
