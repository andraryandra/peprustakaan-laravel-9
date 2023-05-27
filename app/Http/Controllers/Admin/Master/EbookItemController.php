<?php

namespace App\Http\Controllers\Admin\Master;

use App\Models\User;
use App\Models\Admin\Ebook;
use Illuminate\Http\Request;
use App\Models\Admin\Kategori;
use App\Models\Admin\EbookItem;
use App\Models\Admin\SubKategori;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EbookItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Ebook $ebook)
    {
        $buku = Ebook::get();
        $subkategori = SubKategori::all();
        $kategori = Kategori::all();
        $user = User::findOrFail(Auth::id());
        $users = User::get();
        $ebookItem = EbookItem::where('ebook_id', $ebook->id)->get();

        return view("admin.buku.cerita.index", compact("buku", "subkategori", "kategori", "user",'users', 'ebookItem'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create(Ebook $ebook)
    // {
    //     $buku = Ebook::get();
    //     $subkategori = SubKategori::all();
    //     $kategori = Kategori::all();
    //     $user = User::findOrFail(Auth::id());
    //     $users = User::get();
    //     $ebookItems = EbookItem::where('ebook_id', $ebook->id)->get();

    //     return view("admin.buku.cerita.create", compact("buku", "user", "users", "subkategori", "kategori", "ebookItems", "ebook"));
    // }

    public function isiCerita($id)
    {
        $buku = Ebook::findOrFail($id);
        $subkategori = SubKategori::all();
        $kategori = Kategori::all();
        $user = User::findOrFail(Auth::id());
        $users = User::get();

        return view("admin.buku.cerita.create", compact("buku", "user",'users', "subkategori", "kategori"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $this->validate($request, [
        "user_id"       => "nullable",
        "kategori_id"   => 'nullable',
        "subkategori_id"   => 'nullable',
        'ebook_id'      => 'required',
        "judul_part"    => 'required',
        'content_part'      => 'required',
    ], [
        'user_id.required' => 'User harus diisi',
        'kategori_id.required' => 'Kategori harus diisi',
        'subkategori_id.required' => 'Subkategori harus diisi',
        'ebook_id.required' => 'Ebook harus diisi',
        'judul_part.required' => 'Judul part harus diisi',
        'content_part.required' => 'Content part harus diisi',
    ]);

    $bookItem = EbookItem::create([
        "user_id"       => $request->user_id,
        "kategori_id"   => $request->kategori_id,
        "subkategori_id" => $request->subkategori_id,
        'ebook_id'      => $request->ebook_id,
        "judul_part"    => $request->judul_part,
        'content_part'  => $request->content_part,
    ]);

    if ($bookItem) {
        return redirect()->route('buku-isi.show', $bookItem->ebook_id)->with('berhasil', 'Buku baru telah ditambahkan');
    } else {
        return back()->with('gagal', 'Buku baru gagal ditambahkan');
    }
}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $buku = Ebook::findOrFail($id);
        $subkategori = SubKategori::all();
        $kategori = Kategori::all();
        $user = User::findOrFail(Auth::id());
        $users = User::get();
        $isi_buku = EbookItem::where('ebook_id', $id)->get();

        return view("admin.buku.cerita.index", compact("buku", "user",'users', "subkategori", "kategori", "isi_buku"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $isi_buku = EbookItem::findOrFail($id);

        return view("admin.buku.cerita.edit", compact("isi_buku"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    $this->validate($request, [
        "user_id"       => "nullable",
        "kategori_id"   => 'nullable',
        "subkategori_id"   => 'nullable',
        'ebook_id'      => 'required',
        "judul_part"    => 'required',
        'content_part'      => 'required',
    ], [
        'user_id.required' => 'User harus diisi',
        'kategori_id.required' => 'Kategori harus diisi',
        'subkategori_id.required' => 'Subkategori harus diisi',
        'ebook_id.required' => 'Ebook harus diisi',
        'judul_part.required' => 'Judul part harus diisi',
        'content_part.required' => 'Content part harus diisi',
    ]);

    $bookItem = EbookItem::findOrFail($id);

    $bookItem->update([
        "user_id"       => $request->user_id,
        "kategori_id"   => $request->kategori_id,
        "subkategori_id" => $request->subkategori_id,
        'ebook_id'      => $request->ebook_id,
        "judul_part"    => $request->judul_part,
        'content_part'  => $request->content_part,
    ]);

    if ($bookItem) {
        return redirect()->route('buku-isi.show', $bookItem->ebook_id)->with('berhasil', 'Buku berhasil diperbarui');
    } else {
        return back()->with('gagal', 'Buku gagal diperbarui');
    }
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bookItem = EbookItem::findOrFail($id);
        $ebookId = $bookItem->ebook_id; // Simpan ID ebook sebelum menghapus

        $deleted = $bookItem->delete();

        if ($deleted) {
            return redirect()->route('buku-isi.show', $ebookId)->with('berhasil', 'Buku telah dihapus');
        } else {
            return back()->with('gagal', 'Gagal menghapus buku');
        }
    }

}
