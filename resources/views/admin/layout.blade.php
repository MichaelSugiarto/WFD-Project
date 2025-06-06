<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- logo di asset -->
    <link rel="icon" href="{{ asset('assets/logo/logo_black.png') }}"> 

    <script src="https://cdn.tailwindcss.com?plugins=typography,aspect-ratio,line-clamp"></script> <!-- tambahin forms, di sebelah plugins= kalo butuh soale nabrak mbe twe-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <title>Admin BGKL | {{ $title }}</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/tw-elements.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/css/tw-elements.min.css" />
    <script src="https://cdn.tailwindcss.com/3.3.0"></script>

    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script> --}}

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative&family=Cormorant+Garamond&family=Monterchi&display=swap" rel="stylesheet">

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

    <style>
        * {
            font-family: 'Monterchi', serif;
        }

        .cinzel {
            font-family: 'Cinzel Decorative', serif;
        }

        .cormorant {
            font-family: 'Cormorant Garamond', sans-serif;
        }

        html {
            scroll-behavior: smooth;
        }

        :root {
            /* option 1 colors */
            --main: #589981;
            --side: #B0D79F;

            /* option 2 colors */
            --green1: #b8d6a4;
            --green2: #d0e5c3;
            --green3: #d0e5c3;
            --blue1: #72b3b4;
            --blue2: #94dceb;
            --blue3: #cbedee;
            --sand1: #d1b596;
            --sand2: #ccbeac;
            --sand3: #f8e7ca;
        }

        .swal2-confirm {
            background: #589981 !important;
        }

        .swal2-deny,
        .swal2-cancel {
            background: #cd6d00 !important;
        }

        .button-interact {
            transition: .3s ease;
        }

        .button-interact:hover {
            box-shadow: 0 0 9px #CCCAB2;
        }

        .button-interact:active {
            box-shadow: none;
        }
    </style>

    @yield('style')
</head>

<body>
    @if (session()->has('error'))
        <script>
            Swal.fire({
                title: "Error",
                text: "{{ session('error') }}",
                icon: "error"
            });
        </script>
    @endif

    <!-- Sidenav -->
    <nav id="sidenav-8"
        class=" fixed left-0 top-0 z-[1035] h-full min-h-[100vh] w-60 -translate-x-full overflow-hidden bg-white shadow-[0_4px_12px_0_rgba(0,0,0,0.07),_0_2px_4px_rgba(0,0,0,0.05)] data-[te-sidenav-hidden='false']:translate-x-0 dark:bg-zinc-800 invisible md:visible"
        data-te-sidenav-init data-te-sidenav-hidden="false" data-te-sidenav-position="fixed" data-te-sidenav-mode="side"
        data-te-sidenav-accordion="true">
        <a class="mb-3 flex items-center justify-center border-b-2 border-solid border-gray-100 py-6 outline-none"
            href="#!" data-te-ripple-init data-te-ripple-color="#b8d6a4">
            <span class="cinzel text-center text-black font-bold">Admin Website<br>BGKL</span>
        </a>
        <ul class="relative m-0 list-none px-[0.2rem] pb-12" data-te-sidenav-menu-ref>
            <li class="relative">

                <!-- ISI ROUTE ALL PARTICIPANT -->
                <a class="flex cursor-pointer items-center truncate rounded-[5px] px-6 py-[0.45rem] text-[0.85rem] text-black outline-none transition duration-300 ease-linear hover:bg-slate-50 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
                    data-te-sidenav-link-ref href="{{ route('admin.allSparepart') }}">
                    <span
                        class="mr-4 [&>svg]:h-3.5 [&>svg]:w-3.5
                    [&>svg]:text-black dark:[&>svg]:text-black">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path
                                d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464l349.5 0c-8.9-63.3-63.3-112-129-112l-91.4 0c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304l91.4 0C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7L29.7 512C13.3 512 0 498.7 0 482.3z" />
                        </svg>
                    </span>
                    <span >All Sparepart</span>
                </a>

                <a class="flex cursor-pointer items-center truncate rounded-[5px] px-6 py-[0.45rem] text-[0.85rem] text-black outline-none transition duration-300 ease-linear hover:bg-slate-50 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
                    data-te-sidenav-link-ref href="{{ route('admin.serviceHistory') }}">
                    <span
                        class="mr-4 [&>svg]:h-3.5 [&>svg]:w-3.5
                    [&>svg]:text-black dark:[&>svg]:text-black">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path
                                d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464l349.5 0c-8.9-63.3-63.3-112-129-112l-91.4 0c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304l91.4 0C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7L29.7 512C13.3 512 0 498.7 0 482.3z" />
                        </svg>
                    </span>
                    <span >Service History</span>
                </a>
            </li>
        </ul>
    </nav>

    {{-- NAVBAR --}}
    <!-- Main navigation container -->
    <nav
        class="flex-no-wrap relative flex w-full items-center justify-between bg-[#FBFBFB] py-2 shadow-md shadow-black/5 dark:bg-neutral-600 dark:shadow-black/10 lg:flex-wrap lg:justify-start lg:py-4 block md:hidden">
        <div class="flex w-full flex-wrap items-center justify-between px-3">
            <!-- Hamburger button for mobile view -->
            <button
                class="block border-0 bg-transparent px-2 text-neutral-500 hover:no-underline hover:shadow-none focus:no-underline focus:shadow-none focus:outline-none focus:ring-0 dark:text-neutral-200 lg:hidden"
                type="button" data-te-collapse-init data-te-target="#navbarSupportedContent12"
                aria-controls="navbarSupportedContent12" aria-expanded="false" aria-label="Toggle navigation">
                <!-- Hamburger icon -->
                <span class="[&>svg]:w-7">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-7 w-7">
                        <path fill-rule="evenodd"
                            d="M3 6.75A.75.75 0 013.75 6h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 6.75zM3 12a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 12zm0 5.25a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75a.75.75 0 01-.75-.75z"
                            clip-rule="evenodd" />
                    </svg>
                </span>
            </button>


            <!-- Collapsible navigation container -->
            <div class="!visible hidden flex-grow basis-[100%] items-center lg:!flex lg:basis-auto"
                id="navbarSupportedContent12" data-te-collapse-item>
                <!-- Left navigation links -->

                <ul class="list-style-none mr-auto flex flex-col pl-0 lg:flex-row" data-te-navbar-nav-ref>
                    <li class="my-4 pl-2 lg:mb-0 lg:pl-0 lg:pr-1" data-te-nav-item-ref>
                        <a class="!w-full text-neutral-500 transition duration-200 hover:text-neutral-700 hover:ease-in-out focus:text-neutral-700 disabled:text-black/30 motion-reduce:transition-none dark:text-neutral-200 dark:hover:text-neutral-300 dark:focus:text-neutral-300 sm:px-2 [&.active]:text-black/90 dark:[&.active]:text-zinc-400"
                            href="{{ route('admin.allSparepart') }}" data-te-nav-link-ref>All Sparepart</a>
                    </li>
                </ul>
            </div>

            <div class="!visible hidden flex-grow basis-[100%] items-center lg:!flex lg:basis-auto"
                id="navbarSupportedContent12" data-te-collapse-item>
                <!-- Left navigation links -->

                <ul class="list-style-none mr-auto flex flex-col pl-0 lg:flex-row" data-te-navbar-nav-ref>
                    <li class="my-4 pl-2 lg:mb-0 lg:pl-0 lg:pr-1" data-te-nav-item-ref>
                        <a class="!w-full text-neutral-500 transition duration-200 hover:text-neutral-700 hover:ease-in-out focus:text-neutral-700 disabled:text-black/30 motion-reduce:transition-none dark:text-neutral-200 dark:hover:text-neutral-300 dark:focus:text-neutral-300 sm:px-2 [&.active]:text-black/90 dark:[&.active]:text-zinc-400"
                            href="{{ route('admin.serviceHistory') }}" data-te-nav-link-ref>Service History</a>
                    </li>
                </ul>
            </div>

            <!-- Logout taruh disini -->
        </div>
    </nav>

    <div class="xl:w-10/12 w-full md:ms-60 flex justify-center md:block lg:ms-60 xl:ms-60">
        <div
            class="flex flex-col justify-center mx-auto md:rounded-b-full shadow-[#c8e9f0] rounded-3xl shadow-2xl px-12">
            <h1
                class="typewriter lg:text-5xl md:text-4xl text-lg py-5 font-bold bg-gradient-to-tr from-[#563176] to-[#b399c8] bg-clip-text text-transparent text-center">
                {{ $title }}</h1>
        </div>
    </div>

    <div class="ml-0 lg:ml-68 md:ml-60 px-3 md:px-8 py-2 md:py-5 mt-10">

        @yield('content')
    </div>


    <script src="https://cdn.jsdelivr.net/npm/tw-elements/js/tw-elements.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>

    <script></script>
    <script>
        function confirm(event, element) {
            event.preventDefault(); // Prevent the default link behavior

            Swal.fire({
                title: 'Are you sure?',
                text: "Do you really want to proceed?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, proceed!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: element.href,
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token
                        },
                        success: function(response) {
                            Swal.fire(
                                'Success!',
                                'The action was completed successfully.',
                                'success'
                            );
                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Error!',
                                'Something went wrong. Please try again.',
                                'error'
                            );
                        }
                    });
                }
            });
        }
    </script>

    @yield('script')
</body>

</html>
