<?php

namespace App\Http\Controllers\Admin\Akun;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AnggotaController extends Controller
{
    public function index()
    {

        $anggota = User::where("level", 2)->get();
        $user = User::findOrFail(Auth::id());

        return view('admin.autentikasi.anggota.index', compact("anggota", "user"));
    }

    public function store(Request $request)
    {
        if($request->file("photo")) {
            $data = $request->file("photo")->store("profilesiswa");
        }

        if($request->password != $request->password) {
            return back();
        } else {
            User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'photo' => $data,
                'alamat' => $request->alamat,
                'keterangan' => $request->keterangan,
                'password' => bcrypt($request->password),
                'level' => 2
            ]);
            return redirect('/admin/autentikasi/anggota');
        }
    }

    public function edit(Request $request)
    {
        $data = [
            "edit" => User::where("id", $request->id)->first()
        ];

        return view('admin.autentikasi.anggota.edit', $data);
    }

    public function update(Request $request, $id)
    {
        if($request->file("photo_new")) {
            if ($request->gambarLama) {
                Storage::delete($request->gambarLama);
            }

            $data = $request->file("photo_new")->store("profilesiswa");
        }else {
            $data = $request->gambarLama;
        }

        if($request->password != $request->password) {
            return back();
        } else {
            User::where("id", $id)->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'photo' => $data,
                'alamat' => $request->alamat,
                'keterangan' => $request->keterangan,
                'password' => bcrypt($request->password),
            ]);
            return redirect('/admin/autentikasi/anggota');
        }
    }
}
