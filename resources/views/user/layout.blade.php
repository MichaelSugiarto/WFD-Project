<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="BGKL">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('assets/logo/logo_black.png') }}"> {{-- Logo icon --}}

    {{-- Flowbite --}}
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />

    {{-- Tailwind --}}
    <script src="https://cdn.tailwindcss.com/3.3.0"></script>

    {{-- Sweet alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- Alpine js --}}
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/tw-elements.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/css/tw-elements.min.css" />

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        crossorigin="anonymous" />

    {{-- AOS --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    {{-- flaticon --}}
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    
    {{-- GSAP & lenis--}}
    <link rel="stylesheet" href="https://unpkg.com/lenis@1.1.19/dist/lenis.css">

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative&family=Cormorant+Garamond&family=Monterchi&display=swap" rel="stylesheet">


    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            AOS.init();
        });
    </script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                fontFamily: {
                    primary: ['Monterchi', 'serif'],
                    secondary: ['Cinzel Decorative', 'serif'],
                    tertiary: ['Cormorant Garamond', 'serif'],
                },
            },
            corePlugins: {
                preflight: false,
            },
        };
    </script>


    <title>BGKL | {{ $title }}</title>

    <style>
        ::-webkit-scrollbar {
            width: 9px;
        }

        ::-webkit-scrollbar-thumb {
        background: linear-gradient(360deg, #333333, #888888, transparent);
        border-radius: 30px;
        }

        ::-webkit-scrollbar-track {
        background: #111111;
        }

        html {
            scroll-behavior: smooth;
        }

        .swal2-confirm {
            background: #589981 !important;
        }

        .swal2-deny,
        .swal2-cancel {
            background: #cd6d00 !important;
        }

        .disableScroll {
            overflow: hidden;
        }

       
        body {
            margin: 0;
            padding: 0;
            padding-top: 64px;
        }
        html {
            scroll-padding-top: 64px; 
        }

    </style>

    <style>
        body {
            margin: 0;
            padding: 0;
            padding-top: 64px;
        }
        html {
            scroll-padding-top: 64px;
        }
        nav {
            height: 64px;
        }
        .history-header {
            margin-top: -64px;
        }
        .history-overlay {
            padding-top: 64px;
            height: 300px;
        }
    </style>
    @yield('style')
</head>

<body>
    <nav class="bg-gray-900 text-white shadow-lg fixed top-0 left-0 w-full z-50">
        <div class="container mx-auto px-4 h-full flex justify-between items-center">
            <a href="{{ route('user.home') }}" class="font-cinzel text-2xl text-gold">Premium Auto</a>
            <div class="hidden md:flex space-x-8 h-full items-center">
                <a href="{{ route('user.home') }}" class="font-montserrat hover:text-gold transition duration-300 h-full flex items-center">Home</a>
                <a href="{{ route('user.book') }}" class="font-montserrat hover:text-gold transition duration-300 h-full flex items-center">Book Service</a>
                <a href="{{ route('user.history') }}" class="font-montserrat hover:text-gold transition duration-300 h-full flex items-center">Service History</a>
            </div>
            <button class="md:hidden focus:outline-none" id="mobile-menu-button">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
        <!-- Mobile menu -->
        <div class="md:hidden hidden bg-gray-800" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="{{ route('user.home') }}" class="block px-3 py-2 font-montserrat hover:text-gold">Home</a>
                <a href="{{ route('user.book') }}" class="block px-3 py-2 font-montserrat hover:text-gold">Book Service</a>
                <a href="{{ route('user.history') }}" class="block px-3 py-2 font-montserrat hover:text-gold">Service History</a>
            </div>
        </div>
    </nav>

    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>
    @if (session()->has('invalidLogin'))
        <script>
            Swal.fire({
                title: "Error",
                text: "{{ session('invalidLogin') }}",
                icon: "error"
            });
        </script>
    @endif
    @if (session()->has('logout'))
        <script>
            Swal.fire({
                title: "Success",
                text: "{{ session('logout') }}",
                icon: "success"
            });
        </script>
    @endif
    @if (session()->has('guest'))
        <script>
            Swal.fire({
                title: "ERROR",
                text: "{{ session('guest') }}",
                icon: "error"
            });
        </script>
    @endif
    <div class="">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/js/tw-elements.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://unpkg.com/lenis@1.1.19/dist/lenis.min.js"></script>    
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.7/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.7/dist/ScrollTrigger.min.js"></script>

    @yield('script')
    
</body>

</html>