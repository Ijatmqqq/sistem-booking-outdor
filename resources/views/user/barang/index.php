@extends('user.layouts.app')

@section('title', 'RentTrail')

@section('content')
<div class="container mt-4">
    <h3>
        @isset($kategori)
            Barang Kategori: {{ $kategori }}
        @else
            Semua Barang
        @endisset
    </h3>
    <hr>

    <div class="row">
        @forelse($barangs as $barang)
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5>{{ $barang->nama_barang }}</h5>
                        <p>Harga: Rp {{ number_format($barang->harga_per_hari,0,',','.') }}/hari</p>
                        <p>Stok: {{ $barang->stok }}</p>
                    </div>
                </div>
            </div>
        @empty
            <p>Tidak ada barang di kategori ini.</p>
        @endforelse
    </div>
</div>
@endsection
