<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        if($user = Auth::user()){
            if($user->level == '0'){
                return redirect()->intended('dashboard');
            }elseif($user->level == '1'){
                return redirect()->intended('landingpage');
            }
        }

        return view('admin.loginadmin.view_login');
    }

    public function proses(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ],
    );

    $credentials = $request->only('email', 'password');

    if(Auth::attempt($credentials)){
        $request->session()->regenerate();
        $user = Auth::user();
        if($user->level == '0'){
            return redirect()->intended('dashboard');
        }elseif($user->level == '1'){
            return redirect()->intended('landingpage');
        }

        return redirect()->intended('/');
    }

        return back()->withErrors([
            'email' => 'Maaf email atau password anda salah',
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
