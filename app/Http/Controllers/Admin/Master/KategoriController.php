<?php

namespace App\Http\Controllers\Admin\Master;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\Kategori;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class KategoriController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());
        $kategori = Kategori::get();

        return view('admin.kategori.v_index', compact("user","kategori"));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_kategori' => 'required',
        ]);

        $kategori = Kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'slug' => Str::slug($request->nama_kategori),
        ]);

        if ($kategori) {
            return redirect()->route('categori.index')->with('berhasil', 'Kategori baru telah ditambahkan');
        } else {
            return redirect()->route('categori.index')->with('gagal', 'Kategori baru gagal ditambahkan');
        }
    }

    // public function edit(Request $request)
    // {
    //     $data = [
    //         "edit" => Kategori::where("id", $request->id)->first(),
    //     ];

    //     return view("admin.kategori.edit", $data);
    // }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_kategori' => 'required',
        ]);

        $kategori = Kategori::findOrFail($id);

        $updateData = [
            'nama_kategori' => $request->nama_kategori,
            'slug' => Str::slug($request->nama_kategori),
        ];

        $kategori->update($updateData);

        if ($kategori) {
            return redirect()->route('categori.index')->with('berhasil', 'Kategori berhasil diperbarui');
        } else {
            return redirect()->route('categori.index')->with('gagal', 'Kategori gagal diperbarui');
        }
    }


    public function destroy($id)
    {

        $kategori = Kategori::find($id);
        $kategori->delete();

        if ($kategori) {
            return redirect()->route('categori.index')->with('berhasil', 'Kategori berhasil dihapus');
        } else {
            return redirect()->route('categori.index')->with('gagal', 'Kategori gagal dihapus');
        }
    }
}
