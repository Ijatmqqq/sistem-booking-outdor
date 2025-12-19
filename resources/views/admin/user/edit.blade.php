@extends('admin.layouts.app')
@section('title','Edit User')

@section('content')
<div class="container-fluid">
    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Nama</label>
                <input type="text" name="name" value="{{ $user->name }}" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label>Email</label>
                <input type="email" name="email" value="{{ $user->email }}" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Password (kosongkan jika tidak diganti)</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label>Role</label>
                <select name="role" class="form-control">
                    <option value="admin" {{ $user->role=='admin' ? 'selected': '' }}>admin</option>
                    <option value="user"  {{ $user->role=='user' ? 'selected': '' }}>user</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label>Nama Lengkap</label>
            <input type="text" name="nama_lengkap" value="{{ $user->nama_lengkap }}" class="form-control">
        </div>
        <div class="mb-3">
            <label>Foto Profil</label>
            <input type="file" name="foto_profil" class="form-control" onchange="previewProfil()">
            @if ($user->foto_profil)
                <img id="imgPreview" src="{{ asset('storage/'.$user->foto_profil) }}" class="mt-2" width="120">
            @else
                <img id="imgPreview" class="mt-2" width="120" style="display:none;">
            @endif
        </div>
        <div class="mb-3">
            <label>NIK</label>
            <input type="text" name="nik" value="{{ $user->nik }}" class="form-control">
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control">{{ $user->alamat }}</textarea>
        </div>
        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_hp" value="{{ $user->no_hp }}" class="form-control">
        </div>
        <div class="mb-3">
            <label>Pekerjaan</label>
            <input type="text" name="pekerjaan" value="{{ $user->pekerjaan }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Foto KTP</label>
            <input type="file" name="foto_ktp" class="form-control" onchange="previewKtp()">
            @if ($user->foto_ktp)
                <img id="imgPreview" src="{{ asset('storage/'.$user->foto_ktp) }}" class="mt-2" width="120">
            @else
                <img id="imgPreview" class="mt-2" width="120" style="display:none;">
            @endif
        </div>

        <button class="btn btn-primary mb-2">Update</button>
    </form>
</div>

<script>
function previewKtp(){
    const input  = event.target;
    const imgTag = document.getElementById('imgPreview');
    if(input.files && input.files[0]){
        imgTag.src = URL.createObjectURL(input.files[0]);
        imgTag.style.display = 'block';
    }
}
function previewProfil(){
    const input  = event.target;
    const imgTag = document.getElementById('imgPreview');
    if(input.files && input.files[0]){
        imgTag.src = URL.createObjectURL(input.files[0]);
        imgTag.style.display = 'block';
    }
}
</script>
@endsection
