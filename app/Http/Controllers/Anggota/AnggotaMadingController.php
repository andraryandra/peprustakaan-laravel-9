<?php

namespace App\Http\Controllers\Anggota;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Admin\Mading;
use Illuminate\Http\Request;
use App\Models\Admin\MadingItem;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Tampilan\Footer;
use Illuminate\Support\Facades\Storage;

class AnggotaMadingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::findOrFail(Auth::id());
        $data_mading = Mading::with(['mading_items'])->where('user_id', Auth::user()->id)->get();

        $users = User::get();
        $footer = Footer::get();

        return view('user.anggota.artikel.mading.index', compact(
            "user",
            "data_mading",
            'users',
            'footer',
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            // 'user_id' => 'required',
            'image' => 'mimes:jpg,jpeg,png',
            'judul' => 'required',
            'tags'  => 'nullable',
            'content' => 'required',
            'verifikasi_mading' => 'nullable',
        ],
        [
            // 'user_id.required' => 'User harus diisi',
            'image.mimes' => 'File harus berupa gambar',
            'judul.required' => 'Judul harus diisi',
            'tags.required' => 'Tags harus diisi',
            'content.required' => 'Content harus diisi',
            'verifikasi_mading.required' => 'Verifikasi harus diisi',
        ]);

        if ($request->hasFile('image')) {
            $madingPath = $request->file('image')->store('mading', 'public');
        } else {
            // Tangani situasi jika tidak ada file yang diunggah
            return back()->with(['gagal' => 'Tidak ada file yang diunggah!']);
        }

        $slug = Str::slug($request->judul);

        DB::beginTransaction();
        try {
            $mading = Mading::create([
                'user_id' => Auth::user()->id,
                'image' => $madingPath,
                'judul' => $request->judul,
                'content' => $request->content,
                'tags' => $request->tags,
                'slug' => $slug,
            ]);

            MadingItem::create([
                'mading_id' => $mading->id,
                'user_id' => $mading->user_id,
                'verifikasi_mading' => 'PENDING',
            ]);

            DB::commit();

            return redirect()->route('anggota-mading.index')->with('berhasil', 'Mading telah ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('anggota-mading.index')->with('gagal', 'Mading gagal ditambahkan');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            "data_mading" => Mading::where("id", $id)->first(),
            "users" => User::get(),
            "mading_latest" => Mading::get(),
        ];

        return view('user.anggota.artikel.mading.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png',
            'judul' => 'required',
            'tags' => 'required',
            'content' => 'required',
            'slug' => 'nullable|unique:madings',
        ],
        [
            'user_id.required' => 'User harus diisi',
            'image.mimes' => 'File harus berupa gambar',
            'judul.required' => 'Judul harus diisi',
            'tags.required' => 'Tags harus diisi',
            'content.required' => 'Content harus diisi',
            'slug.unique' => 'Slug sudah ada',
        ]);

        $mading = Mading::findOrFail($id);

        if ($request->hasFile("image")) {
            $madingPath = $request->file('image')->store('mading', 'public');

            // Menghapus gambar lama jika ada
            if ($mading->image) {
                Storage::disk('public')->delete($mading->image);
            }

            $mading->image = $madingPath;
        }

        $mading->user_id = $request->user_id;
        $mading->judul = $request->judul;
        $mading->content = $request->content;
        $mading->tags = $request->tags;
        $mading->slug = $request->judul;

        $mading->save();

        // return back()->with('berhasil', 'Mading telah diperbarui');
        if ($mading) {
            return redirect()->route('anggota-mading.index')->with('berhasil', 'Mading telah diperbarui');
        } else {
            return back()->with('error', 'Mading gagal diperbarui');
        }
    }


    public function destroy($id)
    {
        $data = Mading::where("id", $id)->first();
        Storage::delete($data->image);
        Mading::where("id", $id)->delete();

        if ($data) {
            return back()->with('berhasil', 'Mading telah dihapus');
        } else {
            return back()->with('error', 'Mading gagal dihapus');
        }
    }
}
