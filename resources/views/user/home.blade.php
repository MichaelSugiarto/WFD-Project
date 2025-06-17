@extends('user.layout')
@section('content')
@if (session()->has('error'))
    <script>
        Swal.fire({
            title: "Warning",
            text: "{{ session('error') }}",
            icon: "warning",
            didOpen: () => {
                const swalModal = document.querySelector('.swal2-container');
                swalModal.style.zIndex = '99999';
            }
        });
    </script>
@endif
@if (session()->has('guest'))
    <script>
        Swal.fire({
            title: "Warning",
            text: "{{ session('guest') }}",
            icon: "warning",
            didOpen: () => {
                const swalModal = document.querySelector('.swal2-container');
                swalModal.style.zIndex = '99999';
            }
        });
    </script>
@endif

<style>
    /* Updated Elegant Fonts */
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
    
    /* Rest of your existing styles remain exactly the same */
    .hero-section {
        background: url('https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?ixlib=rb-1.2.1&auto=format&fit=crop&w=1480&q=80') no-repeat center center;
        background-size: cover;
        height: 100vh;
        position: relative;
    }
    
    .hero-overlay {
        background: rgba(0, 0, 0, 0.7);
        height: 100%;
    }
    
    .service-card {
        transition: all 0.3s ease;
        border: 1px solid #e2e8f0;
    }
    
    .service-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
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
    
    .testimonial-card {
        background: #f8f9fa;
        border-left: 4px solid #D4AF37;
    }
</style>

<!-- All your existing HTML content remains exactly the same -->
<section class="hero-section">
    <div class="hero-overlay flex items-center">
        <div class="container mx-auto px-10 text-white pl-12">
            <div class="max-w-xl">
                <h1 class="font-cinzel text-5xl md:text-6xl font-bold mb-6">Premium Automotive Care</h1>
                <p class="font-cormorant text-xl mb-8">Experience unparalleled service for your luxury vehicle with our expert technicians and state-of-the-art facilities.</p>
                <a href="{{ route('user.book') }}" class="bg-gray-800 border border-white py-2 px-8 rounded font-montserrat text-lg inline-block">Book Now</a>
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="font-cinzel text-4xl mb-4">Our Services</h2>
            <div class="w-24 h-1 bg-gray-800 mx-auto mb-6"></div>
            <p class="font-cormorant text-xl max-w-2xl mx-auto">We offer a comprehensive range of services to keep your vehicle in peak condition.</p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8">
            <div class="service-card bg-white rounded-lg overflow-hidden p-6">
                <div class="text-gold mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <h3 class="font-cinzel text-2xl mb-3">Premium Maintenance</h3>
                <p class="font-cormorant text-gray-600">Regular maintenance to ensure your vehicle performs at its best.</p>
            </div>
            
            <div class="service-card bg-white rounded-lg overflow-hidden p-6">
                <div class="text-gold mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                    </svg>
                </div>
                <h3 class="font-cinzel text-2xl mb-3">Performance Tuning</h3>
                <p class="font-cormorant text-gray-600">Enhance your vehicle's performance with our expert tuning.</p>
            </div>
            
            <div class="service-card bg-white rounded-lg overflow-hidden p-6">
                <div class="text-gold mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="font-cinzel text-2xl mb-3">Diagnostics</h3>
                <p class="font-cormorant text-gray-600">Advanced diagnostics to identify and resolve any issues.</p>
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-gray-900 text-white">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 mb-10 md:mb-0 md:pr-10">
                <img src="https://images.unsplash.com/photo-1580273916550-e323be2ae537?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80" alt="About Us" class="rounded-lg shadow-xl">
            </div>
            <div class="md:w-1/2">
                <h2 class="font-cinzel text-4xl mb-6">About Our Workshop</h2>
                <p class="font-cormorant text-lg mb-6">With over 20 years of experience in luxury automotive care, our workshop is equipped with the latest technology and staffed by certified technicians who are passionate about cars.</p>
                <p class="font-cormorant text-lg mb-8">We pride ourselves on attention to detail and delivering exceptional service that meets the highest standards of the automotive industry.</p>
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="font-cinzel text-4xl mb-4">Client Testimonials</h2>
            <div class="w-24 h-1 bg-gray-800 mx-auto mb-6"></div>
            <p class="font-cormorant text-xl max-w-2xl mx-auto">What our valued clients say about our services.</p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8">
            <div class="testimonial-card p-6 rounded">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 rounded-full bg-gray-300 mr-4 overflow-hidden">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Client" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h4 class="font-cinzel text-lg">Michael R.</h4>
                        <p class="font-cormorant text-gray-600">Ferrari Owner</p>
                    </div>
                </div>
                <p class="font-cormorant italic">"The best service I've ever experienced. My Ferrari runs like new after their maintenance."</p>
            </div>
            
            <div class="testimonial-card p-6 rounded">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 rounded-full bg-gray-300 mr-4 overflow-hidden">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Client" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h4 class="font-cinzel text-lg">Sarah L.</h4>
                        <p class="font-cormorant text-gray-600">Porsche Owner</p>
                    </div>
                </div>
                <p class="font-cormorant italic">"Exceptional attention to detail. They treat my car like it's their own."</p>
            </div>
            
            <div class="testimonial-card p-6 rounded">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 rounded-full bg-gray-300 mr-4 overflow-hidden">
                        <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="Client" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h4 class="font-cinzel text-lg">James T.</h4>
                        <p class="font-cormorant text-gray-600">Aston Martin Owner</p>
                    </div>
                </div>
                <p class="font-cormorant italic">"Professional, knowledgeable, and trustworthy. I wouldn't take my car anywhere else."</p>
            </div>
        </div>
    </div>
</section>

<section class="py-16 bg-gray-800 text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="font-cinzel text-4xl mb-6">Ready to Experience Premium Service?</h2>
        <p class="font-cormorant text-xl mb-8 max-w-2xl mx-auto">Book your appointment today and let our experts take care of your vehicle.</p>
        <a href="{{ route('user.book') }}" class="btn-gold py-3 px-8 rounded font-montserrat text-lg inline-block">Schedule Service</a>
    </div>
</section>

@endsection

@section('script')

<script>
    // LENIS SMOOTH SCROLL
    const lenis = new Lenis()
    lenis.on('scroll', (e) => {})
    lenis.on('scroll', ScrollTrigger.update)
    gsap.ticker.add((time) => {
        lenis.raf(time * 1000)
    })
    gsap.ticker.lagSmoothing(0)
</script>

@endsection