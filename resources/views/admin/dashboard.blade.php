@extends('admin.layouts.app')

@section('title', 'Bolodewe Adventure | Dashboard')

@section('content')
<div class="container-fluid">

    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard Admin</h1>
        <span class="badge bg-success text-white fs-6 px-3 py-2 shadow-sm">
            <i class="fas fa-mountain me-2"></i> Bolodewe Adventure
        </span>
    </div>

    <div class="row">
        <!-- Total Barang -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Barang
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalBarang ?? 0 }}</div>
                    </div>
                    <i class="fas fa-box fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>

        <!-- Total Booking -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Booking
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalBooking ?? 0 }}</div>
                    </div>
                    <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>

        <!-- Booking Aktif -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Booking Aktif
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $bookingAktif ?? 0 }}</div>
                    </div>
                    <i class="fas fa-campground fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>

        <!-- Pengguna -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Pengguna Terdaftar
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalUser ?? 0 }}</div>
                    </div>
                    <i class="fas fa-users fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mt-4">
        <div class="card-header bg-success text-white">
            <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informasi Sistem</h6>
        </div>
        <div class="card-body">
            <p class="mb-1"><strong>Nama Sistem:</strong> Bolodewe Adventure Rental</p>
            <p class="mb-1"><strong>Deskripsi:</strong> Sistem manajemen penyewaan alat outdoor dan pendakian.</p>
            <p class="mb-0"><strong>Login Sebagai:</strong> <span class="text-success">{{ Auth::user()->name ?? 'Admin' }}</span></p>
        </div>
    </div>

</div>
@endsection
