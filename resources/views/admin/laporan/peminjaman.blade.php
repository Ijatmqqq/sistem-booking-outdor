@extends('admin.layouts.app')
@section('title', 'Laporan Peminjaman')

@section('content')
<div class="container-fluid">
    <h4 class="mb-3">
        Laporan Peminjaman
        @if(request('query'))
            <small class="text-muted">— hasil untuk "{{ request('query') }}"</small>
        @endif
    </h4>

    {{-- Search Form --}}
    <form method="GET" action="{{ route('laporan.peminjaman') }}" class="mb-3">
        <div class="input-group" style="max-width: 500px;">
            <input type="text" name="query" class="form-control" 
                   placeholder="Cari nama, NIK, barang, status..." 
                   value="{{ request('query') }}">
            <button class="btn btn-primary" type="submit">
                <i class="fas fa-search"></i> Cari
            </button>
            @if(request('query'))
                <a href="{{ route('laporan.peminjaman') }}" class="btn btn-secondary">Reset</a>
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
            <th style="width: 150px;">Alamat</th>
            <th style="width: 100px;">No HP</th>
            <th style="width: 120px;">Barang</th>
            <th style="width: 100px;">Tanggal Pinjam</th>
            <th style="width: 100px;">Tanggal Kembali</th>
            <th style="width: 50px;">Jumlah</th>
            <th style="width: 100px;">Total Harga</th>
            <th style="width: 80px;">Status Bayar</th>
            <th style="width: 100px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="Keterangan">
                Keterangan
            </th>
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

            @forelse($bookings as $i => $b)
                <tr>
                    <td class="text-center">{{ $i+1 }}</td>
                    <td>{!! highlight($b->nama ?? ($b->user->nama_lengkap ?? $b->user->name ?? '-'), $query) !!}</td>
                    <td>{!! highlight($b->nik ?? '-', $query) !!}</td>
                    <td>{!! highlight($b->alamat ?? '-', $query) !!}</td>
                    <td>{!! highlight($b->no_hp ?? '-', $query) !!}</td>
                    <td>{!! highlight($b->barang->nama_barang ?? '-', $query) !!}</td>
                    <td>{{ $b->tanggal_pinjam }}</td>
                    <td>{{ $b->tanggal_kembali }}</td>
                    <td class="text-center">{{ $b->jumlah }}</td>
                    <td>Rp {{ number_format($b->total_harga,0,',','.') }}</td>

                    <td class="text-center">
                        @if($b->status_pembayaran === 'Lunas')
                            <span class="badge bg-success">Lunas</span>
                        @else
                            <span class="badge bg-danger">Belum Lunas</span>
                        @endif
                    </td>

                    <td style="max-width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" 
                        title="{{ $b->keterangan ?? '-' }}">
                        {{ $b->keterangan ?? '-' }}
                    </td>
                </tr>

                <!-- Modal Konfirmasi Bayar Sewa -->
                <div class="modal fade" id="konfirmasiModal{{ $b->id }}" tabindex="-1"
                     aria-labelledby="konfirmasiLabel{{ $b->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('booking.konfirmasi', $b->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title" id="konfirmasiLabel{{ $b->id }}">Konfirmasi Pembayaran</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Apakah Anda yakin ingin menandai pembayaran ini sebagai <b>LUNAS</b>?</p>
                                    <div class="mb-3">
                                        <label for="keterangan{{ $b->id }}" class="form-label">Keterangan (Opsional)</label>
                                        <textarea name="keterangan" id="keterangan{{ $b->id }}" class="form-control" rows="3"
                                                  placeholder="Contoh: Transfer BCA, sudah diterima oleh admin."></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-success">Konfirmasi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            @empty
                <tr>
                    <td colspan="13" class="text-center text-muted">Tidak ada data peminjaman aktif</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection