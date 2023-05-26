<?php

namespace App\Http\Controllers\Admin\Master;

use App\Models\User;
use App\Models\Admin\Ebook;
use Illuminate\Http\Request;
use App\Models\Admin\Kategori;
use App\Models\Admin\SubKategori;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\EbookItemVerify;
use Illuminate\Support\Facades\Storage;

class EbookController extends Controller
{
    public function index()
    {
        $buku = Ebook::get();
        $subkategori = SubKategori::all();
        $kategori = Kategori::all();
        $user = User::findOrFail(Auth::id());
        $users = User::get();

        return view("admin.buku.v_index", compact("buku", "subkategori", "kategori", "user",'users'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "user_id"       => "required",
            "kategori_id"   => 'required',
            "subkategori_id"   => 'required',
            "cover"         => 'required|mimes:jpg,jpeg,png',
            "file"          => 'required|mimes:doc,docx,pdf,xls,xlsx,ppt,pptx',
            'sinopsis'      => 'required',
            "judul_buku"    => 'required',
            "penulis"       => 'required',
            "tahun_terbit"  => 'required',
            'verifikasi_ebook' => 'nullable',
        ]);

        $bukuPath = $request->file('file')->store('buku', 'public');
        $coverEbookPath = $request->file('cover')->store('coverEbook', 'public');

        DB::beginTransaction();

        $book = Ebook::create([
            "user_id"       => $request->user_id,
            "kategori_id"   => $request->kategori_id,
            "subkategori_id" => $request->subkategori_id,
            "cover"         => $coverEbookPath,
            "file"          => $bukuPath,
            "sinopsis"      => $request->sinopsis,
            "judul_buku"    => $request->judul_buku,
            "penulis"       => $request->penulis,
            "tahun_terbit"  => $request->tahun_terbit
        ]);

        EbookItemVerify::create([
            'ebook_id' => $book->id,
            'user_id' => $book->user_id,
            'verifikasi_ebook' => 'PENDING',
        ]);
        DB::commit();

        if ($book) {
            return redirect()->route('buku.index')->with('berhasil', 'Buku baru telah ditambahkan');
        } else {
            return redirect()->route('buku.index')->with('gagal', 'Buku baru gagal ditambahkan');
        }
    }


    public function edit($id)
    {

        $buku = Ebook::findOrFail($id);
        $subkategori = SubKategori::all();
        $kategori = Kategori::all();
        $user = User::findOrFail(Auth::id());
        $users = User::get();

        return view("admin.buku.edit", compact("buku", "subkategori", "kategori", "user",'users'));

        // $buku = Ebook::get();
        // $subkategori = SubKategori::all();
        // $kategori = Kategori::all();
        // $user = User::findOrFail(Auth::id());

        // return view("admin.buku.edit", compact("buku", "subkategori", "kategori", "user"));
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
            "user_id"       => "required",
            "kategori_id"   => 'required',
            "subkategori_id"   => 'required',
            "cover"         => 'nullable|mimes:jpg,jpeg,png',
            "file"          => 'nullable|mimes:doc,docx,pdf,xls,xlsx,ppt,pptx',
            'sinopsis'      => 'required',
            "judul_buku"    => 'required',
            "penulis"       => 'required',
            "tahun_terbit"  => 'required',
        ]);

        $book = Ebook::findOrFail($id);

        $book->user_id = $request->user_id;
        $book->kategori_id = $request->kategori_id;
        $book->subkategori_id = $request->subkategori_id;
        $book->sinopsis = $request->sinopsis;
        $book->judul_buku = $request->judul_buku;
        $book->penulis = $request->penulis;
        $book->tahun_terbit = $request->tahun_terbit;

        if ($request->hasFile('cover')) {
            // Hapus file cover yang lama jika ada
            Storage::disk('public')->delete($book->cover);

            $coverEbookPath = $request->file('cover')->store('coverEbook', 'public');
            $book->cover = $coverEbookPath;
        }

        if ($request->hasFile('file')) {
            // Hapus file buku yang lama jika ada
            Storage::disk('public')->delete($book->file);

            $bukuPath = $request->file('file')->store('buku', 'public');
            $book->file = $bukuPath;
        }

        $book->save();

        if ($book) {
            return redirect()->route('buku.index')->with('berhasil', 'Buku berhasil diperbarui');
        } else {
            return redirect()->route('buku.index')->with('gagal', 'Buku gagal diperbarui');
        }
    }


    public function destroy($id)
    {
        $book = Ebook::findOrFail($id);

        // Hapus file cover dan file buku dari penyimpanan
        Storage::disk('public')->delete([$book->cover, $book->file]);

        $book->delete();

        if ($book) {
            return redirect()->route('buku.index')->with('berhasil', 'Buku berhasil dihapus');
        } else {
            return redirect()->route('buku.index')->with('gagal', 'Buku gagal dihapus');
        }
    }

}
