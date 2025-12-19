@extends('admin.layouts.app')
@section('title', 'Booking')

@section('content')
<div class="container-fluid">
    <h4 class="mb-3">
        Booking
        @if(request('query'))
            <small class="text-muted">— hasil untuk "{{ request('query') }}"</small>
        @endif
    </h4>

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
            <th style="width: 100px;">Total Denda</th>
            <th style="width: 80px;">Status </th>
            <th style="width: 100px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="Keterangan">
                Keterangan
            </th>
            <th style="width: 120px;">Aksi</th>
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
                    <td>{!! highlight($b->nama ?? $b->user->name, $query) !!}</td>
                    <td>{!! highlight($b->nik ?? '-', $query) !!}</td>
                    <td>{!! highlight($b->alamat ?? '-', $query) !!}</td>
                    <td>{!! highlight($b->no_hp ?? '-', $query) !!}</td>
                    <td>{!! highlight($b->barang->nama_barang ?? '-', $query) !!}</td>
                    <td>{{ $b->tanggal_pinjam }}</td>
                    <td>{{ $b->tanggal_kembali }}</td>
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
    {{-- Status Pengembalian --}}
    @if($b->tanggal_pengembalian)
    <span class="badge bg-primary">Dikembalikan</span>
@else
    <span class="badge bg-secondary">Belum Dikembalikan</span>
@endif


    <br>

    {{-- Status Pembayaran --}}
    @if($b->status_pembayaran === 'Lunas')
        <span class="badge bg-success">Lunas</span>
    @else
        <span class="badge bg-danger">Belum Bayar</span>
    @endif
</td>


                    <td style="max-width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" 
                        title="{{ $b->keterangan ?? '-' }}">
                        {{ $b->keterangan ?? '-' }}
                    </td>
                    <td class="text-center">

    {{-- Tombol Bayar --}}
    @if($b->status_pembayaran !== 'Lunas')
        <button class="btn btn-success btn-sm mb-1"
            data-bs-toggle="modal"
            data-bs-target="#konfirmasiModal{{ $b->id }}">
            Bayar
        </button>
    @endif

    {{-- Tombol Kembalikan --}}
    @if($b->status !== 'Kembali')
        <form action="{{ route('booking.konfirmasiDenda', $b->id) }}"
              method="POST" class="d-inline">
            @csrf
            @method('PUT')
            <button type="submit"
                class="btn btn-warning btn-sm"
                onclick="return confirm('Yakin barang sudah dikembalikan?')">
                Kembalikan
            </button>
        </form>
    @endif

</td>



                </tr>

                <!-- Modal Konfirmasi -->
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
                <!-- Modal Denda -->
                <div class="modal fade" id="dendaModal{{ $b->id }}" tabindex="-1"
                    aria-labelledby="dendaLabel{{ $b->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('denda.update', $b->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title" id="dendaLabel{{ $b->id }}">Proses Denda</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    <p class="mb-2">
                                        Jika denda ditambahkan, maka <b>total harga akan otomatis bertambah</b>
                                        dan <b>Status Pembayaran berubah menjadi "Belum"</b> sampai semua biaya diselesaikan.
                                    </p>

                                    <div class="alert alert-info py-2">
                                        Total harga saat ini: <b>Rp {{ number_format($b->total_harga, 0, ',', '.') }}</b>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Nominal Denda (Rp)</label>
                                        <input type="number" class="form-control" name="denda" min="0"
                                            value="{{ $b->denda ?? 0 }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Keterangan</label>
                                        <textarea name="keterangan_denda" class="form-control"
                                                placeholder="Contoh: Telat 2 hari atau kerusakan ringan"
                                                rows="3"></textarea>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-warning">Simpan Denda</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            @empty
                <tr>
                    <td colspan="13" class="text-center text-muted">Tidak ada data ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-denda').forEach(btn => {
        btn.addEventListener('click', function (event) {
            event.preventDefault(); // hentikan dulu

            let link = this.getAttribute('href');

            Swal.fire({
                title: "Konfirmasi Pembayaran",
                text: "Apakah Anda yakin ingin memproses pembayaran dan denda?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, proses!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = link; // lanjutkan
                }
            });
        });
    });
});
</script>
@endsection

