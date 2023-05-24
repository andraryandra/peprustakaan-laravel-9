<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        if($user = Auth::user()){
            if($user->level == '1'){
                return redirect()->intended('dashboard');
            }elseif($user->level == '2'){
                return redirect()->intended('landingpage');
            }
        }

        return view('user.akun.login');
    }

    public function proses(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ],
    );

    $credentials = $request->only('username', 'password');

    if(Auth::attempt($credentials)){
        $request->session()->regenerate();
        $user = Auth::user();
        if($user->level == '1'){
            return redirect()->intended('dashboard');
        }elseif($user->level == '2'){
            return redirect()->intended('landingpage');
        }

        return redirect()->intended('/');
    }

        return back()->withErrors([
            'username' => 'Maaf username atau password anda salah',
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
