<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sparepart;
use Illuminate\Support\Str;

class SparepartSeeder extends Seeder
{
    public function run(): void
    {
        $spareparts = [
            ['name' => 'Oil Filter', 'stock' => 50],
            ['name' => 'Brake Pad', 'stock' => 30],
            ['name' => 'Spark Plug', 'stock' => 100],
            ['name' => 'Air Filter', 'stock' => 70],
            ['name' => 'Battery', 'stock' => 20],
        ];

        foreach ($spareparts as $sp) {
            Sparepart::create([
                'id' => (string) Str::uuid(),
                'name' => $sp['name'],
                'stock' => $sp['stock'],
            ]);
        }
    }
}
