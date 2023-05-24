<?php

namespace App\Http\Controllers\Admin\Laporan;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EbookController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());

        return view("admin.laporan.dataebook.de_index", compact("user"));
    }
}
