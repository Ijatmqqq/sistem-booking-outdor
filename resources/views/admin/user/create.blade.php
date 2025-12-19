@extends('admin.layouts.app')
@section('title','Tambah User')

@section('content')
<div class="container-fluid">
    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Nama</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label>Role</label>
                <select name="role" class="form-control">
                    <option value="admin">admin</option>
                    <option value="user">user</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label>Nama Lengkap</label>
            <input type="text" name="nama_lengkap" class="form-control">
        </div>
        <div class="mb-3">
            <label>NIK</label>
            <input type="text" name="nik" class="form-control">
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control">
        </div>
        <div class="mb-3">
            <label>Pekerjaan</label>
            <input type="text" name="pekerjaan" class="form-control">
        </div>
        <div class="mb-3">
            <label>Foto KTP</label>
            <input type="file" name="foto_ktp" id="fotoKtp" class="form-control" onchange="previewKtp()">
            <img id="ktpPreview" class="mt-2" width="130" style="display:none;">
        </div>
        <div class="mb-3">
            <label>Foto Profil</label>
            <input type="file" name="foto_Profil" id="fotoProfil" class="form-control" onchange="previewProfil()">
            <img id="profilPreview" class="mt-2" width="130" style="display:none;">
        </div>

        <button class="btn btn-primary mb-2">Simpan</button>
    </form>
</div>

<script>
function previewKtp(){
    const input = document.getElementById('fotoKtp');
    const img   = document.getElementById('ktpPreview');
    if (input.files && input.files[0]) {
        img.src = URL.createObjectURL(input.files[0]);
        img.style.display = 'block';
    }
}
function previewProfil(){
    const input = document.getElementById('fotoProfil');
    const img   = document.getElementById('profilPreview');
    if (input.files && input.files[0]) {
        img.src = URL.createObjectURL(input.files[0]);
        img.style.display = 'block';
    }
}
</script>

@endsection
