<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Sparepart; // Still good to have if you use it elsewhere
use App\Models\User; // You might need this directly for other actions later

class ServiceController extends Controller
{
    public function view()
    {
        $services = Service::with(['vehicle.user', 'spareparts'])->get();

        $data = [
            'services' => $services,
            'title' => 'History Service',
        ];

        return view('admin.historyService', $data);
    }
}