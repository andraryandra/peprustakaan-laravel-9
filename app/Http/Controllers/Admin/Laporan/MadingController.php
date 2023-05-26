<?php

namespace App\Http\Controllers\Admin\Laporan;

use App\Models\User;
use App\Models\Admin\Mading;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MadingController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());
        $madings = Mading::with(['mading_items'])->get();
        $mading_count = Mading::count();


        return view("admin.laporan.datamading.dm_index", compact(
            "user",
            "madings",
            "mading_count",
        ));
    }
}
