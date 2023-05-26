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
        $sub_kategori = SubKategori::with('kategori')->get();
        $kategori = Kategori::all();
        $user = User::findOrFail(Auth::id());

        return view('admin.sub-kategori.index', compact("sub_kategori", "kategori","user"));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "kategori_id" => 'required',
            "subkategori" => 'required',
        ]);

        $sub_kategori = SubKategori::create([
            "kategori_id" => $request->kategori_id,
            "subkategori" => $request->subkategori,
            "slug" => Str::slug($request->subkategori)
        ]);

        if ($sub_kategori) {
            return redirect()->route('sub-kategori.index')->with('berhasil', 'Sub Kategori baru telah ditambahkan');
        } else {
            return redirect()->route('sub-kategori.index')->with('gagal', 'Sub Kategori baru gagal ditambahkan');
        }
    }

    // public function edit(Request $request)
    // {
    //     $data = [
    //         "edit" => SubKategori::where("id", $request->id)->first(),
    //         "kategori" => Kategori::all()
    //     ];

    //     return view("admin.sub-kategori.edit", $data);
    // }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'kategori_id' => 'required',
            'subkategori' => 'required',
        ]);

        $sub_kategori = SubKategori::findOrFail($id);

        $sub_kategori->kategori_id = $request->kategori_id;
        $sub_kategori->subkategori = $request->subkategori;
        $sub_kategori->slug = Str::slug($request->subkategori);

        $sub_kategori->save();

        if ($sub_kategori) {
            return redirect()->route('sub-kategori.index')->with('berhasil', 'Sub Kategori berhasil diperbarui');
        } else {
            return redirect()->route('sub-kategori.index')->with('gagal', 'Sub Kategori gagal diperbarui');
        }
    }



    public function destroy($id)
    {
        $subkategori = SubKategori::find($id);
        $subkategori->delete();

        if ($subkategori) {
            return redirect()->route('sub-kategori.index')->with('berhasil', 'Sub Kategori berhasil dihapus');
        } else {
            return redirect()->route('sub-kategori.index')->with('gagal', 'Sub Kategori gagal dihapus');
        }
    }
}
