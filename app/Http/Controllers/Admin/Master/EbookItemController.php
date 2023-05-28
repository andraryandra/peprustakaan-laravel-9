<?php

namespace App\Http\Controllers\Admin\Master;

use App\Models\User;
use App\Models\Admin\Ebook;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\Kategori;
use App\Models\Admin\EbookItem;
use App\Models\Admin\SubKategori;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        $buku = Ebook::with(['ebook_items'])->findOrFail($id);
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
            'files.*'       => 'nullable|mimes:jpeg,jpg,png,doc,docx,pdf,xls,xlsx,ppt,pptx|max:2048', // Mengizinkan multiple files dengan mimes dan max size yang ditentukan
            "judul_part"    => 'nullable',
            'content_part'  => 'nullable',
            'slug'          => 'nullable',
        ], [
            'user_id.required' => 'User harus diisi',
            'kategori_id.required' => 'Kategori harus diisi',
            'subkategori_id.required' => 'Subkategori harus diisi',
            'ebook_id.required' => 'Ebook harus diisi',
            'files.*.mimes' => 'Format file tidak valid. Hanya diperbolehkan file dengan ekstensi jpeg, jpg, png, doc, docx, pdf, xls, xlsx, ppt, pptx',
            'files.*.max' => 'Ukuran file terlalu besar. Maksimal ukuran file adalah 2MB',
            'judul_part.required' => 'Judul part harus diisi',
            'content_part.required' => 'Content part harus diisi',
            'slug.required' => 'slug harus diisi',
        ]);

        $isi_bukuEbookPaths = [];

    if ($request->hasFile('files')) {
        foreach ($request->file('files') as $file) {
            $isi_bukuEbookPath = $file->store('isiEbook', 'public');
            $isi_bukuEbookPaths[] = $isi_bukuEbookPath;
        }
    }

    $bookItems = [];
    $ebook = Ebook::findOrFail($request->ebook_id);

    // Mendapatkan nomor urutan terakhir berdasarkan ebook_id
    $lastNomor = EbookItem::where('ebook_id', $request->ebook_id)->max('nomor');
    $nomor = $lastNomor ?? 0; // Menangani kasus ketika belum ada data

    foreach ($isi_bukuEbookPaths as $isi_bukuEbookPath) {
        $bookItem = EbookItem::create([
            "user_id"       => $request->user_id,
            "kategori_id"   => $request->kategori_id,
            "subkategori_id" => $request->subkategori_id,
            'ebook_id'      => $request->ebook_id,
            'file'          => $isi_bukuEbookPath,
            "judul_part"    => $request->judul_part,
            'content_part'  => $request->content_part,
        ]);

        // Memperbarui nomor urutan
        $nomor++;

        $bookItem->slug = Str::slug($ebook->judul_buku . '-' . $nomor);

        if (empty($bookItem->judul_part)) {
            $bookItem->judul_part = $bookItem->slug;
        }

        $bookItem->nomor = $nomor;

        $bookItem->save();

        $bookItems[] = $bookItem;
    }

    if (count($bookItems) > 0) {
        return redirect()->route('buku-isi.show', $bookItems[0]->ebook_id)->with('berhasil', 'Buku baru telah ditambahkan');
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
        'file'          => 'nullable|mimes:doc,docx,pdf,xls,xlsx,ppt,pptx',
        "judul_part"    => 'nullable',
        'content_part'  => 'nullable',
    ], [
        'user_id.required' => 'User harus diisi',
        'kategori_id.required' => 'Kategori harus diisi',
        'subkategori_id.required' => 'Subkategori harus diisi',
        'ebook_id.required' => 'Ebook harus diisi',
        'file.required' => 'File harus diisi',
        'judul_part.required' => 'Judul part harus diisi',
        'content_part.required' => 'Content part harus diisi',
    ]);

    $ebookItem = EbookItem::find($id);

    if ($ebookItem) {
        $ebookItem->user_id = $request->user_id;
        $ebookItem->kategori_id = $request->kategori_id;
        $ebookItem->subkategori_id = $request->subkategori_id;
        $ebookItem->ebook_id = $request->ebook_id;
        $ebookItem->judul_part = $request->judul_part;
        $ebookItem->content_part = $request->content_part;

        if ($request->hasFile('file')) {
            $isi_bukuEbookPath = $request->file('file')->store('isiEbook', 'public');
            $ebookItem->file = $isi_bukuEbookPath;
        }

        $ebookItem->save();

        return redirect()->route('buku-isi.show', $ebookItem->ebook_id)->with('berhasil', 'Buku telah diperbarui');
    } else {
        return back()->with('gagal', 'Buku tidak ditemukan');
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
