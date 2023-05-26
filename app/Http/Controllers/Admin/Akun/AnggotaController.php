<?php

namespace App\Http\Controllers\Admin\Akun;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AnggotaController extends Controller
{
    public function index()
    {

        $anggotas = User::where('level','=','1')->get();
        $user = User::findOrFail(Auth::id());

        return view('admin.autentikasi.anggota.index', compact("anggotas", "user"));
    }

    public function store(Request $request)
    {
        $userPath = $request->file('photo')->store('profilesiswa', 'public');
        $users = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'photo' => $userPath,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'keterangan' => $request->keterangan,
            'password' => bcrypt($request->password),
            'level' => 1,
            'status' => 'ACTIVE',
        ]);

        if($users){
            //redirect dengan pesan sukses
            return redirect()->route('anggota.index')->with(['berhasil' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('anggota.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    // public function edit(Request $request)
    // {
    //     $data = [
    //         "edit" => User::where("id", $request->id)->first()
    //     ];

    //     return view('admin.autentikasi.anggota.edit', $data);
    // }

    public function changeStatus(Request $request)
    {
        $user = User::find($request->user_id);
        $user->status = $request->status;
        $user->save();

        return response()->json(['success'=>'Status change successfully.']);
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
        'alamat' => 'required',
        'keterangan' => 'required',
        'password' => 'nullable',
        'level' => 'nullable',
    ]);

    // Mengambil foto baru jika ada
    if ($request->hasFile('photo')) {
        // Menghapus foto pengguna sebelumnya
        Storage::disk('public')->delete($userPath);

        // Menyimpan foto baru
        $userPath = $request->file('photo')->store('profilesiswa', 'public');
    }

    // Mengupdate data pengguna
    $userData = [
        'name' => $request->name,
        'username' => $request->username,
        'photo' => $userPath,
        'email' => $request->email,
        'alamat' => $request->alamat,
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
        return redirect()->route('anggota.index')->with(['berhasil' => 'Data Berhasil Diperbarui!']);
    } else {
        // Redirect dengan pesan error
        return redirect()->route('anggota.index')->with(['error' => 'Data Gagal Diperbarui!']);
    }
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
        return redirect()->route('anggota.index')->with(['berhasil' => 'Data Berhasil Dihapus!']);
    } else {
        // Redirect dengan pesan error
        return redirect()->route('anggota.index')->with(['error' => 'Data Gagal Dihapus!']);
    }
}



}
