<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Sparepart;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ServiceSparepartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $service = Service::first();
        $sparepart = Sparepart::all();


        $service_sparepart_data = [
            [
                'id' => Str::uuid(),
                'quantity' => 3,
                'unit_price' => 4,
                'service_id' => $service->id,
                'sparepart_id' => $sparepart[0]->id,
                
            ],
            [
                'id' => Str::uuid(),
                'quantity' => 10,
                'unit_price' => 10,
                'service_id' => $service->id,
                'sparepart_id' => $sparepart[1]->id,
            ],
        ];
        DB::table('service_sparepart')->insert($service_sparepart_data);
    }
}