<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BerandaController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());
        return view('admin.dashboard', compact("user"));
    }
}
