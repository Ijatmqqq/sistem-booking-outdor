@extends('user.layouts.app')

@section('title', 'Detail Booking')

@section('content')
<div class="container mt-4">
    <h3>📄 Detail Booking</h3>

    <div class="card mt-3">
        <div class="card-body">
            {{-- Gambar Barang --}}
            @if ($booking->barang && $booking->barang->foto)
                <div class="text-center mb-3">
                    <img src="{{ asset('storage/' . $booking->barang->foto) }}" 
                        alt="{{ $booking->barang->nama_barang }}" 
                        class="img-fluid rounded" 
                        style="max-height: 250px;">
                </div>
            @else
                <div class="text-center mb-3">
                    <img src="{{ asset('images/no-image.png') }}" 
                        alt="No Image" 
                        class="img-fluid rounded" 
                        style="max-height: 250px;">
                </div>
            @endif

            <h5 class="card-title">{{ $booking->barang->nama_barang ?? '-' }}</h5>
            <p class="card-text">
                <strong>Deskripsi:</strong> {{ $booking->barang->deskripsi ?? '-' }} <br>
                <strong>Tanggal Pinjam:</strong> {{ $booking->tanggal_pinjam }} <br>
                <strong>Tanggal Kembali:</strong> {{ $booking->tanggal_kembali }} <br>
                <strong>Jumlah:</strong> {{ $booking->jumlah }} <br>
                <strong>Total Harga:</strong> Rp {{ number_format($booking->total_harga, 0, ',', '.') }}
            </p>
            <a href="{{ route('user.myBooking') }}" class="btn btn-secondary">⬅ Kembali</a>
        </div>
    </div>

</div>
@endsection
