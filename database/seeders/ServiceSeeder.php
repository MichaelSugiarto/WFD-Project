<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Vehicle; // Don't forget to import the Vehicle model
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vehicle = Vehicle::first();

        if (!$vehicle) {
            $this->command->error('No vehicles found. Run VehicleSeeder first.');
            return;
        }

        // Define the service data.
        $services = [
            [
                'id' => Str::uuid(),
                'description' => 'Routine oil change and tire rotation.',
                'status' => 'completed',
                'start_date' => '2024-01-15',
                'total_cost' => 112, 
                'vehicle_id' => $vehicle->id, 
            ],
            [
                'id' => Str::uuid(),
                'description' => 'Brake pad replacement and fluid check.',
                'status' => 'in_progress',
                'start_date' => '2024-03-20',
                'total_cost' => 0, 
                'vehicle_id' => $vehicle->id,
            ],
            [
                'id' => Str::uuid(),
                'description' => 'Annual inspection and minor tune-up.',
                'status' => 'scheduled',
                'start_date' => '2025-07-10',
                'total_cost' => 0, 
                'vehicle_id' => $vehicle->id,
            ],
        ];

        foreach ($services as $serviceData) {
            Service::create($serviceData);
        }
    }
}