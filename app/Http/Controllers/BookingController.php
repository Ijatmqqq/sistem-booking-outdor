<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Barang;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;


class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'tanggal_pinjam' => 'required|date|after_or_equal:today',
            'tanggal_kembali' => 'required|date|after:tanggal_pinjam',
            'jumlah' => 'required|integer|min:1',
        ]);

        $barang = Barang::findOrFail($request->barang_id);
        $user   = Auth::user();

        if ($barang->stok < $request->jumlah) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi untuk jumlah yang dipesan.');
        }

        $lamaHari = (new \DateTime($request->tanggal_pinjam))
            ->diff(new \DateTime($request->tanggal_kembali))
            ->days;

        if ($lamaHari < 1) {
            $lamaHari = 1;
        }

        $total = $barang->harga_per_hari * $request->jumlah * $lamaHari;

        Booking::create([
            'user_id'        => $user->id,
            'barang_id'      => $request->barang_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali'=> $request->tanggal_kembali,
            'jumlah'         => $request->jumlah,
            'total_harga'    => $total,
            'nama'           => $user->nama_lengkap,
            'nik'            => $user->nik,
            'alamat'         => $user->alamat,
            'no_hp'          => $user->no_hp,
        ]);

        $barang->decrement('stok', $request->jumlah);

        return redirect()->back()->with('success', 'Booking berhasil! Stok otomatis berkurang.');
    }

    public function show($id)
    {
        $booking = Booking::with('barang')->findOrFail($id);

        return view('user.show', compact('booking'));
    }

    public function printAll()
    {
        $bookings = Booking::where('user_id', Auth::id())
            ->with('barang')
            ->get();

        if ($bookings->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada booking untuk dicetak.');
        }

        $pdf = Pdf::loadView('user.print', compact('bookings'))
                ->setPaper([0, 0, 226.77, 600], 'portrait'); // 80mm roll paper

        $filename = 'Struk_Booking_' . now()->format('Ymd_His') . '.pdf';

        // Tampilkan di browser dulu
        return $pdf->stream($filename);
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->user_id != Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak punya izin untuk membatalkan booking ini.');
        }

        $barang = Barang::find($booking->barang_id);
        if ($barang) {
            $barang->stok += $booking->jumlah; 
            $barang->save();
        }

        $booking->delete();

        return redirect()->back()->with('success', 'Booking berhasil dibatalkan, stok barang telah dikembalikan.');
    }

    public function edit($id)
    {
        $booking = Booking::with('barang')->findOrFail($id);
        $barangs = Barang::all();
        return view('user.edit-booking', compact('booking', 'barangs'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_pinjam' => 'required|date|after_or_equal:today',
            'tanggal_kembali' => 'required|date|after:tanggal_pinjam',
            'jumlah' => 'required|integer|min:1',
        ]);

        $booking = Booking::findOrFail($id);
        $barang  = Barang::findOrFail($booking->barang_id);

        $lamaHari = (new \DateTime($request->tanggal_pinjam))
            ->diff(new \DateTime($request->tanggal_kembali))
            ->days;

        $total = $barang->harga_per_hari * $request->jumlah * $lamaHari;

        $booking->update([
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'jumlah' => $request->jumlah,
            'total_harga' => $total,
        ]);

        return redirect()->route('user.myBooking')->with('success', 'Data booking berhasil diperbarui.');
    }

    public function pdf($id)
    {
        $booking = Booking::with('barang', 'user')->findOrFail($id);

        $pdf = Pdf::loadView('user.pdf', compact('booking'))
                    ->setPaper('A4', 'portrait');

        return $pdf->stream('booking-'.$booking->id.'.pdf');
    }


}
