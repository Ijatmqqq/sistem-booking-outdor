<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Bukti Booking</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 6px; }
        th { background: #f2f2f2; }
        .text-center { text-align: center; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">BUKTI BOOKING SEWA</h2>

    <table>
        <tr>
            <th>Nama Penyewa</th>
            <td>{{ $booking->nama ?? $booking->user->name }}</td>
        </tr>
        <tr>
            <th>NIK</th>
            <td>{{ $booking->nik }}</td>
        </tr>
        <tr>
            <th>No HP</th>
            <td>{{ $booking->no_hp }}</td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td>{{ $booking->alamat }}</td>
        </tr>
        <tr>
            <th>Nama Barang</th>
            <td>{{ $booking->barang->nama_barang }}</td>
        </tr>
        <tr>
            <th>Tanggal Pinjam</th>
            <td>{{ $booking->tanggal_pinjam }}</td>
        </tr>
        <tr>
            <th>Tanggal Kembali</th>
            <td>{{ $booking->tanggal_kembali }}</td>
        </tr>
        <tr>
            <th>Jumlah</th>
            <td>{{ $booking->jumlah }}</td>
        </tr>
        <tr>
            <th>Total Harga</th>
            <td>Rp {{ number_format($booking->total_harga,0,',','.') }}</td>
        </tr>
        @if($booking->denda > 0)
        <tr>
            <th>Denda</th>
            <td>Rp {{ number_format($booking->denda,0,',','.') }}</td>
        </tr>
        @endif
        <tr>
            <th>Status Pembayaran</th>
            <td>{{ $booking->status_pembayaran }}</td>
        </tr>
    </table>

    <p style="margin-top:30px;">
        Dicetak pada: {{ now()->format('d-m-Y H:i') }}
    </p>
</body>
</html>
