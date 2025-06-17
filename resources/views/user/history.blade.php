@extends('user.layout')
@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500;600;700&family=Cormorant+Garamond:wght@300;400;500;600;700&family=Montserrat:wght@100;200;300;400;500;600&display=swap');
    
    .font-montserrat {
        font-family: 'Montserrat', sans-serif;
        font-weight: 400;
    }
    
    .font-cinzel {
        font-family: 'EB Garamond', serif;
        font-weight: 600;
        letter-spacing: 0.5px;
    }
    
    .font-cormorant {
        font-family: 'Cormorant Garamond', serif;
        font-weight: 400;
        line-height: 1.6;
    }

    .history-section {
        background: #f8f9fa;
        min-height: 100vh;
    }
    
    .history-header {
        background: url('https://images.unsplash.com/photo-1493238792000-8113da705763?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') no-repeat center center;
        background-size: cover;
        height: 300px;
        position: relative;
    }
    
    .history-overlay {
        background: rgba(0, 0, 0, 0.7);
        height: 100%;
    }
    
    .history-card {
        transition: all 0.3s ease;
        border-left: 4px solid #D4AF37;
    }
    
    .history-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .btn-gold {
        background: #D4AF37;
        color: white;
        font-weight: 500;
    }
    
    .btn-gold:hover {
        background: #B7950B;
        color: white;
    }
    
    .text-gold {
        color: #D4AF37;
    }
    
    .status-completed {
        color: #10B981;
    }
    
    .status-pending {
        color: #F59E0B;
    }
    
    .status-cancelled {
        color: #EF4444;
    }
</style>

<section class="history-header">
    <div class="history-overlay flex items-center">
        <div class="container mx-auto px-4 text-white text-center">
            <h1 class="font-cinzel text-5xl mb-6">Service History</h1>
            <p class="font-cormorant text-xl max-w-2xl mx-auto">View your past and upcoming service appointments with Premium Automotive Care.</p>
        </div>
    </div>
</section>

<section class="history-section py-20">
    <div class="container mx-auto px-4">
        <div class="mb-10 flex justify-between items-center">
            <h2 class="font-cinzel text-3xl">Your Appointments</h2>
            <a href="{{ route('user.book') }}" class="btn-gold py-2 px-6 rounded font-montserrat">Book New Service</a>
        </div>
        
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6 border-b">
                <h3 class="font-cinzel text-2xl mb-6 text-black">Upcoming Appointments</h3>
                
                @if($upcomingAppointments->count() > 0)
                    @foreach($upcomingAppointments as $appointment)
                    <div class="history-card bg-white rounded mb-4 p-6 shadow-sm">
                        <div class="flex flex-col md:flex-row md:justify-between md:items-center">
                            <div class="mb-4 md:mb-0">
                                <h4 class="font-cinzel text-xl mb-2">{{ $appointment->service_type }}</h4>
                                <p class="font-cormorant">
                                    <span class="font-semibold">Vehicle:</span> {{ $appointment->vehicle_make }} {{ $appointment->vehicle_model }}
                                </p>
                                <p class="font-cormorant">
                                    <span class="font-semibold">Scheduled:</span> {{ $appointment->appointment_date->format('F j, Y') }}
                                </p>
                            </div>
                            <div class="flex flex-col items-end">
                                <span class="status-pending font-montserrat font-semibold mb-2">Upcoming</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <p class="font-cormorant text-gray-600">No upcoming appointments found.</p>
                @endif
            </div>
            
            <div class="p-6">
                <h3 class="font-cinzel text-2xl mb-6 text-black">Service History</h3>
                
                @if($pastAppointments->count() > 0)
                    @foreach($pastAppointments as $appointment)
                    <div class="history-card bg-white rounded mb-4 p-6 shadow-sm">
                        <div class="flex flex-col md:flex-row md:justify-between md:items-center">
                            <div class="mb-4 md:mb-0">
                                <h4 class="font-cinzel text-xl mb-2">{{ $appointment->service_type }}</h4>
                                <p class="font-cormorant">
                                    <span class="font-semibold">Vehicle:</span> {{ $appointment->vehicle_make }} {{ $appointment->vehicle_model }}
                                </p>
                                <p class="font-cormorant">
                                    <span class="font-semibold">Date:</span> {{ $appointment->appointment_date->format('F j, Y') }}
                                </p>
                                @if($appointment->notes)
                                <p class="font-cormorant">
                                    <span class="font-semibold">Notes:</span> {{ $appointment->notes }}
                                </p>
                                @endif
                            </div>
                            <div class="flex flex-col items-end">
                                <span class="status-completed font-montserrat font-semibold mb-2">Completed</span>
                                <a href="#" class="text-gold font-cormorant underline">View Details</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <p class="font-cormorant text-gray-600">No past service records found.</p>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection