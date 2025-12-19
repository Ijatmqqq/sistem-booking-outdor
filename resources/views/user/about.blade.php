@extends('user.layouts.app')

@section('title', 'RentTrail')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-body">
            <h2 class="text-center text-primary">Tentang RentTrail</h2>
            <hr>

            <p class="lead text-muted">
                <strong>RentTrail</strong> adalah sistem peminjaman perlengkapan outdoor yang 
                dirancang untuk memudahkan pengguna dalam melakukan booking, pembayaran, 
                hingga mendapatkan struk transaksi secara cepat dan transparan.
            </p>

            <h5 class="mt-4">Visi & Misi</h5>
            <ul>
                <li>Meningkatkan akses kemudahan penyewaan perlengkapan outdoor.</li>
                <li>Mendukung sistem pembayaran modern dengan QRIS.</li>
                <li>Menyediakan layanan cepat, aman, dan terintegrasi.</li>
            </ul>

            <h5 class="mt-4">Fitur Utama</h5>
            <ol>
                <li>Pemesanan perlengkapan secara online.</li>
                <li>Pembayaran otomatis via QRIS dinamis.</li>
                <li>Nota digital dalam bentuk PDF.</li>
                <li>Manajemen stok barang yang transparan.</li>
            </ol>

            <h5 class="mt-4">Kontak</h5>
            <p>
                📍 Jl. Outdoor Adventure No. 99<br>
                📞 0812-3456-7890<br>
                ✉️ support@renttrail.com
            </p>

            <div class="text-center mt-4">
                <a href="/" class="btn btn-primary">Kembali ke Home</a>
            </div>
        </div>
    </div>
</div>
@endsection
