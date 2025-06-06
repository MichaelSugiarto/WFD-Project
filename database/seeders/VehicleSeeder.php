<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehicle;
use App\Models\User;
use Illuminate\Support\Str;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first(); 

        if (!$user) {
            $this->command->error('No users found. Run UserSeeder first.');
            return;
        }

        $vehicles = [
            [
                'id' => Str::uuid(),
                'license_plate' => 'N 1234 AB',
                'brand' => 'Toyota',
                'model' => 'Avanza',
                'year_production' => '2020',
                'user_id' => $user->id,
            ],
            [
                'id' => Str::uuid(),
                'license_plate' => 'L 5678 CD',
                'brand' => 'Honda',
                'model' => 'Civic',
                'year_production' => '2018',
                'user_id' => $user->id,
            ],
        ];

        foreach ($vehicles as $v) {
            Vehicle::create($v);
        }
    }
}
