<?php

namespace App\Http\Controllers\Admin\Verifikasi;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MadingController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());

        return view("admin.verifikasi.v_mading.index", compact("user"));
    }
}
