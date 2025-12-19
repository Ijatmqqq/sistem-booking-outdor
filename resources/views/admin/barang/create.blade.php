@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="container">
        <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label>Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control">
            </div>
            <div class="mb-3">
                <label>Kategori Barang</label>
                <select name="kategori_barang" class="form-control">
                    <optgroup label="Kelompok">
                        <option value="Tenda" {{ (isset($barang) && $barang->kategori_barang=='Tenda') ? 'selected' : '' }}>Tenda</option>
                        <option value="Flysheet" {{ (isset($barang) && $barang->kategori_barang=='Flysheet') ? 'selected' : '' }}>Flysheet</option>
                        <option value="Cooking Set" {{ (isset($barang) && $barang->kategori_barang=='Cooking Set') ? 'selected' : '' }}>Cooking Set</option>
                        <option value="Kompor" {{ (isset($barang) && $barang->kategori_barang=='Kompor') ? 'selected' : '' }}>Kompor</option>
                        <option value="Meja" {{ (isset($barang) && $barang->kategori_barang=='Meja') ? 'selected' : '' }}>Meja</option>
                        <option value="Kursi" {{ (isset($barang) && $barang->kategori_barang=='Kursi') ? 'selected' : '' }}>Kursi</option>
                    </optgroup>

                    <optgroup label="Individu">
                        <option value="Sepatu" {{ (isset($barang) && $barang->kategori_barang=='Sepatu') ? 'selected' : '' }}>Sepatu</option>
                        <option value="Carrier" {{ (isset($barang) && $barang->kategori_barang=='Carrier') ? 'selected' : '' }}>Carrier</option>
                        <option value="Jaket" {{ (isset($barang) && $barang->kategori_barang=='Jaket') ? 'selected' : '' }}>Jaket</option>
                        <option value="Matras" {{ (isset($barang) && $barang->kategori_barang=='Matras') ? 'selected' : '' }}>Matras</option>
                        <option value="Sleeping Bag" {{ (isset($barang) && $barang->kategori_barang=='Sleeping Bag') ? 'selected' : '' }}>Sleeping Bag</option>
                        <option value="Topi" {{ (isset($barang) && $barang->kategori_barang=='Topi') ? 'selected' : '' }}>Topi</option>
                        <option value="Lampu" {{ (isset($barang) && $barang->kategori_barang=='Lampu') ? 'selected' : '' }}>Lampu</option>
                        <option value="Kaos Tangan" {{ (isset($barang) && $barang->kategori_barang=='Kaos Tangan') ? 'selected' : '' }}>Kaos Tangan</option>
                        <option value="Powerbank" {{ (isset($barang) && $barang->kategori_barang=='Powerbank') ? 'selected' : '' }}>Powerbank</option>
                        <option value="Hammock" {{ (isset($barang) && $barang->kategori_barang=='Hammock') ? 'selected' : '' }}>Hammock</option>
                        <option value="Tracking Pole" {{ (isset($barang) && $barang->kategori_barang=='Tracking Pole') ? 'selected' : '' }}>Tracking Pole</option>
                    </optgroup>
                </select>
            </div>
            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label>Stok</label>
                <input type="number" name="stok" class="form-control">
            </div>
            <div class="mb-3">
                <label>Harga Per Hari</label>
                <input type="number" step="0.01" name="harga_per_hari" class="form-control">
            </div>
            <div class="mb-3">
                <label>Foto</label>
                <input type="file" name="foto" id="foto" class="form-control" onchange="previewImage()">
                <img id="imgPreview" class="mt-2" width="120" style="display:none;">
            </div>
            <button class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection
