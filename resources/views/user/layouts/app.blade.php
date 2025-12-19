<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>RentTrail - Sistem Booking Alat Outdoor</title>

        <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
    </head>
    <body>

        @include('user.partials.navbar')
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Bolodewe Adventure</h1>
                    <p class="lead fw-normal text-white-50 mb-0">"Karena setiap langkah menuju alam bebas dimulai dari persiapan yang matang. Dapatkan perlengkapan outdoor terbaik dari kami — mudah disewa, siap dipakai, dan mendukung petualanganmu hingga ke puncak."</p>
                </div>
            </div>
        </header>

        <div class="container-fluid">
            @yield('content')
        </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>

    </body>
</html>