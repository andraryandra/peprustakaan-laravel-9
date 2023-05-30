<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin\Ebook;
use App\Models\Admin\Mading;
use Illuminate\Http\Request;
use App\Models\Admin\Kategori;
use App\Models\Admin\EbookItem;
use App\Models\Admin\SubKategori;
use App\Models\Admin\HistoryEbook;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
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
        $kategori = Kategori::all();

        return view('user.landingpage.home', compact(
            "data_mading",
            'users',
            'home',
            'footer',
            'kategori',
        ));
    }

    public function showMadingLandingPageHome($slug)
    {
        $data_mading = Mading::with('mading_items')->where("slug", $slug)->first();
        $footer = Footer::get();

        if ($data_mading) {
            foreach ($data_mading->mading_items as $item) {
                if ($item->verifikasi_mading == 'ACTIVE') {
                    $data = [
                        "data_mading" => $data_mading,
                        "users" => User::get(),
                        "mading_latest" => Mading::with(['mading_items'])->get(),
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
        $data_mading = Mading::with('user')->paginate(15);
        $users = User::get();
        $footer = Footer::get();

        return view('user.landingpage.mading', compact(
            "data_mading",
            'users',
            'footer',
        ));
    }

    public function madingSearch(Request $request)
{
    $search = $request->input('search');

    $query = Mading::with('user');

    if ($search) {
        $query->where('judul', 'LIKE', "%$search%");
    }

    $data_mading = $query->paginate(15);
    $users = User::get();
    $footer = Footer::get();

    return view('user.anggota.tampilan.search.mading_search', compact(
        'data_mading',
        'users',
        'footer',
        'search'
    ));
}



    public function detailmading()
    {
        return view("user.anggota.tampilan.detail_mading");
    }

    public function ebookLandingPage(Request $request)
    {
        $subkategori = SubKategori::all();
        $kategori = Kategori::all();
        $user = User::all();
        $footer = Footer::get();

        // Mengambil data buku berdasarkan pencarian query
        $buku = Ebook::with(['user'])
            ->paginate(5);

        return view("user.landingpage.ebook", compact("buku", "subkategori", "kategori", "user", "footer"));
    }

    public function ebookSearch(Request $request)
    {
        $keyword = $request->input('keyword');

        $buku = Ebook::with(['user', 'ebook_items'])
            ->where('judul_buku', 'LIKE', "%$keyword%")
            ->orWhere('penulis', 'LIKE', "%$keyword%")
            ->orWhereHas('ebook_items', function ($query) use ($keyword) {
                $query->where('judul_part', 'LIKE', "%$keyword%")
                    ->orWhere('content_part', 'LIKE', "%$keyword%");
            })
            ->paginate(15);

        $subkategori = SubKategori::all();
        $kategori = Kategori::all();
        $user = User::all();
        $footer = Footer::get();

        return view('user.anggota.tampilan.search.ebook_search', compact('buku', 'subkategori', 'kategori', 'user', 'footer'))->with('keyword', $keyword);
    }





    public function showEbookLandingPageHome($slug)
{
    $ebook = Ebook::with(['user', 'ebook_item_verify'])->where("slug", $slug)->first();

    if (!$ebook) {
        return redirect()->route('landingPage.ebook')->with('error', 'Ebook tidak tersedia');
    }

    $footer = Footer::get();
    $isi_buku = EbookItem::where('ebook_id', $ebook->id)->get();

    foreach ($ebook->ebook_item_verify as $item) {
        if ($item->verifikasi_ebook == 'ACTIVE') {
            $data = [
                'ebook' => $ebook,
                'users' => User::get(),
                'ebook_latest' => Ebook::with(['ebook_item_verify'])->get(),
                'footer' => $footer,
                'isi_buku' => $isi_buku,
            ];

            // Cek apakah ada history ebook untuk pengguna saat ini
            if (auth()->check()) {
                $userId = auth()->user()->id;
                $history = HistoryEbook::where('user_id', $userId)
                    ->where('ebook_id', $ebook->id)
                    ->orderBy('created_at', 'desc')
                    ->first();

                if ($history) {
                    $slugEbookItem = $history->slug_ebook_item;
                    $data['buttonLink'] = route('landingPage.ebookStory', $slugEbookItem);
                    $data['buttonText'] = 'Lanjutkan Membaca';
                } else {
                    if ($isi_buku->isNotEmpty()) { // Check if $isi_buku is not empty
                        $data['buttonLink'] = route('landingPage.ebookStory', $isi_buku->first()->slug);
                    } else {
                        $data['buttonLink'] = route('landingPage.ebook');
                    }
                    $data['buttonText'] = 'Mulai Membaca';
                }
            } else {
                if ($isi_buku->isNotEmpty()) { // Check if $isi_buku is not empty
                    $data['buttonLink'] = route('landingPage.ebookStory', $isi_buku->first()->slug);
                } else {
                    $data['buttonLink'] = route('landingPage.ebook');
                }
                $data['buttonText'] = 'Mulai Membaca';
            }

            return view('user.anggota.tampilan.detail_ebook', $data);
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

    public function ebookStory($slug)
{
    $footer = Footer::get();
    $buku = Ebook::with(['ebook_item_verify'])->get();
    $isi_buku = EbookItem::where('slug', $slug)->first();

    if (!$isi_buku) {
        abort(404); // Jika tidak ditemukan, tampilkan halaman 404
    }

    $nextSlug = EbookItem::where('ebook_id', $isi_buku->ebook_id)->where('id', '>', $isi_buku->id)->min('slug');
    $previousSlug = EbookItem::where('ebook_id', $isi_buku->ebook_id)->where('id', '<', $isi_buku->id)->max('slug');

    // Tambahkan logika untuk menambahkan atau memperbarui data history
    if (auth()->check()) {
        $userId = auth()->user()->id;
        $ebookId = $isi_buku->ebook_id;
        $ebookItemId = $isi_buku->id;
        $slugEbook = $isi_buku->ebook->slug; // Ambil nilai slug dari relasi ebook
        $slugEbookItem = $isi_buku->slug; // Ambil nilai slug dari $isi_buku

        $history = HistoryEbook::firstOrNew(
            [
                'user_id' => $userId,
                'ebook_id' => $ebookId,
                'ebook_item_id' => $ebookItemId,
            ]
        );

        // Perbarui nilai accessed_ebook_at dan accessed_ebook_item_at jika belum terisi
        if (!$history->accessed_ebook_at) {
            $history->accessed_ebook_at = Carbon::now();
        }
        if (!$history->accessed_ebook_item_at) {
            $history->accessed_ebook_item_at = Carbon::now();
        }

        $history->slug_ebook = $slugEbook; // Simpan nilai slug ebook pada entri history
        $history->slug_ebook_item = $slugEbookItem; // Simpan nilai slug ebook item pada entri history

        $history->save();
    }

    return view('user.anggota.tampilan.detail_item_ebook', compact('footer', 'buku', 'isi_buku', 'nextSlug', 'previousSlug'));
}



    // public function artikel()
    // {

    //     $footer = Footer::get();

    //     return view('user.anggota.tampilan.artikel', compact('footer'));
    // }

    public function riwayatEbook()
{
    $user_id = Auth::user()->id;

    $subquery = HistoryEbook::select(DB::raw('MAX(id)'))
        ->where('user_id', $user_id)
        ->groupBy('ebook_id');

    $history_ebook = HistoryEbook::whereIn('id', $subquery)
        ->with(['ebook', 'ebook_item'])
        ->paginate(10);

    $footer = Footer::get();

    return view('user.anggota.tampilan.riwayat_ebook', compact('footer', 'history_ebook'));
}






}
