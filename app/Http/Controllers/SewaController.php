<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sewa;
use App\Models\Booking;

class SewaController extends Controller
{
    // ======================
    // INDEX
    // ======================
    public function index()
    {
        $data = Sewa::latest()->get();

        $totalPendapatan = $data->sum('total_harga');
        $totalDenda      = $data->sum('denda');

        return view('admin.laporan.sewa.index', compact(
            'data','totalPendapatan','totalDenda'
        ));
    }

    // ======================
    // CREATE
    // ======================
    public function create()
    {
        $bookings = Booking::where('status_pembayaran','Lunas')
            ->latest()
            ->get();

        return view('admin.laporan.sewa.create', compact('bookings'));
    }

    // ======================
    // STORE (SIMPAN KE TABEL SEWA)
    // ======================
    public function store(Request $request)
    {
        $request->validate([
            'booking_id'       => 'required',
            'nama_penyewa'     => 'required',
            'nama_barang'      => 'required',
            'tanggal_pinjam'   => 'required|date',
            'tanggal_kembali'  => 'required|date',
            'jumlah'           => 'required|numeric',
            'total_harga'      => 'required|numeric',
            'denda'            => 'nullable|numeric',
            'status_denda'     => 'required',
            'keterangan'       => 'nullable'
        ]);

        Sewa::create([
            'booking_id'       => $request->booking_id,
            'nama_penyewa'     => $request->nama_penyewa,
            'nik'              => $request->nik,
            'alamat'           => $request->alamat,
            'no_hp'            => $request->no_hp,
            'nama_barang'      => $request->nama_barang,
            'tanggal_pinjam'   => $request->tanggal_pinjam,
            'tanggal_kembali'  => $request->tanggal_kembali,
            'jumlah'           => $request->jumlah,
            'total_harga'      => $request->total_harga,
            'denda'            => $request->denda ?? 0,
            'status_denda'     => $request->status_denda,
            'keterangan'       => $request->keterangan
        ]);

        return redirect()->route('sewa.index')
            ->with('success', 'Data sewa berhasil disimpan!');
    }

    // ======================
    // EDIT (FORM)
    // ======================
    public function edit($id)
    {
        $data = Sewa::findOrFail($id);
        return view('admin.laporan.sewa.edit', compact('data'));
    }

    // ======================
    // UPDATE
    // ======================
    public function update(Request $request, $id)
    {
        $data = Sewa::findOrFail($id);

        $request->validate([
            'nama_penyewa'    => 'required',
            'nama_barang'     => 'required',
            'tanggal_pinjam'  => 'required|date',
            'tanggal_kembali' => 'required|date',
            'jumlah'          => 'required|numeric',
            'total_harga'     => 'required|numeric',
            'denda'           => 'nullable|numeric',
            'status_denda'    => 'required'
        ]);

        $data->update([
            'nama_penyewa'     => $request->nama_penyewa,
            'nik'              => $request->nik,
            'alamat'           => $request->alamat,
            'no_hp'            => $request->no_hp,
            'nama_barang'      => $request->nama_barang,
            'tanggal_pinjam'   => $request->tanggal_pinjam,
            'tanggal_kembali'  => $request->tanggal_kembali,
            'jumlah'           => $request->jumlah,
            'total_harga'      => $request->total_harga,
            'denda'            => $request->denda ?? 0,
            'status_denda'     => $request->status_denda,
            'keterangan'       => $request->keterangan
        ]);

        return redirect()->route('sewa.index')
            ->with('success', 'Data sewa berhasil diperbarui!');
    }

    // ======================
    // DELETE
    // ======================
    public function destroy($id)
    {
        $data = Sewa::findOrFail($id);
        $data->delete();

        return redirect()->route('sewa.index')
            ->with('success', 'Data sewa berhasil dihapus!');
    }

    // ======================
    // API GET BOOKING (AUTO FILL FORM)
    // ======================
    public function getBooking($id)
    {
        $booking = Booking::with('barang','user')->findOrFail($id);

        return response()->json([
            'id'             => $booking->id, 
            'nama_penyewa'   => $booking->nama ?? $booking->user->name,
            'nik'            => $booking->nik,
            'alamat'         => $booking->alamat,
            'no_hp'          => $booking->no_hp,
            'nama_barang'    => $booking->barang->nama_barang ?? '',
            'tanggal_pinjam' => $booking->tanggal_pinjam,
            'tanggal_kembali'=> $booking->tanggal_kembali,
            'jumlah'         => $booking->jumlah,
            'total_harga'    => $booking->total_harga,
        ]);
    }
}