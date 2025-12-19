<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();
        return view('admin.barang.index', compact('barangs'));
    }

    public function create()
    {
        return view('admin.barang.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_barang' => 'required|string|max:255',
            'nama_barang' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'stok' => 'required|integer|min:0',
            'harga_per_hari' => 'required|numeric|min:0',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoName = time() . '_' . $foto->getClientOriginalName();
            
            $foto->storeAs('public/foto_barang', $fotoName);

            $validated['foto'] = 'storage/foto_barang/' . $fotoName;
        }

        Barang::create($validated);

        return redirect()->route('barang.index')
            ->with('success', 'Barang berhasil ditambahkan!');
    }

    public function cancel($id)
    {
        $booking = Booking::findOrFail($id);
        $barang = $booking->barang;

        $barang->increment('stok', $booking->jumlah);

        $booking->update(['status' => 'cancelled']);

        return redirect()->back()->with('success', 'Booking dibatalkan dan stok dikembalikan.');
    }


    public function edit(Barang $barang)
    {
        return view('admin.barang.edit', compact('barang'));
    }

    public function update(Request $request, Barang $barang)
    {

        $request->validate([
            'kategori_barang' => 'required',
            'nama_barang'     => 'required',
            'deskripsi'       => 'nullable',
            'stok'            => 'required|integer',
            'harga_per_hari'  => 'required|numeric',
            'foto'            => 'nullable|image',
        ]);

        // data dasar
        $data = [
            'kategori_barang' => $request->kategori_barang,
            'nama_barang'     => $request->nama_barang,
            'deskripsi'       => $request->deskripsi,
            'stok'            => $request->stok,
            'harga_per_hari'  => $request->harga_per_hari,
        ];

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto_barang', 'public');
        }

        $barang->update($data);

        return redirect()->route('barang.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('barang.index')
                        ->with('success', 'Data berhasil dihapus.');
    }
}
