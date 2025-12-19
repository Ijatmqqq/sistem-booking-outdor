<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Bolodewe Adventure</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#!">Bolodewe Adventure</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="/userdashboard">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="/about">About</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Barang</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('user.barang.index') }}">Semua Barang</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><h9 class="nav-link">Kategori:</h9></li>
                                <li><a class="dropdown-item" href="{{ route('user.barang.kategori', 'Tenda') }}">Tenda</a></li>
                                <li><a class="dropdown-item" href="{{ route('user.barang.kategori', 'Tas') }}">Tas</a></li>
                                <li><a class="dropdown-item" href="{{ route('user.barang.kategori', 'Sepatu') }}">Sepatu</a></li>
                                <li><a class="dropdown-item" href="{{ route('user.barang.kategori', 'Pakaian') }}">Pakaian</a></li>
                                <li><a class="dropdown-item" href="{{ route('user.barang.kategori', 'Perlengkapan Tidur') }}">Perlengkapan Tidur</a></li>
                                <li><a class="dropdown-item" href="{{ route('user.barang.kategori', 'Peralatan Masak') }}">Peralatan Masak</a></li>
                            </ul>
                        </li>
                    </ul>
                    <!-- <form class="d-flex">
                        <button class="btn btn-outline-dark" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Cart
                            <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                        </button>
                    </form> -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">
                        Login
                    </button>

                    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" style="max-width: 420px;"> <!-- lebih kecil -->
                            <div class="modal-content border-0 shadow-lg rounded-4">
                                <div class="modal-body p-4">
                                    <div class="text-center mb-3">
                                        <h5 class="fw-bold text-gray-900 mb-1">Selamat Datang!</h5>
                                        <p class="text-muted small mb-0">Masuk ke akun Anda</p>
                                    </div>

                                    <form action="/login" method="POST">
                                        @csrf
                                        <div class="form-group mb-3">
                                            <input type="email" 
                                                class="form-control form-control-sm"
                                                name="email" 
                                                placeholder="Email" 
                                                required>
                                        </div>

                                        <div class="form-group mb-4">
                                            <input type="password" 
                                                class="form-control form-control-sm"
                                                name="password" 
                                                placeholder="Password" 
                                                required>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-sm w-100 py-2">
                                            Login
                                        </button>
                                    </form>

                                    <hr class="my-3">

                                    <div class="text-center">
                                        <a class="small text-decoration-none" href="/register">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-2 mx-4" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (session('eror'))
        <div class="alert alert-danger alert-dismissible fade show mt-2 mx-4" role="alert">
            {{ session('eror') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Bolodewe Adventure</h1>
                    <p class="lead fw-normal text-white-50 mb-0">"Karena setiap langkah menuju alam bebas dimulai dari persiapan yang matang. Dapatkan perlengkapan outdoor terbaik dari kami — mudah disewa, siap dipakai, dan mendukung petualanganmu hingga ke puncak."</p>
                </div>
            </div>
        </header>
        <!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            @foreach ($barang as $item)
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Product image -->
                        <img class="card-img-top" src="{{ asset('storage/' . $item->foto) }}" alt="">
                        <!-- Product details -->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name -->
                                <h5 class="fw-bolder">{{ $item->nama_barang }}</h5>
                                <!-- Product price -->
                                <p class="mb-1">Rp. {{ number_format($item->harga_per_hari) }}/Hari</p>
                                <!-- Product stock -->
                                <p class="text-muted">Stok: {{ $item->stok }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Bolodewe Adventure</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>