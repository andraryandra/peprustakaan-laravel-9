<?php

namespace App\Http\Controllers\Admin\Tampilan;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Tampilan\About;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());

        $about = About::all();

        return view('admin.tampilan.about.index', compact("user", "about"));
    }

    public function store(Request $request)
{
    $existingData = About::first();

    if ($existingData) {
        return redirect()->route('about.index')->with('gagal', 'Data hanya dapat diinputkan sekali');
    }

    $this->validate($request, [
        'image' => 'required|mimes:jpg,jpeg,png',
        'teks1' => 'required',
        'teks2' => 'required',
    ]);

    $homePath = $request->file('image')->store('landingPage', 'public');

    $about = About::create([
        'image' => $homePath,
        'teks1' => $request->teks1,
        'teks2' => $request->teks2
    ]);

    if ($about) {
        return redirect()->route('about.index')->with('berhasil', 'Data berhasil ditambahkan');
    } else {
        return redirect()->route('about.index')->with('gagal', 'Data gagal ditambahkan');
    }
}


    public function edit()
    {
        //
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'image' => 'mimes:jpg,jpeg,png',
            'teks1' => 'required',
            'teks2' => 'required',
        ]);

        $about = About::findOrFail($id);

        $homePath = $about->image;

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($homePath);
            $homePath = $request->file('image')->store('landingPage', 'public');
        }

        $about->update([
            'image' => $homePath,
            'teks1' => $request->teks1,
            'teks2' => $request->teks2
        ]);

        if ($about) {
            return redirect()->route('about.index')->with('berhasil', 'Data berhasil diperbarui');
        } else {
            return redirect()->route('about.index')->with('gagal', 'Data gagal diperbarui');
        }
    }

    public function destroy($id)
    {
        $about = About::findOrFail($id);

        $imagePath = $about->image;

        Storage::disk('public')->delete($imagePath);

        $about->delete();

        if ($about) {
            return redirect()->route('about.index')->with('berhasil', 'Data berhasil dihapus');
        } else {
            return redirect()->route('about.index')->with('gagal', 'Data gagal dihapus');
        }
    }
}
