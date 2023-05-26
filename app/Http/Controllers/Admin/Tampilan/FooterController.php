<?php

namespace App\Http\Controllers\Admin\Tampilan;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Tampilan\Footer;
use Illuminate\Support\Facades\Storage;

class FooterController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());

        $footer = Footer::get();

        return view("admin.tampilan.footer.index", compact("user", "footer"));
    }

    public function store(Request $request)
    {
        // $existingData = Footer::first();

        // if ($existingData) {
        //     return redirect()->route('footer.index')->with('gagal', 'Data hanya dapat diinputkan sekali');
        // }

        $this->validate($request, [
            'image' => 'required|mimes:jpg,jpeg,png',
            'teks1' => 'required',
            'teks2' => 'required',
        ]);

        $homePath = $request->file('image')->store('landingPage', 'public');

        $footer = Footer::create([
            'image' => $homePath,
            'teks1' => $request->teks1,
            'teks2' => $request->teks2
        ]);

        if ($footer) {
            return redirect()->route('footer.index')->with('berhasil', 'Data berhasil ditambahkan');
        } else {
            return redirect()->route('footer.index')->with('gagal', 'Data gagal ditambahkan');
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'image' => 'mimes:jpg,jpeg,png',
            'teks1' => 'required',
            'teks2' => 'required',
        ]);

        $footer = Footer::findOrFail($id);

        $homePath = $footer->image;

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($homePath);
            $homePath = $request->file('image')->store('landingPage', 'public');
        }

        $footer->update([
            'image' => $homePath,
            'teks1' => $request->teks1,
            'teks2' => $request->teks2
        ]);

        if ($footer) {
            return redirect()->route('footer.index')->with('berhasil', 'Data berhasil diperbarui');
        } else {
            return redirect()->route('footer.index')->with('gagal', 'Data gagal diperbarui');
        }
    }

    public function destroy($id)
    {
        $footer = Footer::findOrFail($id);

        $imagePath = $footer->image;

        Storage::disk('public')->delete($imagePath);

        $footer->delete();

        if ($footer) {
            return redirect()->route('footer.index')->with('berhasil', 'Data berhasil dihapus');
        } else {
            return redirect()->route('footer.index')->with('gagal', 'Data gagal dihapus');
        }
    }

}
