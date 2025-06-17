<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Vehicle;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;

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
            'appointment_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $validated['appointment_date'] = Carbon::parse($validated['appointment_date']);

        // 1. Create or retrieve User
        // You might want to check if a user with this email already exists
        $user = User::firstOrCreate(
            ['email' => $validated['email']],
            [
                'name' => $validated['name'],
                'password' => bcrypt(Str::random(10)), // Generate a random password
                'telephone_number' => $validated['phone'],
                'address' => $validated['address'], // Assuming address is nullable or will be added later
            ]
        );

        // 2. Create Vehicle
        $vehicle = Vehicle::create([
            'license_plate' => $validated['license_plate'],
            'brand' => $validated['vehicle_brand'],
            'model' => $validated['vehicle_model'],
            'year_production' => $validated['vehicle_year_production'],
            'user_id' => $user->id,
        ]);

        // 3. Create Service
        $service = Service::create([
            'description' => $validated['service_type'],
            'status' => 'On Going', // As per your requirement
            'start_date' => Carbon::now(),
            'appointment_date' => $validated['appointment_date'], // Added appointment_date to service
            'notes' => $validated['notes'], // Add notes to service
            'vehicle_id' => $vehicle->id,
        ]);
        

        return redirect()->route('user.history')->with('success', 'Booking berhasil dibuat!');
    }
}