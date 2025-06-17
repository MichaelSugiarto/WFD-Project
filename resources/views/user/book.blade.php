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
    
    .booking-section {
        background: url('https://images.unsplash.com/photo-1503376780353-7e6692767b70?ixlib=rb-1.2.1&auto=format&fit=crop&w=1800&q=80') no-repeat center center;
        background-size: cover;
        min-height: 100vh;
        position: relative;
    }
    
    .booking-overlay {
        background: rgba(0, 0, 0, 0.75);
        min-height: 100%;
    }
    
    .booking-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
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
    
    .form-control:focus {
        border-color: #D4AF37;
        box-shadow: 0 0 0 0.2rem rgba(212, 175, 55, 0.25);
    }
</style>

<section class="booking-section">
    <div class="booking-overlay py-20">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="booking-card rounded-lg shadow-xl overflow-hidden">
                    <div class="md:flex">
                        <div class="md:w-1/3 bg-gray-800 text-white p-8 flex flex-col justify-center">
                            <h2 class="font-cinzel text-3xl mb-6">Book Your Service</h2>
                            <p class="font-cormorant mb-6">Schedule an appointment with our expert technicians for premium automotive care.</p>
                            <div class="flex items-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <span class="font-montserrat">(123) 456-7890</span>
                            </div>
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                                </svg>
                                <span class="font-montserrat">support@premiumauto.com</span>
                            </div>
                        </div>
                        <div class="md:w-2/3 p-8">
                            <form action="{{ route('user.booking.store') }}" method="POST">
                                @csrf
                                <div class="mb-6">
                                    <label for="name" class="block font-cormorant text-lg mb-2">Full Name</label>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-gold" required>
                                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                
                                <div class="mb-6">
                                    <label for="email" class="block font-cormorant text-lg mb-2">Email</label>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-gold" required>
                                    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                
                                <div class="mb-6">
                                    <label for="phone" class="block font-cormorant text-lg mb-2">Phone Number</label>
                                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-gold" required>
                                    @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-6">
                                    <label for="address" class="block font-cormorant text-lg mb-2">Address</label>
                                    <input type="tel" id="address" name="address" value="{{ old('address') }}" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-gold" required>
                                    @error('address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                
                                <div class="mb-6">
                                    <label for="vehicle_brand" class="block font-cormorant text-lg mb-2">Vehicle Brand</label>
                                    <input type="text" id="vehicle_brand" name="vehicle_brand" value="{{ old('vehicle_brand') }}" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-gold" required>
                                    @error('vehicle_brand') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-6">
                                    <label for="vehicle_year_production" class="block font-cormorant text-lg mb-2">Vehicle Year Production</label>
                                    <input type="text" id="vehicle_year_production" name="vehicle_year_production" value="{{ old('vehicle_year_production') }}" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-gold" required>
                                    @error('vehicle_year_production') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-6">
                                    <label for="vehicle_model" class="block font-cormorant text-lg mb-2">Vehicle Model</label>
                                    <input type="text" id="vehicle_model" name="vehicle_model" value="{{ old('vehicle_model') }}" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-gold" required>
                                    @error('vehicle_model') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-6">
                                    <label for="license_plate" class="block font-cormorant text-lg mb-2">License Plate</label>
                                    <input type="text" id="license_plate" name="license_plate" value="{{ old('license_plate') }}" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-gold" required>
                                    @error('license_plate') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                
                                <div class="mb-6">
                                    <label for="service_type" class="block font-cormorant text-lg mb-2">Service Type</label>
                                    <select id="service_type" name="service_type" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-gold" required>
                                        <option value="">Select a service</option>
                                        <option value="Maintenance" {{ old('service_type') == 'Maintenance' ? 'selected' : '' }}>Regular Maintenance</option>
                                        <option value="Diagnostics" {{ old('service_type') == 'Diagnostics' ? 'selected' : '' }}>Diagnostics</option>
                                        <option value="Performance Tuning" {{ old('service_type') == 'Performance Tuning' ? 'selected' : '' }}>Performance Tuning</option>
                                        <option value="Detailing" {{ old('service_type') == 'Detailing' ? 'selected' : '' }}>Premium Detailing</option>
                                        <option value="Repair" {{ old('service_type') == 'Repair' ? 'selected' : '' }}>Mechanical Repair</option>
                                    </select>
                                    @error('service_type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                
                                <div class="mb-6">
                                    <label for="appointment_date" class="block font-cormorant text-lg mb-2">Preferred Date</label>
                                    <input type="date" id="appointment_date" name="appointment_date" value="{{ old('appointment_date') }}" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-gold" required>
                                    @error('appointment_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                
                                <div class="mb-6">
                                    <label for="notes" class="block font-cormorant text-lg mb-2">Additional Notes</label>
                                    <textarea id="notes" name="notes" rows="3" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-gold">{{ old('notes') }}</textarea>
                                    @error('notes') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                
                                <button type="submit" class="btn-gold py-3 px-8 rounded font-montserrat text-lg w-full">Book Appointment</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection