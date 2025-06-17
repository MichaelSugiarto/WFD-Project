<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Vehicle;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Booking List',
        ];
        return view('admin.allBooking', $data);
    }

    public function create()
    {
        return view('user.book');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:20',
            'vehicle_model' => 'required|string|max:255',
            'vehicle_year_production' => 'required|string|max:255',
            'vehicle_brand' => 'required|string|max:255',
            'license_plate' => 'required|string|max:255',
            'service_type' => 'required|string|max:255',
            'appointment_date' => 'required|date|after_or_equal:today',
            'notes' => 'nullable|string',
        ]);

        $validated['appointment_date'] = Carbon::parse($validated['appointment_date']);

        if (Auth::check()) {
            $user = Auth::user();
            $user->update([
                'name' => $validated['name'],
                'telephone_number' => $validated['phone'],
                'address' => $validated['address'],
            ]);
        } else {
            $user = User::firstOrCreate(
                ['email' => $validated['email']],
                [
                    'name' => $validated['name'],
                    'password' => bcrypt(Str::random(10)),
                    'telephone_number' => $validated['phone'],
                    'address' => $validated['address'],
                ]
            );
        }

       $normalizedLicensePlate = strtoupper(str_replace(' ', '', $validated['license_plate']));

        $vehicle = Vehicle::firstOrCreate(
            ['license_plate' => $normalizedLicensePlate, 'user_id' => $user->id],
            [
                'brand' => $validated['vehicle_brand'],
                'model' => $validated['vehicle_model'],
                'year_production' => $validated['vehicle_year_production'],
            ]
        );

        $service = Service::create([
            'description' => $validated['service_type'],
            'status' => 'On Going',
            'start_date' => Carbon::now(),
            'appointment_date' => $validated['appointment_date'],
            'notes' => $validated['notes'],
            'vehicle_id' => $vehicle->id,
        ]);

        return redirect()->route('user.history')->with('success', 'Booking berhasil dibuat!');
    }

}