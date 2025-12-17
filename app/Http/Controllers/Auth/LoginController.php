<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();


            if (Auth::user()->email === 'admin1@gmail.com') {
                return redirect()->route('admin.homepage');
            }

            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }


    public function logout(Request $request)
    {
        // Log out pengguna dan invalidasi sesi
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Kembalikan ke halaman utama
        return redirect('/');
    }
}
