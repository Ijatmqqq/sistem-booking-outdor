<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $barang = \DB::table('barangs')->get();
        return view('welcome', compact('barang'));
    }
}
