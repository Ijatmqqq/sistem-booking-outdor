@extends('admin.layouts.app')
@section('title', 'Laporan Pengembalian')

@section('content')
<div class="container-fluid">
    <h4 class="mb-3">
        Laporan Pengembalian
        @if(request('query'))
            <small class="text-muted">— hasil untuk "{{ request('query') }}"</small>
        @endif
    </h4>

    {{-- Search Form --}}
    <form method="GET" action="{{ route('laporan.pengembalian') }}" class="mb-3">
        <div class="input-group" style="max-width: 500px;">
            <input type="text" name="query" class="form-control" 
                   placeholder="Cari nama, NIK, barang..." 
                   value="{{ request('query') }}">
            <button class="btn btn-primary" type="submit">
                <i class="fas fa-search"></i> Cari
            </button>
            @if(request('query'))
                <a href="{{ route('laporan.pengembalian') }}" class="btn btn-secondary">Reset</a>
            @endif
        </div>
    </form>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <table class="table table-bordered table-striped" style="font-size: 14px;">
        <thead class="table-success text-center">
            <th style="width: 30px;">No</th>
            <th style="width: 120px;">Nama User</th>
            <th style="width: 100px;">NIK</th>
            <th style="width: 100px;">No HP</th>
            <th style="width: 120px;">Barang</th>
            <th style="width: 100px;">Tanggal Pinjam</th>
            <th style="width: 100px;">Tanggal Kembali</th>
            <th style="width: 100px;">Tgl Pengembalian</th>
            <th style="width: 50px;">Jumlah</th>
            <th style="width: 100px;">Total Harga</th>
            <th style="width: 100px;">Total Denda</th>
            <th style="width: 80px;">Status Bayar</th>
        </thead>
        <tbody>
            @php
                $query = request('query');
                function highlightText($text, $query) {
                    if(!$query) return e($text);
                    return preg_replace("/(" . preg_quote($query, '/') . ")/i",
                        '<mark style="background-color:#fff3cd;">$1</mark>',
                        e($text));
                }
            @endphp

            @forelse($bookings as $i => $b)
                <tr>
                    <td class="text-center">{{ $i+1 }}</td>
                    <td>{!! highlightText($b->nama ?? ($b->user->nama_lengkap ?? $b->user->name ?? '-'), $query) !!}</td>
                    <td>{!! highlightText($b->nik ?? '-', $query) !!}</td>
                    <td>{!! highlightText($b->no_hp ?? '-', $query) !!}</td>
                    <td>{!! highlightText($b->barang->nama_barang ?? '-', $query) !!}</td>
                    <td>{{ $b->tanggal_pinjam }}</td>
                    <td>{{ $b->tanggal_kembali }}</td>
                    <td class="text-center">
                        @if($b->tanggal_pengembalian)
                            {{ \Carbon\Carbon::parse($b->tanggal_pengembalian)->format('d/m/Y') }}
                            @php
                                $pinjam = \Carbon\Carbon::parse($b->tanggal_kembali);
                                $kembali = \Carbon\Carbon::parse($b->tanggal_pengembalian);
                                $selisih = $pinjam->diffInDays($kembali, false);
                            @endphp
                            @if($selisih < 0)
                                <br><small class="text-success">(Tepat Waktu)</small>
                            @elseif($selisih > 0)
                                <br><small class="text-danger">(Telat {{ $selisih }} hari)</small>
                            @endif
                        @else
                            -
                        @endif
                    </td>
                    <td class="text-center">{{ $b->jumlah }}</td>
                    <td>Rp {{ number_format($b->total_harga,0,',','.') }}</td>
                    <td>
                        @if($b->denda > 0)
                            Rp {{ number_format($b->denda,0,',','.') }}

                            @if($b->status_denda === 'Belum')
                                <span class="badge bg-warning text-dark"></span>
                            @else
                                <span class="badge bg-success">Lunas</span>
                            @endif
                        @else
                            -
                        @endif
                    </td>

                    <td class="text-center">
                        @if($b->status_pembayaran === 'Lunas')
                            <span class="badge bg-success">Lunas</span>
                        @else
                            <span class="badge bg-danger">Belum Lunas</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="13" class="text-center text-muted">Tidak ada data pengembalian</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection