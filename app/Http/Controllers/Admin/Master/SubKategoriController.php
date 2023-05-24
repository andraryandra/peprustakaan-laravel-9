<?php

namespace App\Http\Controllers\Admin\Master;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\Kategori;
use App\Models\Admin\SubKategori;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SubKategoriController extends Controller
{
    public function index()
    {
        $sub_kategori = SubKategori::get();
        $kategori = Kategori::all();
        $user = User::findOrFail(Auth::id());

        return view('admin.sub-kategori.index', compact("sub_kategori", "kategori","user"));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "kategori_id" => '',
            "subkategori" => '',
        ]);

        SubKategori::create([
            "kategori_id" => $request->kategori_id,
            "subkategori" => $request->subkategori,
            "slug" => Str::slug($request->subkategori)
        ]);

        return back()->with('berhasil', 'Sub Kategori  telah ditambahkan');

    }

    public function edit(Request $request)
    {
        $data = [
            "edit" => SubKategori::where("id", $request->id)->first(),
            "kategori" => Kategori::all()
        ];

        return view("admin.sub-kategori.edit", $data);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            "kategori_id" => '',
            "subkategori" => '',
        ]);

        SubKategori::where("id", $request->id)->update([
            "kategori_id" => $request->kategori_id,
            "subkategori" => $request->subkategori,
            "slug" => Str::slug($request->subkategori)
        ]);

        return back();
    }

    public function destroy($id)
    {
        $subkategori = SubKategori::find($id);
        $subkategori->delete();

        return back()->with('berhasil');
    }
}
