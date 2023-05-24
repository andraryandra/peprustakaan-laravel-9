<?php

namespace App\Http\Controllers\Admin\Laporan;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MadingController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());

        return view("admin.laporan.datamading.dm_index", compact("user"));
    }
}
