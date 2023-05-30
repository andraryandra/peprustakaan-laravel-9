<?php

namespace App\Http\Controllers\Admin\Akun;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PetugasController extends Controller
{
    public function index()
    {
        $petugas = User::where("level", '0')->get();
        $user = User::findOrFail(Auth::id());

        return view('admin.autentikasi.petugas.p_index', compact("petugas", "user"));
    }

    public function changeStatusAdmin(Request $request)
    {
        $user = User::find($request->user_id);
        $user->status = $request->status;
        $user->save();

        return response()->json(['success'=>'Status change successfully.']);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'username' => 'required',
            'photo' => 'required',
            'email' => 'required|email',
            'keterangan' => 'required',
            'password' => 'required',
        ], [
            'name.required' => 'Nama Lengkap Wajib Diisi!',
            'username.required' => 'Username Wajib Diisi!',
            'photo.required' => 'Foto Wajib Diisi!',
            'email.required' => 'Email Wajib Diisi!',
            'keterangan.required' => 'Keterangan Wajib Diisi!',
            'password.required' => 'Password Wajib Diisi!',
        ]);

        if ($request->hasFile('photo')) {
            $userPath = $request->file('photo')->store('profile', 'public');
        } else {
            // Tangani situasi jika tidak ada file yang diunggah
            return back()->with(['gagal' => 'Tidak ada file yang diunggah!']);
        }
        $users = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'photo' => $userPath,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'level' => 0,
            'status' => 'ACTIVE',
        ]);

        if($users){
            //redirect dengan pesan sukses
            return redirect()->route('petugas.index')->with(['berhasil' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('petugas.index')->with(['gagal' => 'Data Gagal Disimpan!']);
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $userPath = $user->photo; // Menyimpan path foto pengguna sebelumnya

        // Validasi data yang diperlukan untuk update
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'nullable',
            'keterangan' => 'required',
            'level' => 'nullable',
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
            'username' => $request->username,
            'photo' => $userPath,
            'email' => $request->email,
            'keterangan' => $request->keterangan,
            'level' => $request->level,
        ];

        // Memeriksa apakah password diisi atau tidak
        if ($request->filled('password')) {
            $userData['password'] = bcrypt($request->password);
        }

        $user->update($userData);

        if ($user) {
            // Redirect dengan pesan sukses
            return redirect()->route('petugas.index')->with(['berhasil' => 'Data Berhasil Diperbarui!']);
        } else {
            // Redirect dengan pesan error
            return redirect()->route('petugas.index')->with(['gagal' => 'Data Gagal Diperbarui!']);
        }
    }

    public function show(Request $request)
    {
        $data = [
            "detail" => User::where("id", $request->id)->first()
        ];

        return view("admin.autentikasi.petugas.detail", $data);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Memeriksa apakah ada foto pengguna sebelum menghapusnya
        if ($user->photo) {
            // Menghapus foto pengguna
            Storage::disk('public')->delete($user->photo);
        }

        // Menghapus data pengguna
        $user->delete();

        // Redirect dengan pesan sukses
        if ($user) {
            // Redirect dengan pesan sukses
            return redirect()->route('petugas.index')->with(['berhasil' => 'Data Berhasil Dihapus!']);
        } else {
            // Redirect dengan pesan error
            return redirect()->route('petugas.index')->with(['gagal' => 'Data Gagal Dihapus!']);
        }
    }
}
