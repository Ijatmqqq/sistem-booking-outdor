<?php

namespace App\Http\Controllers\Auth;

use App\Models\Barang;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        $barang = Barang::all();
        return view('welcome', compact('barang'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = \App\Models\User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('eror', 'Email tidak ditemukan di database.')->withInput();
        }

        if (!\Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
            return back()->with('eror', 'Password salah.')->withInput();
        }

        Auth::login($user, $request->remember);

        if ($user->role === 'admin') {
            return redirect()->intended('/admin')->with('success', 'Login berhasil.');
        }

        return redirect()->intended('/userdashboard')->with('success', 'Login berhasil.');
}

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Anda telah logout.');
    }
}
