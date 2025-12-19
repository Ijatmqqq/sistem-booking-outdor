@extends('user.layouts.app')

@section('title', 'RentTrail')

@section('content')
<div class="container py-4">

    {{-- Alert pesan sukses/error --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
        @foreach ($barang as $item)
            <div class="col mb-5">
                <div class="card h-100 shadow-sm">
                    <img class="card-img-top" src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama_barang }}">

                    <div class="card-body p-4">
                        <div class="text-center">
                            <h5 class="fw-bold">{{ $item->nama_barang }}</h5>
                            <p class="mb-1 text-muted">{{ $item->kategori_barang }}</p>
                            <p class="mb-1">Rp {{ number_format($item->harga_per_hari) }}/Hari</p>
                            <p class="text-muted">Stok: <span id="stok-{{ $item->id }}">{{ $item->stok }}</span></p>
                        </div>
                    </div>

                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent text-center">
                        @if ($item->stok > 0)
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#bookingModal{{ $item->id }}">
                                Booking
                            </button>
                        @else
                            <button class="btn btn-secondary" disabled>Stok Habis</button>
                        @endif
                    </div>
                </div>
            </div>

            <div class="modal fade" id="bookingModal{{ $item->id }}" tabindex="-1" aria-labelledby="bookingLabel{{ $item->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('booking.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="barang_id" value="{{ $item->id }}">

                            <div class="modal-header bg-success text-white">
                                <h5 class="modal-title" id="bookingLabel{{ $item->id }}">Booking {{ $item->nama_barang }}</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="tanggal_pinjam{{ $item->id }}" class="form-label">Tanggal Pinjam</label>
                                    <input type="date"
                                        name="tanggal_pinjam"
                                        id="tanggal_pinjam{{ $item->id }}"
                                        class="form-control"
                                        required
                                        min="{{ \Carbon\Carbon::tomorrow()->format('Y-m-d') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="tanggal_kembali{{ $item->id }}" class="form-label">Tanggal Kembali</label>
                                    <input type="date"
                                        name="tanggal_kembali"
                                        id="tanggal_kembali{{ $item->id }}"
                                        class="form-control"
                                        required
                                        min="{{ \Carbon\Carbon::tomorrow()->format('Y-m-d') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="jumlah{{ $item->id }}" class="form-label">Jumlah</label>
                                    <input type="number"
                                        name="jumlah"
                                        id="jumlah{{ $item->id }}"
                                        class="form-control"
                                        min="1"
                                        max="{{ $item->stok }}"
                                        value="1"
                                        required>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                @if ($item->stok > 0)
                                    <button type="submit" class="btn btn-success">Booking</button>
                                @else
                                    <button class="btn btn-secondary" disabled>Stok Habis</button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Modal -->
        @endforeach
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @foreach ($barang as $item)
            const pinjam{{ $item->id }} = document.getElementById('tanggal_pinjam{{ $item->id }}');
            const kembali{{ $item->id }} = document.getElementById('tanggal_kembali{{ $item->id }}');

            if(pinjam{{ $item->id }} && kembali{{ $item->id }}) {
                pinjam{{ $item->id }}.addEventListener('change', function() {
                    kembali{{ $item->id }}.min = this.value;
                    if(kembali{{ $item->id }}.value < this.value) {
                        kembali{{ $item->id }}.value = this.value;
                    }
                });
            }
        @endforeach
    });
</script>
@endsection

