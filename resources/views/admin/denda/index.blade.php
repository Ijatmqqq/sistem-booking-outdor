@extends('admin.layouts.app')
@section('title', 'Denda')

@section('content')
<div class="container mt-4">
    <h4>Daftar Denda Booking</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered mt-3">
        <thead class="table-success text-center">
            <tr>
                <th>Nama</th>
                <th>Barang</th>
                <th>Tgl Kembali Batas</th>
                <th>Tgl Kembali Real</th>
                <th>Denda</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $query = request('query');
                function highlight($text, $query) {
                    if(!$query) return e($text);
                    return preg_replace("/(" . preg_quote($query, '/') . ")/i",
                        '<mark style="background-color:#fff3cd;">$1</mark>',
                        e($text));
                }
            @endphp
            @foreach($bookings as $booking)
            <tr>
                <td>{{ $booking->user->name ?? 'User' }}</td>
                <td>{!! highlight($booking->barang->nama_barang ?? '-', $query) !!}</td>
                <td>{{ $booking->tanggal_kembali }}</td>
                <td>{{ $booking->tanggal_pengembalian ?? '-' }}</td>
                <td>Rp {{ number_format($booking->denda ?? 0,0,',','.') }}</td>
                <td>
                    <a href="{{ route('denda.edit', $booking->id) }}" class="btn btn-primary btn-sm">
                        Proses Denda
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
