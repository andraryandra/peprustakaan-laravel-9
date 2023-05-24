<?php

namespace App\Http\Controllers\Admin\Master;

use App\Models\User;
use App\Models\Admin\Ebook;
use Illuminate\Http\Request;
use App\Models\Admin\Kategori;
use App\Models\Admin\SubKategori;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EbookController extends Controller
{
    public function index()
    {
        $buku = Ebook::get();
        $subkategori = SubKategori::all();
        $kategori = Kategori::all();
        $user = User::findOrFail(Auth::id());

        return view("admin.buku.v_index", compact("buku", "subkategori", "kategori", "user"));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "id_buku"   => '',
            "kategori_id"   => '',
            "subkategori_id"   => '',
            "cover"         => 'mimes:jpg,jpeg,png',
            "file"          => 'mimes:doc,docx,pdf,xls,xlxs,PDF,ppt,pptx',
            "judul_buku"    => '',
            "penulis"       => '',
            "tahun_terbit"  => '',
        ]);

        if($request->file("file")){
            $file = $request->file("file")->store("buku");
        }

        if($request->file("cover")) {
            $data = $request->file("cover")->store("cover");
        }

        Ebook::create([
            "kategori_id"   => $request->kategori_id,
            "subkategori_id" => $request->subkategori_id,
            "cover"         => $data,
            "file"          => $file,
            "judul_buku"    => $request->judul_buku,
            "penulis"       => $request->penulis,
            "tahun_terbit"  => $request->tahun_terbit
        ]);

        return back()->with('berhasil', 'Buku telah ditambahkan');
    }

    public function edit(Request $request)
    {
        $data = [
            "subkategori" => SubKategori::all(),
            "kategori" => Kategori::all(),
            "edit" => Ebook::where("id", $request->id)->first()
        ];

        return view("admin.buku.edit", $data);
    }

    // public function update(Request $request)
    // {
    //     $this->validate($request, [
    //         "kategori_id"   => '',
    //         "subkategori_id"=> '',
    //         "cover"         => 'mimes:jpg,jpeg,png',
    //         "judul_buku"    => '',
    //         "penulis"       => '',
    //         "tahun_terbit"  => '',
    //     ]);

    //     if($request->file("cover_new")) {
    //         if ($request->gambarLama) {
    //             Storage::delete($request->gambarLama);
    //         }

    //         $data = $request->file("cover_new")->store("cover");
    //     }else {
    //         $data = $request->gambarLama;
    //     }

    //     if($request->file("file_new")) {
    //         if ($request->fileLama) {
    //             Storage::delete($request->fileLama);
    //         }

    //         $file = $request->file("file_new")->store("buku");
    //     }else {
    //         $file = $request->fileLama;
    //     }

    //     Ebook::where("id", $request->id)->update([
    //         "kategori_id"   => $request->kategori_id,
    //         "subkategori_id"   => $request->subkategori_id,
    //         "cover"         => $data,
    //         // "file"          => $file,
    //         "judul_buku"    => $request->judul_buku,
    //         "penulis"       => $request->penulis,
    //         "tahun_terbit"  => $request->tahun_terbit
    //     ]);

    //     return back();
    // }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "id_buku"       => '',
            "kategori_id"   => '',
            "subkategori_id" => '',
            "cover"         => 'mimes:jpg,jpeg,png',
            "file"          => 'mimes:doc,docx,pdf,xls,xlsx,ppt,pptx',
            "judul_buku"    => '',
            "penulis"       => '',
            "tahun_terbit"  => '',
        ]);

        $ebook = Ebook::findOrFail($id);

        if ($request->file("file")) {
            $file = $request->file("file")->store("buku");
            $ebook->file = $file;
        }

        if ($request->file("cover")) {
            $cover = $request->file("cover")->store("cover");
            $ebook->cover = $cover;
        }

        $ebook->kategori_id = $request->kategori_id;
        $ebook->subkategori_id = $request->subkategori_id;
        $ebook->judul_buku = $request->judul_buku;
        $ebook->penulis = $request->penulis;
        $ebook->tahun_terbit = $request->tahun_terbit;

        $ebook->save();

        return back()->with('berhasil', 'Buku telah diperbarui');
    }

    public function destroy(Ebook $ebook)
    {
        $ebook->delete();
        return back()->with('berhasil');
    }
}
