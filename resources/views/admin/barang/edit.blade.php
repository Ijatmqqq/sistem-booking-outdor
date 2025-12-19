@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="container">
        <form action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="mb-3">
                <label>Kategori Barang</label>
                <select name="kategori_barang" class="form-control">
                    <option value="Tenda" {{ $barang->kategori_barang == 'Tenda' ? 'selected' : '' }}>Tenda</option>
                    <option value="Tas" {{ $barang->kategori_barang == 'Tas' ? 'selected' : '' }}>Tas</option>
                    <option value="Perlengkapan Tidur" {{ $barang->kategori_barang == 'Perlengkapan Tidur' ? 'selected' : '' }}>Perlengkapan Tidur</option>
                    <option value="Peralatan Masak" {{ $barang->kategori_barang == 'Peralatan Masak' ? 'selected' : '' }}>Peralatan Masak</option>
                    <option value="Pakaian" {{ $barang->kategori_barang == 'Pakaian' ? 'selected' : '' }}>Pakaian</option>
                    <option value="Sepatu" {{ $barang->kategori_barang == 'Sepatu' ? 'selected' : '' }}>Sepatu</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control" value="{{ $barang->nama_barang }}">
            </div>

            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control">{{ $barang->deskripsi }}</textarea>
            </div>

            <div class="mb-3">
                <label>Stok</label>
                <input type="number" name="stok" class="form-control" value="{{ $barang->stok }}">
            </div>

            <div class="mb-3">
                <label>Harga Per Hari</label>
                <input type="number" step="0.01" name="harga_per_hari" class="form-control" value="{{ $barang->harga_per_hari }}">
            </div>

            <div class="mb-3">
                <label>Foto (Opsional)</label>
                <input type="file" name="foto" class="form-control">
            </div>

            <button class="btn btn-primary">Update</button>
        </form>

    </div>
</div>
@endsection
