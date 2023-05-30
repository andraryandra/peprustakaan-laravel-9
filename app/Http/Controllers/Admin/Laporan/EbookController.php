<?php

namespace App\Http\Controllers\Admin\Laporan;

use App\Models\User;
use App\Models\Admin\Ebook;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EbookController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());
        $ebook = Ebook::with(['user', 'kategori','subkategori','ebook_items','ebook_item_verify'])->get();

        return view("admin.laporan.dataebook.de_index", compact("user", "ebook"));
    }
}
