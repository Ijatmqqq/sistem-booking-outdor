@extends('admin.layouts.app')
@section('title', 'Laporan Sewa')

@section('content')
<div class="container-fluid">
    <h4 class="mb-3">Laporan Sewa</h4>

    <div class="card">
        <div class="card-body table-responsive">

            <div class="mb-3">
                <strong>Total Pendapatan:</strong> 
                <span class="text-success">Rp {{ number_format($totalPendapatan) }}</span>
            </div>

            <table class="table table-bordered table-striped">
                <thead class="table-success text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Penyewa</th>
                        <th>Barang</th>
                        <th>Tgl Sewa</th>
                        <th>Tgl Kembali</th>
                        <th>Status</th>
                        <th>Total Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $row)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $row->nama_penyewa }}</td>
                        <td>{{ $row->nama_barang }}</td>
                        <td>{{ $row->tanggal_sewa }}</td>
                        <td>{{ $row->tanggal_kembali }}</td>
                        <td class="text-center">
                            <span class="badge bg-info">{{ $row->status }}</span>
                        </td>
                        <td>Rp {{ number_format($row->total_harga) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Data sewa belum ada</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection
