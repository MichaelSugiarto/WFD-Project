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
                            swalModal.style.zIndex = '99999';  // Set higher z-index for Swal
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
                            swalModal.style.zIndex = '99999';  // Set higher z-index for Swal
                        }
        });
    </script>
@endif
<style>
    .font-monterchi {
        font-family: 'Monterchi', serif;
    }

    .font-cinzel {
        font-family: 'Cinzel Decorative', serif;
    }

    .font-cormorant {
        font-family: 'Cormorant Garamond', serif;
    }
</style>

<div class="">
    
</div>