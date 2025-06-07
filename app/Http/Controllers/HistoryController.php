<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Carbon\Carbon;

class HistoryController extends Controller
{
    public function index()
    {
        $upcomingAppointments = Booking::where('appointment_date', '>=', Carbon::today())
            ->orderBy('appointment_date')
            ->get();

        $pastAppointments = Booking::where('appointment_date', '<', Carbon::today())
            ->orderByDesc('appointment_date')
            ->get();

        return view('user.history', [
            'upcomingAppointments' => $upcomingAppointments,
            'pastAppointments' => $pastAppointments
        ]);
    }
}