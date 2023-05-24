<?php

namespace App\Http\Controllers\Admin\Akun;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PetugasController extends Controller
{
    public function index()
    {
        $petugas = User::where("level", 1)->get();
        $user = User::findOrFail(Auth::id());

        return view('admin.autentikasi.petugas.p_index', compact("petugas", "user"));
    }

    public function store(Request $request)
    {
        if($request->password != $request->password) {
            return back();
        } else {
            User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'level' => 1
            ]);
            return redirect('/admin/autentikasi/petugas');
        }
    }

    public function update(Request $request, $id)
    {
        if($request->password != $request->password) {
            return back();
        } else {
            User::where("id", $id)->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
            return redirect('/admin/autentikasi/petugas');
        }
    }

    public function show(Request $request)
    {
        $data = [
            "detail" => User::where("id", $request->id)->first()
        ];

        return view("admin.autentikasi.petugas.detail", $data);
    }
}
