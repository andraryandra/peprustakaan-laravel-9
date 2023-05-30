<?php

namespace App\Http\Controllers\Anggota;

use App\Models\User;
use App\Models\Admin\Ebook;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\Kategori;
use App\Models\Admin\SubKategori;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\EbookItemVerify;
use Illuminate\Support\Facades\Storage;

class AnggotaEbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buku = Ebook::where('user_id', Auth::id())->get();
        $subkategori = SubKategori::all();
        $kategori = Kategori::all();
        $user = User::findOrFail(Auth::id());
        $users = User::get();

        return view("user.anggota.artikel.ebook.index", compact("buku", "subkategori", "kategori", "user",'users'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "user_id"       => "nullable",
            "kategori_id"   => 'required',
            "subkategori_id"   => 'required',
            "cover"         => 'required|mimes:jpg,jpeg,png',
            "file"          => 'required|mimes:doc,docx,pdf,xls,xlsx,ppt,pptx',
            'sinopsis'      => 'required',
            "judul_buku"    => 'required',
            "penulis"       => 'required',
            "tahun_terbit"  => 'required',
            'verifikasi_ebook' => 'nullable',
            'slug' => 'nullable|unique:ebooks',
        ],
        [
        'user_id.required' => 'User harus diisi',
        'kategori_id.required' => 'Kategori harus diisi',
        'subkategori_id.required' => 'Subkategori harus diisi',
        'cover.required' => 'Cover harus diisi',
        'file.required' => 'File harus diisi',
        'sinopsis.required' => 'Sinopsis harus diisi',
        'judul_buku.required' => 'Judul buku harus diisi',
        'penulis.required' => 'Penulis harus diisi',
        'tahun_terbit.required' => 'Tahun terbit harus diisi',
        'verifikasi_ebook.required' => 'Verifikasi ebook harus diisi',
        'slug.required' => 'Slug harus diisi',
    ]);

        if ($request->hasFile('file')) {
            $bukuPath = $request->file('file')->store('buku', 'public');
        } else {
            // Tangani situasi jika tidak ada file yang diunggah
            return back()->with(['gagal' => 'Tidak ada file yang diunggah!']);
        }

        if ($request->hasFile('cover')) {
            $coverEbookPath = $request->file('cover')->store('coverEbook', 'public');
        } else {
            // Tangani situasi jika tidak ada file yang diunggah
            return back()->with(['gagal' => 'Tidak ada file yang diunggah!']);
        }

        DB::beginTransaction();

        $book = Ebook::create([
            "user_id"       => Auth::id(),
            "kategori_id"   => $request->kategori_id,
            "subkategori_id" => $request->subkategori_id,
            "cover"         => $coverEbookPath,
            "file"          => $bukuPath,
            "sinopsis"      => $request->sinopsis,
            "judul_buku"    => $request->judul_buku,
            "penulis"       => $request->penulis,
            "tahun_terbit"  => $request->tahun_terbit,
            'slug' => Str::slug($request->judul_buku),
        ]);

        EbookItemVerify::create([
            'ebook_id' => $book->id,
            'user_id' => $book->user_id,
            'verifikasi_ebook' => 'PENDING',
        ]);
        DB::commit();

        if ($book) {
            return redirect()->route('anggota-ebook.index')->with('berhasil', 'Buku baru telah ditambahkan');
        } else {
            return redirect()->route('anggota-ebook')->with('gagal', 'Buku baru gagal ditambahkan');
        }
    }

    public function edit($id)
    {

        $buku = Ebook::findOrFail($id);
        $subkategori = SubKategori::all();
        $kategori = Kategori::all();
        $user = User::findOrFail(Auth::id());
        $users = User::get();

        return view("user.anggota.artikel.ebook.edit", compact("buku", "subkategori", "kategori", "user",'users'));
    }

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
            'slug' => 'nullable',
        ],
    [
        'user_id.required' => 'User harus diisi',
        'kategori_id.required' => 'Kategori harus diisi',
        'subkategori_id.required' => 'Subkategori harus diisi',
        'cover.required' => 'Cover harus diisi',
        'file.required' => 'File harus diisi',
        'sinopsis.required' => 'Sinopsis harus diisi',
        'judul_buku.required' => 'Judul buku harus diisi',
        'penulis.required' => 'Penulis harus diisi',
        'tahun_terbit.required' => 'Tahun terbit harus diisi',
        'slug.required' => 'Slug harus diisi',
    ]);

        $book = Ebook::findOrFail($id);

        $book->user_id = $request->user_id;
        $book->kategori_id = $request->kategori_id;
        $book->subkategori_id = $request->subkategori_id;
        $book->sinopsis = $request->sinopsis;
        $book->judul_buku = $request->judul_buku;
        $book->penulis = $request->penulis;
        $book->tahun_terbit = $request->tahun_terbit;

        $book->slug = Str::slug($book->judul_buku);

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
            return redirect()->route('anggota-ebook.index')->with('berhasil', 'Buku berhasil diperbarui');
        } else {
            return redirect()->route('anggota-ebook.index')->with('gagal', 'Buku gagal diperbarui');
        }
    }


    public function destroy($id)
    {
        $book = Ebook::findOrFail($id);

        // Hapus file cover dan file buku dari penyimpanan
        Storage::disk('public')->delete([$book->cover, $book->file]);

        $book->delete();

        if ($book) {
            return redirect()->route('anggota-ebook.index')->with('berhasil', 'Buku berhasil dihapus');
        } else {
            return redirect()->route('anggota-ebook.index')->with('gagal', 'Buku gagal dihapus');
        }
    }
}
