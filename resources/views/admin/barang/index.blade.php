@extends('admin.layouts.app')

@section('title', 'RentTrail')

@section('content')
<div class="container-fluid">
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead class="table-primary text-center">
                <tr>
                    <th class="align-middle">No</th>
                    <th class="align-middle">Nama</th>
                    <th class="align-middle">Kategori</th>
                    <th class="align-middle">Stok</th>
                    <th class="align-middle">Harga per Hari</th>
                    <th class="align-middle">Foto</th>
                    <th class="align-middle">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barangs as $item)
                <tr class="text-center">
                    <td class="align-middle">{{ $loop->iteration }}</td>
                    <td class="align-middle">{{ $item->nama_barang }}</td>
                    <td class="align-middle">{{ $item->kategori_barang }}</td>
                    <td class="align-middle">{{ $item->stok }}</td>
                    <td class="align-middle">Rp {{ number_format($item->harga_per_hari, 0, ',', '.') }},-</td>
                    <td class="align-middle">
                        <img src="{{ asset('storage/' . $item->foto) }}" width="60" alt="foto">
                    </td>
                    <td class="align-middle">
                        <a href="{{ route('barang.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('barang.destroy', $item->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Hapus data ini?')" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
@endsection
