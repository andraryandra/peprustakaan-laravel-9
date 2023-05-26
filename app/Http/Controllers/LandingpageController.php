<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin\Ebook;
use App\Models\Admin\Mading;
use Illuminate\Http\Request;
use App\Models\Admin\Kategori;
use App\Models\Admin\SubKategori;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class LandingpageController extends Controller
{
    public function index()
    {
        $data_mading = Mading::with('user')->get();
        $users = User::get();

        return view('user.landingpage.home', compact(
            "data_mading",
            'users',
        ));
    }

    public function showMadingLandingPageHome($id)
    {
        $data_mading = Mading::with('mading_items')->where("id", $id)->first();

        if ($data_mading) {
            foreach ($data_mading->mading_items as $item) {
                if ($item->verifikasi_mading == 'ACTIVE') {
                    $data = [
                        "data_mading" => $data_mading,
                        "users" => User::get(),
                        "mading_latest" => Mading::get(),
                    ];

                    return view('user.anggota.tampilan.detail_mading', $data);
                }
            }
        }
        return redirect()->route('landingPage.mading')->with('error', 'Mading tidak tersedia');
    }


    public function about()
    {
        return view("user.anggota.tampilan.about");
    }

    public function mading()
    {
        $data_mading = Mading::with('user')->get();
        $users = User::get();

        return view('user.landingpage.mading', compact(
            "data_mading",
            'users',
        ));
    }

    public function detailmading()
    {
        return view("user.anggota.tampilan.detail_mading");
    }

    public function ebookLandingPage()
    {
        $buku = Ebook::with(['user'])->get();
        $subkategori = SubKategori::all();
        $kategori = Kategori::all();
        $user = User::all();

        return view("user.landingpage.ebook", compact("buku", "subkategori", "kategori", "user"));
    }

    public function showEbookLandingPageHome($id)
    {
        $ebook = Ebook::with(['user','ebook_item_verify'])->where("id", $id)->first();

        if ($ebook) {
                    foreach ($ebook->ebook_item_verify as $item) {
                        if ($item->verifikasi_ebook == 'ACTIVE') {
                $data = [
                    'ebook' => $ebook,
                    'users' => User::get(),
                    'ebook_latest' => Ebook::get(),
                ];
                return view('user.anggota.tampilan.detail_ebook', $data);
            }
        }
    }
    return redirect()->route('landingPage.ebook')->with('error', 'Ebook tidak tersedia');

    }


    public function detailebook()
    {
        return view('user.anggota.tampilan.detail_ebook');
    }

    public function artikel()
    {
        return view('user.anggota.tampilan.artikel');
    }

    public function riwayat()
    {
        return view('user.anggota.tampilan.riwayat');
    }
}
