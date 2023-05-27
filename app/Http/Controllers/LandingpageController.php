<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin\Ebook;
use App\Models\Admin\EbookItem;
use App\Models\Admin\Mading;
use Illuminate\Http\Request;
use App\Models\Admin\Kategori;
use App\Models\Admin\SubKategori;
use Illuminate\Routing\Controller;
use App\Models\Admin\Tampilan\Home;
use App\Models\Admin\Tampilan\About;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Tampilan\Footer;

class LandingpageController extends Controller
{
    public function index()
    {
        $home = Home::get();
        $data_mading = Mading::with('user')->get();
        $users = User::get();
        $footer = Footer::get();

        return view('user.landingpage.home', compact(
            "data_mading",
            'users',
            'home',
            'footer',
        ));
    }

    public function showMadingLandingPageHome($id)
    {
        $data_mading = Mading::with('mading_items')->where("id", $id)->first();
        $footer = Footer::get();

        if ($data_mading) {
            foreach ($data_mading->mading_items as $item) {
                if ($item->verifikasi_mading == 'ACTIVE') {
                    $data = [
                        "data_mading" => $data_mading,
                        "users" => User::get(),
                        "mading_latest" => Mading::get(),
                        'footer' => $footer,
                    ];

                    return view('user.anggota.tampilan.detail_mading', $data);
                }
            }
        }
        return redirect()->route('landingPage.mading')->with('error', 'Mading tidak tersedia');
    }


    public function about()
    {

        $about = About::all();
        $footer = Footer::get();


        return view("user.landingpage.about", compact("about", "footer"));
    }

    public function mading()
    {
        $data_mading = Mading::with('user')->get();
        $users = User::get();
        $footer = Footer::get();

        return view('user.landingpage.mading', compact(
            "data_mading",
            'users',
            'footer',
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
        $footer = Footer::get();


        return view("user.landingpage.ebook", compact("buku", "subkategori", "kategori", "user", "footer"));
    }

    public function showEbookLandingPageHome($id)
    {
        $ebook = Ebook::with(['user','ebook_item_verify'])->where("id", $id)->first();
        $footer = Footer::get();
        $isi_buku = EbookItem::where('ebook_id', $id)->get();

        if ($ebook) {
                    foreach ($ebook->ebook_item_verify as $item) {
                        if ($item->verifikasi_ebook == 'ACTIVE') {
                $data = [
                    'ebook' => $ebook,
                    'users' => User::get(),
                    'ebook_latest' => Ebook::get(),
                    'footer' => $footer,
                    'isi_buku' => $isi_buku,
                ];
                return view('user.anggota.tampilan.detail_ebook', $data);
            }
        }
    }
    return redirect()->route('landingPage.ebook')->with('error', 'Ebook tidak tersedia');

    }

    public function indexfooter()
    {
        $footer = Footer::get();

        return view('layouts_user.footer', compact('footer'));
    }

    public function detailebook()
    {
        return view('user.anggota.tampilan.detail_ebook');
    }

    public function ebookStory($id)
    {
        $footer = Footer::get();
        $buku = Ebook::with(['ebook_item_verify'])->get();
        $isi_buku = EbookItem::findOrFail($id);

        $nextId = EbookItem::where('id', '>', $id)->min('id');
        $previousId = EbookItem::where('id', '<', $id)->max('id');

        return view('user.anggota.tampilan.detail_item_ebook', compact('footer', 'buku', 'isi_buku', 'nextId', 'previousId'));
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
