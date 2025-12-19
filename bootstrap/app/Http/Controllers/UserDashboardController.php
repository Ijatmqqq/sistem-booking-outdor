<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
    {
        $barang = Barang::all();
        return view('user.index', compact('barang'));
    }

    public function myBooking()
    {
        $user = Auth::user();
        $bookings = $user->bookings; 

        return view('user.my-booking', compact('bookings'));
    }

    // detail barang
    public function show($id)
    {
        $barang = Barang::findOrFail($id);
        return view('user.detail-barang', compact('barang'));
    }

    public function kategori($namaKategori)
    {
        $barang = Barang::where('kategori_barang', $namaKategori)->get();
        return view('user.index', compact('barang', 'namaKategori'));
    }
}
