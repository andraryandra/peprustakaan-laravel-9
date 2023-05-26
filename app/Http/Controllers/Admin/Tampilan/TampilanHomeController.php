<?php

namespace App\Http\Controllers\Admin\Tampilan;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Admin\Tampilan\Home;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Tampilan\Footer;
use Illuminate\Support\Facades\Storage;

class TampilanHomeController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());

        $home = Home::get();

        return view("admin.tampilan.landingpage.index", compact("user", "home"));
    }

    public function store(Request $request)
    {
        $existingData = Home::first();

        if ($existingData) {
            return redirect()->route('home.index')->with('gagal', 'Data hanya dapat diinputkan sekali');
        }

        $this->validate($request, [
            'image' => 'required|mimes:jpg,jpeg,png',
            'teks1' => 'required',
            'teks2' => 'required',
        ]);

        $homePath = $request->file('image')->store('landingPage', 'public');

        $home = Home::create([
            'image' => $homePath,
            'teks1' => $request->teks1,
            'teks2' => $request->teks2
        ]);

        if ($home) {
            return redirect()->route('home.index')->with('berhasil', 'Data berhasil ditambahkan');
        } else {
            return redirect()->route('home.index')->with('gagal', 'Data gagal ditambahkan');
        }
    }


    // public function edit(Request $request)
    // {
    //     $data = [
    //         "edit" => Home::where("id", $request->id)->first()
    //     ];

    //     return view("admin.tampilan.landingpage.edit", $data);
    // }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'image' => 'mimes:jpg,jpeg,png',
            'teks1' => 'required',
            'teks2' => 'required',
        ]);

        $home = Home::findOrFail($id);

        $homePath = $home->image;

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($homePath);
            $homePath = $request->file('image')->store('landingPage', 'public');
        }

        $home->update([
            'image' => $homePath,
            'teks1' => $request->teks1,
            'teks2' => $request->teks2
        ]);

        if ($home) {
            return redirect()->route('home.index')->with('berhasil', 'Data berhasil diperbarui');
        } else {
            return redirect()->route('home.index')->with('gagal', 'Data gagal diperbarui');
        }
    }

    public function destroy($id)
    {
        $home = Home::findOrFail($id);

        $imagePath = $home->image;

        Storage::disk('public')->delete($imagePath);

        $home->delete();

        if ($home) {
            return redirect()->route('home.index')->with('berhasil', 'Data berhasil dihapus');
        } else {
            return redirect()->route('home.index')->with('gagal', 'Data gagal dihapus');
        }
    }


}
