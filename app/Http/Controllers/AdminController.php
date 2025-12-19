<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function admin()
    {
        $totalBarang   = \App\Models\Barang::count();
        $totalBooking  = \App\Models\Booking::count();
        $bookingAktif  = \App\Models\Booking::where('status_pembayaran', 'Belum')->count();
        $totalUser     = \App\Models\User::count();
        return view('admin.dashboard', compact('totalBarang', 'totalBooking', 'bookingAktif', 'totalUser'));
    }

    public function index(Request $request)
    {
        $query = $request->get('query');

        $users = \App\Models\User::when($query, function ($q) use ($query) {
            $q->where('name', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->orWhere('nama_lengkap', 'like', "%{$query}%")
            ->orWhere('nik', 'like', "%{$query}%")
            ->orWhere('no_hp', 'like', "%{$query}%")
            ->orWhere('pekerjaan', 'like', "%{$query}%");
        })->get();

        return view('admin.user.index', compact('users', 'query'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('admin.profile', compact('user'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required',
            'email'         => 'required|email|unique:users,email',
            'password'      => 'required|min:6',
            'nama_lengkap'  => 'nullable',
            'foto_profil'   => 'nullable|image',
            'nik'           => 'nullable',
            'alamat'        => 'nullable',
            'no_hp'         => 'nullable',
            'pekerjaan'     => 'nullable',
            'role'          => 'required',
            'foto_ktp'      => 'nullable|image'
        ]);

        $namaFile = null;
        if ($request->hasFile('foto_profil')) {
            $namaFile = $request->file('foto_profil')->store('foto_profil', 'public');
        }

        $namaFile = null;
        if ($request->hasFile('foto_ktp')) {
            $namaFile = $request->file('foto_ktp')->store('foto_ktp', 'public');
        }

        User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'nama_lengkap'  => $request->nama_lengkap,
            'foto_profil'   => $namaFile,
            'nik'           => $request->nik,
            'alamat'        => $request->alamat,
            'no_hp'         => $request->no_hp,
            'pekerjaan'     => $request->pekerjaan,
            'role'          => $request->role,
            'foto_ktp'      => $namaFile,
        ]);

        return redirect()->route('users.index')->with('success','User berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'          => 'required',
            'email'         => 'required|email|unique:users,email,'.$user->id,
            'password'      => 'nullable|min:6',
            'nama_lengkap'  => 'nullable',
            'foto_profil'   => 'nullable|image',
            'nik'           => 'nullable',
            'alamat'        => 'nullable',
            'no_hp'         => 'nullable',
            'pekerjaan'     => 'nullable',
            'role'          => 'required',
            'foto_ktp'      => 'nullable|image'
        ]);

        if ($request->hasFile('foto_profil')) {
            $user->foto_profil = $request->file('foto_profil')->store('foto_profil', 'public');
        }
        if ($request->hasFile('foto_ktp')) {
            $user->foto_ktp = $request->file('foto_ktp')->store('foto_ktp', 'public');
        }

        $user->name          = $request->name;
        $user->email         = $request->email;
        $user->nama_lengkap  = $request->nama_lengkap;
        $user->nik           = $request->nik;
        $user->alamat        = $request->alamat;
        $user->no_hp         = $request->no_hp;
        $user->pekerjaan     = $request->pekerjaan;
        $user->role          = $request->role;

        // update password jika diisi
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('users.index')->with('success','User berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success','User berhasil dihapus.');
    }

    public function liveSearch(Request $request)
    {
        $query = $request->get('query', '');
        if (!$query) return response()->json([]);

        $users = \App\Models\User::where('name', 'like', "%{$query}%")->take(5)->get(['id', 'name']);
        $barangs = \App\Models\Barang::where('nama_barang', 'like', "%{$query}%")->take(5)->get(['id', 'nama_barang']);
        $bookings = Booking::with(['user', 'barang'])
        ->when($query, function ($q) use ($query) {
            $q->whereHas('user', function ($u) use ($query) {
                $u->where('name', 'like', "%{$query}%")
                ->orWhere('nama_lengkap', 'like', "%{$query}%")
                ->orWhere('no_hp', 'like', "%{$query}%");
            })
            ->orWhereHas('barang', function ($b) use ($query) {
                $b->where('nama_barang', 'like', "%{$query}%");
            })
            ->orWhere('tanggal_kembali', 'like', "%{$query}%") // 🔹 TAMBAHAN
            ->orWhere('tanggal_pinjam', 'like', "%{$query}%");
        })
        ->get();

        return response()->json([
            'users' => $users,
            'barangs' => $barangs,
            'bookings' => $bookings,
        ]);
    }

}
