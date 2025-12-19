@extends('admin.layouts.app')
@section('title', 'Denda')

@section('content')
<div class="container mt-4">
    <h4>Proses Denda Booking</h4>

    <form action="{{ route('denda.update', $booking->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label>Tanggal Pengembalian</label>
            <input type="date" name="tanggal_pengembalian" value="{{ $booking->tanggal_pengembalian }}"
                class="form-control" required>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="kerusakan" id="kerusakan">
            <label class="form-check-label" for="kerusakan">
                Ada Kerusakan Barang
            </label>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('denda.index') }}" class="btn btn-secondary">Kembali</a>
    </form>

</div>
@endsection
