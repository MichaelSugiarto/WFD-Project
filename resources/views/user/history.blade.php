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
    
    .search-container {
        position: relative;
        max-width: 500px;
        margin: 0 auto 30px;
    }
    
    .search-input {
        padding-right: 40px;
    }
    
    .search-icon {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: #6B7280;
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

<section class="history-section py-12">
    <div class="container mx-auto px-4 py-12">
        <div class="mb-8">
            <form id="searchForm" action="{{ route('user.history.search') }}" method="GET">
                <div class="relative max-w-md mx-auto">
                    <input type="text" id="searchInput" name="license_plate" placeholder="Search by license plate..." 
                        class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-gold pl-4 pr-10"
                        value="{{ request('license_plate') }}"
                        autocomplete="off">
                    <button type="submit" class="absolute right-3 top-1/2 transform -translate-y-1/2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        <div id="servicesContainer" class="bg-white rounded-lg shadow p-6">
            @include('user.appointments')
        </div>

    </div>
</section>

<script>
    $(document).ready(function() {
        $('#searchForm').on('submit', function(e) {
            e.preventDefault();
            const licensePlate = $('#searchInput').val().trim();
            
            if (licensePlate === '') {
                window.location.href = "{{ route('user.history') }}";
                return;
            }

            $.ajax({
                url: $(this).attr('action'),
                method: 'GET',
                data: { license_plate: licensePlate },
                success: function(data) {
                    $('#servicesContainer').html(data);
                    history.pushState(null, '', "{{ route('user.history') }}?license_plate=" + encodeURIComponent(licensePlate));
                },
                error: function(xhr) {
                    console.error("AJAX ERROR:", xhr.status, xhr.responseText);
                    $('#servicesContainer').html('<p class="text-center py-12 font-cormorant text-lg">Error loading results. Please try again.</p>');
                }
            });
        });

        window.onpopstate = function() {
            const urlParams = new URLSearchParams(window.location.search);
            const licensePlate = urlParams.get('license_plate');
            
            $('#searchInput').val(licensePlate || '');
            if (licensePlate) {
                $('#searchForm').submit();
            } else {
                window.location.href = "{{ route('user.history') }}";
            }
        };

        @if(request('license_plate'))
            $('#searchForm').submit();
        @endif
    });
</script>

@endsection