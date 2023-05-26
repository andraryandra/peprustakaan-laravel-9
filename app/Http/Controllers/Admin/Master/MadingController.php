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
            'slug' => 'required',
            'verifikasi_mading' => 'nullable',
        ]);

        $madingPath = $request->file('image')->store('mading', 'public');

        DB::beginTransaction();
        $madings = Mading::create([
            'user_id' => $request->user_id,
            'image' => $madingPath,
            'judul' => $request->judul,
            'slug' => $request->slug,
            'tags' => $request->tags,
        ]);

        MadingItem::create([
            'mading_id' => $madings->id,
            'user_id' => $madings->user_id,
            'verifikasi_mading' => 'PENDING',
        ]);
        DB::commit();

        // return back()->with('berhasil', 'Mading telah ditambahkan');
        if ($madings) {
            return redirect()->route('madjing.index')->with('berhasil', 'Mading telah ditambahkan');
        } else {
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
            'slug' => 'required',
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
        $mading->slug = $request->slug;
        $mading->tags = $request->tags;

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

