<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Tampilan\Footer;

class LoginAdminController extends Controller
{
   public function index()
   {
        $footer = Footer::all();

        if (Auth::check() && Auth::user()->level == 'petugas') {
            return redirect()->intended('dashboard');
        }

        return view('admin.loginadmin.view_login', compact('footer'));
   }

   public function proses(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ],
    [
        'email.required' => 'Email tidak boleh kosong',
        'password.required' => 'Password tidak boleh kosong'
    ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->status == 'ACTIVE' && $user->level == 'petugas') {
                return redirect()->intended('dashboard');
            } else {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Akun Anda tidak aktif. Silakan hubungi administrator.',
                ])->onlyInput('email');
            }
        }

        return back()->withErrors([
            'email' => 'Maaf, email atau password Anda salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

}
