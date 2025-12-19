<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Booking - RentTrail</title>
    <style>
        body {
            font-family: monospace, sans-serif;
            font-size: 10px;
            width: 200px; /* agar muat di 80mm roll */
            margin: auto;
        }
        .header, .footer { text-align: center; }
        .header h2 { margin: 0; font-size: 12px; }
        .line { border-top: 1px dashed #000; margin: 5px 0; }
        table { width: 100%; border-collapse: collapse; margin: 5px 0; }
        th, td { padding: 2px; text-align: left; font-size: 10px; }
        th { border-bottom: 1px dashed #000; }
        .right { text-align: right; }
        .total { font-weight: bold; border-top: 1px dashed #000; margin-top: 5px; padding-top: 5px; }
        .status { margin: 6px 0; text-align: center; font-size: 10px; }
        .qris { text-align: center; margin-top: 5px; }
        .qris svg { width: 100px; height: 100px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>RentTrail</h2>
        <small>📍 Jl. Outdoor Adventure No. 99</small><br>
        <small>Telp: 0812-3456-7890</small>
    </div>

    <div class="line"></div>

    <p><strong>Struk Booking</strong></p>
    <p>Tanggal Cetak: {{ now()->format('d/m/Y H:i') }}</p>

    <div class="line"></div>

    <table>
        <thead>
            <tr>
                <th>Barang</th>
                <th class="right">Jml</th>
                <th class="right">Harga</th>
            </tr>
        </thead>
        <tbody>
            @php $grandTotal = 0; $status = 'Belum Dibayar'; @endphp
            @foreach ($bookings as $booking)
                <tr>
                    <td>{{ $booking->barang->nama_barang ?? '-' }}</td>
                    <td class="right">{{ $booking->jumlah }}</td>
                    <td class="right">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</td>
                </tr>
                @php 
                    $grandTotal += $booking->total_harga; 
                    $status = $booking->status_pembayaran ?? 'Belum Dibayar'; 
                @endphp
            @endforeach
        </tbody>
    </table>

    <div class="line"></div>

    <p class="right total">Total: Rp {{ number_format($grandTotal, 0, ',', '.') }}</p>

    <div class="status">
        <p>Status Pembayaran:
            @if($status == 'Lunas')
                <span class="badge bg-success">LUNAS</span>
            @else
                <span class="badge bg-secondary">BELUM</span>
            @endif
        </p>
    </div>

    <div class="line"></div>

    <div class="footer">
        <p>Terima kasih</p>
        <small>Barang yang dibooking harap diambil sesuai jadwal.</small>
    </div>
</body>
</html>
