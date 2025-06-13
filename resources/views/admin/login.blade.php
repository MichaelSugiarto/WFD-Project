<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('assets/logo/logo_black.png') }}">
    <title>BGKL | Admin Login</title>

    {{-- TW Elements --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/tw-elements.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/css/tw-elements.min.css" />

    {{-- Tailwind --}}
    <script src="https://cdn.tailwindcss.com/"></script>

    {{-- Sweet Alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap');
        @import url("https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap");

        * {
            user-select: none;
            -ms-user-select: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            font-family: 'Lexend', sans-serif;
        }

        html {
            /* overflow: hidden; */
        }

        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            min-width: 100vw;
            position: relative;
        }

        .login-container {
            box-shadow: 0 0 10px white;
            backdrop-filter: brightness(1.5);
            -webkit-backdrop-filter: brightness(2.2);
        }

        .swal2-confirm {
            background-color: rgba(45, 72, 56, 1);
        }

        .swal2-deny {
            background-color: rgb(98, 0, 0);
        }

        .button-interact {
            transition: .3s ease;
        }

        .button-interact:hover {
            box-shadow: 0 0 9px white;
        }

        .button-interact:active {
            box-shadow: none;
        }

        .title-text {
            text-shadow: 0 0 5px white;
        }
    </style>

</head>

<body class="gradient-container">
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
    <section class="w-screen flex justify-center items-center h-screen absolute">
        <div
            class="login-container bg-gray-800 bg-opacity-50 w-[550px] max-sm:w-[320px] p-8 flex flex-col items-center justify-center rounded-lg">
            <div class="flex flex-col items-center justify-center w-full p-7 max-sm:p-4">
                <h1
                    class="text-white drop-shadow-md font-bold text-5xl w-[500px] text-center max-sm:text-2xl uppercase max-sm:w-[300px]">
                    Admin Website
                </h1>
                <h1
                    class="text-gray-300 drop-shadow-md font-bold text-5xl w-[500px] text-center max-sm:text-2xl max-sm:w-[300px]">
                    BGKL
                </h1>
            </div>
            <a href="{{ route('admin.auth') }}"
                class="text-gray-200 border-2 border-gray-400 hover:border-white hover:text-white active:scale-[0.97] font-semibold text-2xl max-sm:text-base w-[400px] max-sm:w-[230px] rounded-3xl h-[53px] max-sm:h-[42px] flex justify-center items-center transition duration-300 ease-in-out">
                Sign In
            </a>

        </div>
    </section>
</body>
<script>
    function getRandomPercent() {
        return Math.floor(Math.random() * 101);
    }

    const container = document.querySelector('.gradient-container');
    const gradient = `
    radial-gradient(at ${getRandomPercent()}% ${getRandomPercent()}%, #1a1a1a 0px, transparent 50%),
    radial-gradient(at ${getRandomPercent()}% ${getRandomPercent()}%, #2e2e2e 0px, transparent 50%),
    radial-gradient(at ${getRandomPercent()}% ${getRandomPercent()}%, #444 0px, transparent 50%),
    radial-gradient(at ${getRandomPercent()}% ${getRandomPercent()}%, #333 0px, transparent 50%),
    radial-gradient(at ${getRandomPercent()}% ${getRandomPercent()}%, #000 0px, transparent 50%),
    radial-gradient(at ${getRandomPercent()}% ${getRandomPercent()}%, #222 0px, transparent 50%)
  `;

    container.style.background = gradient;
</script>
</html>
