<?php

namespace App\Http\Controllers\Admin\Tampilan;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Tampilan\About;
use Illuminate\Support\Facades\Auth;

class AboutController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());

        $about = About::all();

        return view('admin.tampilan.about.index', compact("user", "about"));
    }

    public function store(Request $request)
    {
        About::create([

        ]);
    }

    public function edit()
    {
        //
    }

    public function update()
    {
        //
    }
}
