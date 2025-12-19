@extends('admin.layouts.app')
@section('title', 'Data User')

@section('content')
<div class="container-fluid">

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h4 class="mb-3">
        Data User
        @if(request('query'))
            <small class="text-muted">— hasil untuk "{{ request('query') }}"</small>
        @endif
    </h4>

    <table class="table table-bordered">
        <thead class="table-primary text-center">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Nama Lengkap</th>
            <th>NIK</th>
            <th>No HP</th>
            <th>Pekerjaan</th>
            <th>Foto KTP</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        @forelse($users as $u)
            @php
                $query = request('query');

                if (!function_exists('highlight')) {
                    function highlight($text, $query) {
                        if (!$query) return e($text);

                        return preg_replace(
                            "/" . preg_quote($query, '/') . "/i",
                            '<mark style="background-color:#fff3cd;">$0</mark>',
                            e($text)
                        );
                    }
                }
            @endphp
            <tr class="text-center">
                <td>{{ $loop->iteration }}</td>
                <td>{!! highlight($u->name, $query) !!}</td>
                <td>{!! highlight($u->email, $query) !!}</td>
                <td>{!! highlight($u->nama_lengkap, $query) !!}</td>
                <td>{!! highlight($u->nik, $query) !!}</td>
                <td>{!! highlight($u->no_hp, $query) !!}</td>
                <td>{!! highlight($u->pekerjaan, $query) !!}</td>
                <td>
                    @if($u->foto_ktp)
                        <img src="{{ asset('storage/'.$u->foto_ktp) }}" width="70" alt="Foto KTP">
                    @else
                        -
                    @endif
                </td>
                <td>{!! highlight($u->role, $query) !!}</td>
                <td>
                    <a href="{{ route('users.edit', $u->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('users.destroy', $u->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus user ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="10" class="text-center text-muted">Tidak ada data ditemukan.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection

