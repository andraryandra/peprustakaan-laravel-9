<?php

namespace App\Http\Controllers\Admin\Master;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Admin\Mading;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MadingController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());
        $data_mading = Mading::get();

        return view('admin.majding.v_index', compact("user", "data_mading"));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'mimes:jpg,jpeg,png',
            'judul' => '',
            'buat'  => ''
        ]);

        if($request->file("image")) {
            $data = $request->file("image")->store("mading");
        }

        Mading::create([
            'image' => $data,
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'buat' => $request->buat
        ]);

        return back()->with('berhasil', 'Mading telah ditambahkan');
    }

    public function edit(Request $request)
    {
        $data = [
            "edit" => Mading::where("id", $request->id)->first()
        ];

        return view('admin.majding.edit', $data);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'image' => 'mimes:jpg,jpeg,png',
            'judul' => '',
            'buat'  => ''
        ]);

        if($request->file("image_new")) {
            if ($request->gambarLama) {
                Storage::delete($request->gambarLama);
            }

            $data = $request->file("image_new")->store("mading");
        }else {
            $data = $request->gambarLama;
        }

        Mading::where("id", $request->id)->update([
            'image' => $data,
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'buat' => $request->buat
        ]);

        return back();
    }

    public function show(Request $request)
    {
        $data = [
            "detail" => Mading::where("id", $request->id)->first()
        ];

        return view("admin.majding.detail", $data);
    }

    public function destroy(Mading $majding)
    {
        $majding->delete();
        return back()->with('berhasil');
    }
}

