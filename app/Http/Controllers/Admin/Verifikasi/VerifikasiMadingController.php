<?php

namespace App\Http\Controllers\Admin\Verifikasi;

use App\Models\User;
use App\Models\Admin\Mading;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\MadingItem;
use Illuminate\Support\Facades\Auth;

class VerifikasiMadingController  extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());
        $data_mading = Mading::with(['user','mading_items'])->get();

        $users = User::get();

        return view('admin.verifikasi.v_mading.index', compact(
            "user",
            "data_mading",
            'users',
        ));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'verifikasi_mading' => 'nullable',
            'description' => 'nullable',
        ]);

        $data = MadingItem::findOrFail($id);
        $data->update([
            'verifikasi_mading' => $request->verifikasi_mading,
            'description' => $request->description,
        ]);

        if ($data) {
            return redirect()->route('verifikasiMading.index')->with('berhasil', 'Data berhasil diubah');
        } else {
            return redirect()->route('verifikasiMading.index')->with('error', 'Data gagal diubah');
        }
    }
}
