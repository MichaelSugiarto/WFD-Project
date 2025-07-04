<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(SparepartSeeder::class);
        $this->call(VehicleSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(ServiceSparepartSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(AdminSeeder::class);
    }
}
