<?php

namespace App\Http\Controllers;

use App\Models\Admin\Ebook;
use App\Models\User;
use App\Models\Admin\Mading;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BerandaController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());
        $users = User::all();
        $users_anggota_count = User::where('level', '1')->count();

        $ebook_count = Ebook::count();
        $mading_count = Mading::count();

        return view('admin.dashboard', compact(
            "user",
            'users',
            'users_anggota_count',
            'mading_count',
            'ebook_count',
        ));
    }
}
