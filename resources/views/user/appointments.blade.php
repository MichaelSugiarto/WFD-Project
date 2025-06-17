@if($upcomingAppointments->count() > 0 || $pastAppointments->count() > 0)
    @if($upcomingAppointments->count() > 0)
        <div class="mb-8">
            <h2 class="font-cinzel text-2xl mb-4">Upcoming Appointments</h2>
            <div class="grid gap-4">
                @foreach($upcomingAppointments as $service)
                    <div class="bg-gray-50 p-4 rounded border border-gray-200">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-semibold text-lg">{{ $service->description }}</h3>
                                <p class="text-gray-600">Status: <span class="text-blue-600">{{ $service->status }}</span></p>
                                <p class="text-gray-600">Appointment Date: {{ $service->appointment_date ? \Carbon\Carbon::parse($service->appointment_date)->format('M d, Y') : 'Not set' }}</p>
                            </div>
                            <div class="text-right">
                                @if($service->vehicle)
                                    <p class="text-sm text-gray-500">Vehicle: {{ $service->vehicle->brand }} {{ $service->vehicle->model }}</p>
                                    <p class="text-sm text-gray-500">License: {{ $service->vehicle->license_plate }}</p>
                                @else
                                    <p class="text-sm text-gray-500">Vehicle: N/A</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @if($pastAppointments->count() > 0)
        <div class="mb-8">
            <h2 class="font-cinzel text-2xl mb-4">Past Appointments</h2>
            <div class="grid gap-4">
                @foreach($pastAppointments as $service)
                    <div class="bg-gray-50 p-4 rounded border border-gray-200">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-semibold text-lg">{{ $service->description }}</h3>
                                <p class="text-gray-600">Status: <span class="{{ $service->status === 'Completed' ? 'text-green-600' : 'text-red-600' }}">{{ $service->status }}</span></p>
                                <p class="text-gray-600">Date: {{ \Carbon\Carbon::parse($service->start_date)->format('M d, Y') }}</p>
                            </div>
                            <div class="text-right">
                                @if($service->vehicle)
                                    <p class="text-sm text-gray-500">Vehicle: {{ $service->vehicle->brand }} {{ $service->vehicle->model }}</p>
                                    <p class="text-sm text-gray-500">License: {{ $service->vehicle->license_plate }}</p>
                                @else
                                    <p class="text-sm text-gray-500">Vehicle: N/A</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@else
    <div class="text-center py-8">
        @if($searchTerm)
            <p class="text-lg">No appointments found for license plate: <span class="font-semibold">{{ $searchTerm }}</span></p>
        @else
            <p class="text-lg">No service appointments found.</p>
        @endif
    </div>
@endif