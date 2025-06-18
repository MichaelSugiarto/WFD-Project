<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('user.home', [
            'title' => 'Premium Automotive Care'
        ]);
    }

    public function book()
    {
        return view('user.book', [
            'title' => 'Book Service'
        ]);
    }

    public function history()
    {
        $licensePlate = str_replace(' ', '', request('license_plate'));
        
        if ($licensePlate) {
            $services = Service::with(['vehicle'])
            ->whereHas('vehicle', function ($query) use ($licensePlate) {
                $query->whereRaw("REPLACE(license_plate, ' ', '') LIKE ?", ["%{$licensePlate}%"]);
            })
            ->orderBy('start_date', 'desc')
            ->get();
            
            $upcomingAppointments = $services->filter(function ($service) {
                return $service->start_date && Carbon::parse($service->start_date)->isFuture();
            })->values();
            foreach ($upcomingAppointments as $u){
                $u->status = 'Waiting';
            }
            // dd($upcomingAppointments);
            
            $pastAppointments = $services->filter(function ($service) {
                return $service->start_date && Carbon::parse($service->start_date)->isPast();
            })->values();
        }
        // dd($pastAppointments);

        return view('user.history', [
            'title' => 'Service History',
            'upcomingAppointments' => $upcomingAppointments ?? collect(),
            'pastAppointments' => $pastAppointments ?? collect(),
            'searchTerm' => $licensePlate,
        ]);
    }


    public function historySearch(Request $request)
    {
        $licensePlate = trim($request->input('license_plate'));
        $normalizedSearchTerm = strtoupper(str_replace(' ', '', $licensePlate));

        $services = Service::whereHas('vehicle', function ($query) use ($normalizedSearchTerm) {
                $query->where('user_id', auth()->id())
                    ->whereRaw("REPLACE(UPPER(license_plate), ' ', '') LIKE ?", ["%$normalizedSearchTerm%"]);
            })
            ->with(['vehicle' => function($query) {
                $query->where('user_id', auth()->id());
            }])
            ->orderBy('start_date', 'desc')
            ->get();

        $upcomingAppointments = $services->filter(function($service) {
            return $service->appointment_date && Carbon::parse($service->appointment_date)->isFuture();
        })->values();
        
        $pastAppointments = $services->filter(function($service) {
            return $service->appointment_date && Carbon::parse($service->appointment_date)->isPast();
        })->values();

        return view('user.appointments', [
            'upcomingAppointments' => $upcomingAppointments,
            'pastAppointments' => $pastAppointments,
            'searchTerm' => $licensePlate
        ]);
    }




    
}
