<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Petugas;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $petugas = Petugas::where('username', $request->username)->first();

        if ($petugas && password_verify($request->password, $petugas->password)) {
            Auth::login($petugas);
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors(['username' => 'Username atau password salah'])->withInput();
    }

    public function logout()
    {
        Auth::guard('petugas')->logout();
        return redirect('/login');
    }
}
