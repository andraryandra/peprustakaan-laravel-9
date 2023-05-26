<?php

namespace App\Http\Controllers\Admin\Verifikasi;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Ebook;
use App\Models\Admin\EbookItemVerify;
use Illuminate\Support\Facades\Auth;

class VerifikasiEbookController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());
        $data_ebook = Ebook::with(['user','ebook_item_verify'])->get();

        $users = User::get();

        return view('admin.verifikasi.v_ebook.index', compact(
            "user",
            "data_ebook",
            'users',
        ));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'verifikasi_ebook' => 'nullable',
            'description' => 'nullable',
        ]);

        $data = EbookItemVerify::findOrFail($id);
        $data->update([
            'verifikasi_ebook' => $request->verifikasi_ebook,
            'description' => $request->description,
        ]);

        if ($data) {
            return redirect()->route('verifikasiEbook.index')->with('berhasil', 'Data berhasil diubah');
        } else {
            return redirect()->route('verifikasiEbook.index')->with('error', 'Data gagal diubah');
        }
    }
}
