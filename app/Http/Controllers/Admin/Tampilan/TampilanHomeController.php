<?php

namespace App\Http\Controllers\Admin\Tampilan;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Admin\Tampilan\Home;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TampilanHomeController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());

        $home = Home::get();

        return view("admin.tampilan.landingpage.index", compact("user", "home"));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'mimes:jpg,jpeg,png',
            'teks1' => '',
            'teks2' => '',
        ]);

        if($request->file("image")) {
            $data = $request->file("image")->store("Tampilan-home");
        }

        Home::create([
            'image' => $data,
            'teks1' => $request->teks1,
            'teks2' => $request->teks2
        ]);

        return back()->with('berhasil', 'Home baru telah ditambahkan');
    }

    public function edit(Request $request)
    {
        $data = [
            "edit" => Home::where("id", $request->id)->first()
        ];

        return view("admin.tampilan.landingpage.edit", $data);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'image' => 'mimes:jpg,jpeg,png',
            'teks1' => '',
            'teks2' => ''
        ]);

        if($request->file("image_new")) {
            if ($request->gambarLama) {
                Storage::delete($request->gambarLama);
            }

            $data = $request->file("image_new")->store("Tampilan-home");
        }else {
            $data = $request->gambarLama;
        }

        Home::where("id", $request->id)->update([
            'image' => $data,
            'teks1' => $request->teks1,
            'teks2' => $request->teks2,
        ]);

        return back();
    }

}
