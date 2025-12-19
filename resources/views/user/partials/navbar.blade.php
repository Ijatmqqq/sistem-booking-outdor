
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#!">RentTrail</a>
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
                    <a href="{{ route('user.myBooking') }}" class="btn btn-outline-dark d-flex align-items-center">
                        <i class="bi bi-cart-fill me-1"></i>
                        Booking Saya
                        @if(isset($bookingsCount) && $bookingsCount > 0)
                            <span class="badge bg-dark text-white ms-1 rounded-pill">{{ $bookingsCount }}</span>
                        @endif
                    </a>

                    <button type="button" class="btn btn-danger ms-4" data-bs-toggle="modal" data-bs-target="#logoutModal">
                        Logout
                    </button>
                    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title" id="logoutModalLabel">Ready to Leave?</h5>
                                <button class="btn-close btn-close-white" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Select "Logout" below if you are ready to end your current session.
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>

                                <form action="/logout" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">Logout</button>
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>