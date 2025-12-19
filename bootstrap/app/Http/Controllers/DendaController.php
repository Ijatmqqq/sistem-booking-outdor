<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DendaController extends Controller
{
    public function index()
    {
        $bookings = Booking::orderBy('created_at', 'DESC')->get();
        return view('admin.denda.index', compact('bookings'));
    }

    public function edit($id)
    {
        $booking = Booking::findOrFail($id);

        // Hitung otomatis denda jika tanggal_pengembalian sudah ada
        if ($booking->tanggal_pengembalian) {
            $this->hitungDenda($booking);
        }

        return view('admin.denda.edit', compact('booking'));
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        $tanggal_kembali = Carbon::parse($booking->tanggal_kembali);
        $tanggal_pengembalian = Carbon::parse($request->tanggal_pengembalian);

        $lamaTelat = $tanggal_pengembalian->diffInDays($tanggal_kembali, false); 

        // Ambil denda yang ada di database sebelumnya
        $dendaLama = (int) $booking->denda;
        $dendaBaru = 0;

        // Hitung denda telat
        if ($lamaTelat > 0) {
            $dendaBaru += ($lamaTelat * 5000);
        }

        // Denda kerusakan (checkbox)
        if ($request->has('kerusakan')) {
            $dendaBaru += 20000;
        }

        // Total denda baru + denda lama
        $totalDenda = $dendaLama + $dendaBaru;

        $booking->update([
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
            'denda' => $totalDenda,
            'total_harga' => $booking->total_harga + $dendaBaru,
            'status_pembayaran' => 'Belum' // wajib untuk reset!
        ]);

        return redirect()->route('denda.index')->with('success', 'Denda berhasil diperbarui!');
    }


    private function hitungDenda($booking)
    {
        $mulai = Carbon::parse($booking->tanggal_kembali);
        $selesai = Carbon::parse($booking->tanggal_pengembalian);

        $telatHari = $mulai->diffInDays($selesai, false);

        $denda = 0;
        if ($telatHari > 0) {
            $denda += $telatHari * 2000; 
        }

        if (request()->has('kerusakan')) {
            $denda += 50000; 
        }

        $booking->denda = $denda;
        $booking->save();
    }
}
