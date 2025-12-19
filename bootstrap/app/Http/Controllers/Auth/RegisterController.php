<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'nama_lengkap'  => 'required|string|max:255',
            'foto_profil'   => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'nik'           => 'required|string|max:16',
            'alamat'        => 'required|string',
            'no_hp'         => 'required|string|max:15',
            'pekerjaan'     => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email',
            'password'      => 'required|confirmed|min:6',
            'foto_ktp'      => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // FOTO PROFIL
        $fotoProfil = null;
        if ($request->hasFile('foto_profil')) {
            $fotoProfil = time().'_profil_'.$request->foto_profil->getClientOriginalName();
            $request->foto_profil->storeAs('public/profil', $fotoProfil);
        }

        // FOTO KTP
        $fotoKtp = null;
        if ($request->hasFile('foto_ktp')) {
            $fotoKtp = time().'_ktp_'.$request->foto_ktp->getClientOriginalName();
            $request->foto_ktp->storeAs('public/ktp', $fotoKtp);
        }

        User::create([
            'name'         => $request->name,
            'nama_lengkap' => $request->nama_lengkap,
            'foto_profil'  => $fotoProfil,
            'nik'          => $request->nik,
            'alamat'       => $request->alamat,
            'no_hp'        => $request->no_hp,
            'pekerjaan'    => $request->pekerjaan,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'foto_ktp'     => $fotoKtp,
            'role'         => 'user',
        ]);

        return redirect('/')->with('success', 'Registrasi berhasil, silakan login.');
    }
}
