<?php

namespace App\Http\Controllers\Admin\Master;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Admin\Mading;
use Illuminate\Http\Request;
use App\Models\Admin\MadingItem;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MadingController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());
        $data_mading = Mading::with('user')->get();

        $users = User::get();

        return view('admin.majding.v_index', compact(
            "user",
            "data_mading",
            'users',
        ));
    }

    public function show($id)
    {
        $data = [
            "data_mading" => Mading::where("id", $id)->first(),
            "users" => User::get(),
            "mading_latest" => Mading::get(),
        ];

        return view('user.anggota.tampilan.detail_mading', $data);
    }

    public function store(Request $request)
{
    $this->validate($request, [
        'user_id' => 'required',
        'image' => 'mimes:jpg,jpeg,png',
        'judul' => 'required',
        'tags'  => 'required',
        'content' => 'required',
        'verifikasi_mading' => 'nullable',
    ],
    [
        'user_id.required' => 'User harus diisi',
        'image.mimes' => 'File harus berupa gambar',
        'judul.required' => 'Judul harus diisi',
        'tags.required' => 'Tags harus diisi',
        'content.required' => 'Content harus diisi',
        'verifikasi_mading.required' => 'Verifikasi harus diisi',
    ]);

    $madingPath = $request->file('image')->store('mading', 'public');
    $slug = Str::slug($request->judul);

    DB::beginTransaction();
    try {
        $mading = Mading::create([
            'user_id' => $request->user_id,
            'image' => $madingPath,
            'judul' => $request->judul,
            'content' => $request->content,
            'tags' => $request->tags,
            'slug' => $slug,
        ]);

        MadingItem::create([
            'mading_id' => $mading->id,
            'user_id' => $mading->user_id,
            'verifikasi_mading' => 'ACTIVE',
        ]);

        DB::commit();

        return redirect()->route('madjing.index')->with('berhasil', 'Mading telah ditambahkan');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->route('madjing.index')->with('gagal', 'Mading gagal ditambahkan');
    }
}



    public function edit($id)
    {
        $data = [
            "data_mading" => Mading::where("id", $id)->first(),
            "users" => User::get(),
            "mading_latest" => Mading::get(),
        ];

        return view('admin.majding.edit', $data);
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
            return redirect()->route('madjing.index')->with('berhasil', 'Mading telah diperbarui');
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

