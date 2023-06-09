<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Tampilan\Footer;

class LoginController extends Controller
{
    public function index()
    {
        $footer = Footer::all();

        if (Auth::check() && Auth::user()->level == 'anggota') {
            return redirect()->intended('landingpage');
        }

        return view('user.akun.login', compact('footer'));
    }

    public function proses(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ],
        [
            'username.required' => 'username tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong'
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->status == 'ACTIVE' && $user->level == 'anggota') {
                return redirect()->intended('/');
            } else {
                Auth::logout();
                return back()->withErrors([
                    'username' => 'Akun Anda tidak aktif. Silakan hubungi administrator.',
                ])->onlyInput('username');
            }
        }

        return back()->withErrors([
            'username' => 'Maaf, username atau password Anda salah.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
