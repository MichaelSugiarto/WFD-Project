<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Carbon\Carbon;

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

    public function storeBooking(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'vehicle_make' => 'required|string|max:255',
            'vehicle_model' => 'required|string|max:255',
            'service_type' => 'required|string|in:Maintenance,Diagnostics,Performance Tuning,Detailing,Repair',
            'appointment_date' => 'required|date|after_or_equal:today',
            'notes' => 'nullable|string',
        ]);

        Booking::create($validated);

        return redirect()->route('user.history')->with('success', 'Booking created successfully!');
    }

    public function history()
    {
        $bookings = Booking::orderBy('appointment_date', 'desc')->get();
        
        return view('user.history', [
            'title' => 'Service History',
            'upcomingAppointments' => $bookings->where('appointment_date', '>=', now()),
            'pastAppointments' => $bookings->where('appointment_date', '<', now())
        ]);
    }
}