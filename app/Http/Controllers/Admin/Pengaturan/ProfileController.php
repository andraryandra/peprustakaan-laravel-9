<?php

namespace App\Http\Controllers\Admin\Pengaturan;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());

        return view("admin.pengaturan.profile.index", compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $userPath = $user->photo; // Menyimpan path foto pengguna sebelumnya

        // Validasi data yang diperlukan untuk update
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'alamat' => 'nullable',
            'no_telp' => 'nullable|integer',
            'tgl_lahir' => 'nullable',
            'tmpt_lahir' => 'nullable',
            'kelurahan' => 'nullable',
            'kecamatan' => 'nullable',
            'kota_kab' => 'nullable',
            'provinsi' => 'nullable',
            'id_kodepos' => 'nullable',
            'keterangan' => 'nullable',
    ],
    [
            'name.required' => 'Nama tidak boleh kosong!',
            'email.required' => 'Email tidak boleh kosong!',
            'email.email' => 'Email tidak valid!',
            'no_telp.integer' => 'No Telp tidak valid!',
        ]);

        // Mengambil foto baru jika ada
        if ($request->hasFile('photo')) {
            // Menghapus foto pengguna sebelumnya jika ada
            if (!empty($userPath)) {
                Storage::disk('public')->delete($userPath);
            }

            // Menyimpan foto baru
            $userPath = $request->file('photo')->store('profile', 'public');
        }

        // Mengupdate data pengguna
        $userData = [
            'name' => $request->name,
            'photo' => $userPath,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'tgl_lahir' => $request->tgl_lahir,
            'tmpt_lahir' => $request->tmpt_lahir,
            'kelurahan' => $request->kelurahan,
            'kecamatan' => $request->kecamatan,
            'kota_kab' => $request->kota_kab,
            'provinsi' => $request->provinsi,
            'id_kodepos' => $request->id_kodepos,
            'keterangan' => $request->keterangan,
        ];

        $user->update($userData);

        if ($user) {
            // Redirect dengan pesan sukses
            return back()->with(['berhasil' => 'Profile berhasil di updated!!']);
        } else {
            // Redirect dengan pesan error
            return back()->with(['error' => 'Data Gagal Diperbarui!']);
        }
    }

}
