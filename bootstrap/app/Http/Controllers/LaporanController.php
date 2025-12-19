<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Kerusakan;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function booking(Request $request)
    {
        $query = $request->query('query');

        $bookings = Booking::with(['user', 'barang'])
            ->when($query, function ($q) use ($query) {
                $q->whereHas('user', function ($u) use ($query) {
                    $u->where('name', 'like', "%{$query}%")
                      ->orWhere('nama_lengkap', 'like', "%{$query}%");
                })
                ->orWhereHas('barang', function ($b) use ($query) {
                    $b->where('nama_barang', 'like', "%{$query}%");
                })
                ->orWhere('status_pembayaran', 'like', "%{$query}%")
                ->orWhere('keterangan', 'like', "%{$query}%");
            })
            ->latest()
            ->get();

        return view('admin.laporan.booking', compact('bookings', 'query'));
    }

    public function konfirmasi(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status_pembayaran = 'Lunas';
        $booking->keterangan = $request->keterangan;
        $booking->save();

        return back()->with('success', 'Pembayaran berhasil dikonfirmasi');
    }

    public function kembalikan($id)
    {
        $booking = Booking::findOrFail($id);
        $barang = $booking->barang;

        $today = Carbon::now();
        $due = Carbon::parse($booking->tanggal_kembali);

        $lateDays = $today->diffInDays($due, false);
        $booking->denda = 0;

        if ($lateDays < 0) {
            $lateDays = abs($lateDays);
            $booking->denda = $lateDays * 20000;
            $booking->total_harga += $booking->denda;
            $booking->status_pembayaran = 'Belum Lunas';
            $booking->status_denda = 'Belum';
        }

        if ($barang) {
            $barang->increment('stok', $booking->jumlah);
        }

        $booking->tanggal_pengembalian = $today;
        
        $booking->save();

        return back()->with(
            'success',
            'Barang berhasil dikembalikan' .
            ($booking->denda > 0 ? ' dan dikenakan denda.' : '')
        );
    }

    public function peminjaman(Request $request)
    {
        $query = $request->query('query');

        $bookings = Booking::with(['user', 'barang'])
            ->whereNull('tanggal_pengembalian')
            ->latest()
            ->get();

        return view('admin.laporan.peminjaman', compact('bookings', 'query'));
    }

    public function pengembalian(Request $request)
    {
        $query = $request->query('query');

        $bookings = Booking::with(['user', 'barang'])
            ->whereNotNull('tanggal_pengembalian')
            ->latest('tanggal_pengembalian')
            ->get();

        return view('admin.laporan.pengembalian', compact('bookings', 'query'));
    }

    public function kerusakan()
    {
        $kerusakans = Kerusakan::with(['booking', 'barang'])->get();
        return view('admin.laporan.kerusakan', compact('kerusakans'));
    }
}
