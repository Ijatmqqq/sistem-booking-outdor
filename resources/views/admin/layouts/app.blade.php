<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>RentTrail - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

</head>


<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('admin.partials.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form id="admin-search-form"
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
                        style="position: relative;">
                        <div class="input-group">
                            
                            <input type="text" id="admin-search-input"
                                class="form-control bg-light border-0 small"
                                placeholder="Cari di seluruh sistem..."
                                aria-label="Search">

                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>

                        <div id="admin-search-results"
                            class="bg-white border rounded shadow w-100"
                            style="position: absolute; top: 100%; left: 0; z-index: 1050;
                                display:none; max-height: 300px; overflow-y: auto;">
                        </div>
                    </form>


               
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('img/undraw_profile.svg') }}">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="/admin/profile">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- End of Footer -->

        </div>

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="/">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(){
            const fileInput = document.getElementById('foto');
            const image = document.getElementById('imgPreview');

            if(fileInput.files && fileInput.files[0]){
                image.src = URL.createObjectURL(fileInput.files[0]);
                image.style.display = 'block';
            }
        }
    </script>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <script src="{{ asset('js/sb-admin-2.js') }}"></script>

    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

    <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('admin-search-input');
    const results = document.getElementById('admin-search-results');

    input.addEventListener('keyup', function() {
        const query = this.value.trim();

        if (query.length < 2) {
            results.style.display = 'none';
            results.innerHTML = '';
            return;
        }

        fetch(`/admin/live-search?query=${encodeURIComponent(query)}`)
            .then(res => res.json())
            .then(data => {
                let html = '';
                const highlight = (text) => {
                    const pattern = new RegExp(`(${query})`, 'gi');
                    return text.replace(pattern, '<mark style="background-color:#fff3cd;">$1</mark>');
                };

                if (!data.users.length && !data.barangs.length && !data.bookings.length) {
                    html = `<p class="p-2 text-muted text-center mb-0">Tidak ada hasil</p>`;
                } else {
                    if (data.users.length) {
                        html += `<div class="border-bottom p-2 fw-bold bg-light">👤 User</div>`;
                        data.users.forEach(u => {
                            html += `<div class="p-2 border-bottom">
                                <a href="/users?query=${encodeURIComponent(query)}" 
                                   class="text-dark text-decoration-none d-block">
                                   ${highlight(u.name)}
                                </a>
                            </div>`;
                        });
                    }
                    if (data.barangs.length) {
                        html += `<div class="border-bottom p-2 fw-bold bg-light">📦 Barang</div>`;
                        data.barangs.forEach(b => {
                            html += `<div class="p-2 border-bottom">
                                <a href="/barang?query=${encodeURIComponent(query)}" 
                                   class="text-dark text-decoration-none d-block">
                                   ${highlight(b.nama_barang)}
                                </a>
                            </div>`;
                        });
                    }
                    if (data.bookings.length) {
                        html += `<div class="border-bottom p-2 fw-bold bg-light">🧾 Booking</div>`;
                        data.bookings.forEach(bk => {
                            const userName = bk.user?.nama_lengkap || bk.user?.name || 'Tanpa Nama';
                            const userPhone = bk.user?.no_hp || '-';
                            const barangName = bk.barang?.nama_barang || '-';

                            html += `<div class="p-2 border-bottom">
                                <a href="/laporanbooking?query=${encodeURIComponent(query)}"
                                class="text-dark text-decoration-none d-block">
                                ${highlight(userName)} (${highlight(userPhone)}) - ${highlight(barangName)}
                                </a>
                            </div>`;
                        });
                    }
                }

                results.innerHTML = html;
                results.style.display = 'block';
            });
    });

    document.addEventListener('click', (e) => {
        if (!results.contains(e.target) && e.target !== input) {
            results.style.display = 'none';
        }
    });

});
</script>



</body>

</html>