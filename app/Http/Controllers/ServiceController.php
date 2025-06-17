<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Sparepart; // Still good to have if you use it elsewhere
use App\Models\User; // You might need this directly for other actions later

class ServiceController extends Controller
{
    public function view()
    {
        $services = Service::with(['vehicle.user', 'spareparts'])
        ->where('status', 'Completed') // Added this line
        ->get();

        $data = [
            'services' => $services,
            'spareparts' => Sparepart::all(),
            'title' => 'History Service',
        ];

        return view('admin.historyService', $data);
    }
    public function edit(Request $request)
    {
        $spareparts = $request->input('spareparts', []);
        $quantities = $request->input('quantities', []);
        $unit_prices = $request->input('unit_prices', []);

        $errors = [];

        foreach ($spareparts as $index => $sparepartId) {
            $sparepart = Sparepart::find($sparepartId);
            $quantity = (int) $quantities[$index];

            if (!$sparepart) {
                $errors["spareparts.$index"] = "Spare part not found.";
            } elseif ($quantity > $sparepart->stock) {
                $errors["quantities.$index"] = "Requested quantity ($quantity) exceeds available stock ({$sparepart->stock}) for {$sparepart->name}.";
            }
        }

        if (!empty($errors)) {
            return redirect()->back()
                ->withErrors($errors)
                ->withInput();
        }

        $service = Service::findOrFail($request->service_id);
        $service->status = $request->input('status');
        if (strtolower($request->input('status')) === 'completed') {
            $service->end_date = now();
        }

        $totalCost = 0;
        $syncData = [];
        
        foreach ($spareparts as $index => $sparepartId) {
            $quantity = (int) $quantities[$index];
            $unitPrice = (float) $unit_prices[$index];
        
            $syncData[$sparepartId] = [
                'id' => Str::uuid(),
                'quantity' => $quantities[$index],
                'unit_price' => $unit_prices[$index],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        
            $totalCost += $quantity * $unitPrice;
        }

        $service->total_cost = $totalCost;
        $service->save();

        $service->spareparts()->sync($syncData);

        return redirect()->back()->with('success', 'Service updated successfully.');
    }
}