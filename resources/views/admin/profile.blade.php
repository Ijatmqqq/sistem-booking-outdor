@extends('admin.layouts.app')
@section('title', 'Profil Admin')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="mb-0">Profil Admin</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 text-center">
                    @if ($user->foto_profil)
                        <img src="{{ asset('storage/'.$user->foto_profil) }}" class="img-fluid rounded" alt="Foto">
                    @else
                        <img src="{{ asset('images/default-avatar.png') }}" class="img-fluid rounded" alt="Foto">
                    @endif
                </div>
                <div class="col-md-9">
                    <table class="table table-borderless">
                        <tr>
                            <th>Nama</th><td>: {{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>Nama Lengkap</th><td>: {{ $user->nama_lengkap }}</td>
                        </tr>
                        <tr>
                            <th>Email</th><td>: {{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>NIK</th><td>: {{ $user->nik }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th><td>: {{ $user->alamat }}</td>
                        </tr>
                        <tr>
                            <th>No HP</th><td>: {{ $user->no_hp }}</td>
                        </tr>
                        <tr>
                            <th>Pekerjaan</th><td>: {{ $user->pekerjaan }}</td>
                        </tr>
                        <tr>
                            <th>Role</th><td>: {{ $user->role }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
