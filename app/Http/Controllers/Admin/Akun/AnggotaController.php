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
    $request->validate([
        'photo' => 'required|image',
        'name' => 'required',
        'username' => 'required',
        'email' => 'required|email',
        'alamat' => 'required',
        'keterangan' => 'required',
        'jenis_kelamin' => 'required',
        'password' => 'required',
    ], [
        'photo.required' => 'Foto harus diunggah.',
        'photo.image' => 'Foto harus berupa file gambar.',
        'name.required' => 'Nama harus diisi.',
        'username.required' => 'Username harus diisi.',
        'email.required' => 'Email harus diisi.',
        'email.email' => 'Format email tidak valid.',
        'alamat.required' => 'Alamat harus diisi.',
        'keterangan.required' => 'Keterangan harus diisi.',
        'jenis_kelamin.required' => 'Jenis kelamin harus diisi.',
        'password.required' => 'Password harus diisi.',
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
        'alamat' => $request->alamat,
        'keterangan' => $request->keterangan,
        'jenis_kelamin' => $request->jenis_kelamin,
        'password' => bcrypt($request->password),
        'level' => 1,
        'status' => 'ACTIVE',
    ]);

    if ($users) {
        //redirect dengan pesan sukses
        return redirect()->route('anggota.index')->with(['berhasil' => 'Data Berhasil Disimpan!']);
    } else {
        //redirect dengan pesan error
        return back()->with(['gagal' => 'Data Gagal Disimpan!']);
    }
}


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
            'keterangan' => 'required|max:255',
            'password' => 'nullable',
            'level' => 'nullable',
        ],
        [
            'name.required' => 'Nama harus diisi!',
            'username.required' => 'Username harus diisi!',
            'email.required' => 'Email harus diisi!',
            'email.email' => 'Email tidak valid!',
            'alamat.required' => 'Alamat harus diisi!',
            'keterangan.required' => 'Keterangan harus diisi!',
            'keterangan.max' => 'Keterangan tidak boleh lebih dari :max karakter.',
            'password.required' => 'Password harus diisi!',
            'level.required' => 'Level harus diisi!',
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
            return back()->with(['gagal' => 'Data Gagal Diperbarui!']);
        }
    }


    public function destroy($id)
{
    $user = User::findOrFail($id);
    $userPath = $user->photo; // Menyimpan path foto pengguna

    // Memeriksa apakah ada foto pengguna sebelum menghapusnya
    if (!empty($userPath) && Storage::disk('public')->exists($userPath)) {
        // Menghapus foto pengguna
        Storage::disk('public')->delete($userPath);
    }

    // Menghapus data pengguna
    $user->delete();

    // Redirect dengan pesan sukses
    if ($user) {
        // Redirect dengan pesan sukses
        return redirect()->route('anggota.index')->with(['berhasil' => 'Data Berhasil Dihapus!']);
    } else {
        // Redirect dengan pesan error
        return redirect()->route('anggota.index')->with(['gagal' => 'Data Gagal Dihapus!']);
    }
}





}
