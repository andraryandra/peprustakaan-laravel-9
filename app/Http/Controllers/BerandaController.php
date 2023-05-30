<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin\Ebook;
use App\Models\Admin\Mading;
use Illuminate\Http\Request;
use App\Models\Admin\HistoryEbook;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BerandaController extends Controller
{
    public function index()
{
    $user = User::findOrFail(Auth::id());
    $users = User::all();
    $users_count = User::count();
    $users_anggota_count = User::where('level', '1')->count();

    $ebook_count = Ebook::count();
    $mading_count = Mading::count();

    // Mengambil data ebook yang paling banyak dibaca beserta nama ebooknya
    $ebookChartData = HistoryEbook::select('ebook_id', DB::raw('COUNT(*) as total_access'))
        ->groupBy('ebook_id')
        ->orderByDesc('total_access')
        ->limit(5)
        ->get();

    $ebookIds = $ebookChartData->pluck('ebook_id')->toArray();
    $ebooks = Ebook::whereIn('id', $ebookIds)->pluck('judul_buku', 'id')->toArray();

    $ebookData = $ebookChartData->pluck('total_access')->toArray();

    // Mengambil data jumlah pengguna berdasarkan peran
    $usersChartData = User::select('level', DB::raw('COUNT(*) as total_users'))
        ->groupBy('level')
        ->get();

    $usersData = $usersChartData->pluck('total_users', 'level')->toArray();

    // Mengambil data total ebook yang dibuat pada setiap tanggal
    $ebookCreationData = Ebook::select(DB::raw('DATE(created_at) as creation_date'), DB::raw('COUNT(*) as total_creation'))
        ->groupBy('creation_date')
        ->get();

    $ebookDates = $ebookCreationData->pluck('creation_date')->toArray();
    $ebookCreationCounts = $ebookCreationData->pluck('total_creation')->toArray();

    // Mengambil data total mading yang dibuat pada setiap tanggal
    $madingCreationData = Mading::select(DB::raw('DATE(created_at) as creation_date'), DB::raw('COUNT(*) as total_creation'))
        ->groupBy('creation_date')
        ->get();

    $madingDates = $madingCreationData->pluck('creation_date')->toArray();
    $madingCreationCounts = $madingCreationData->pluck('total_creation')->toArray();

    return view('admin.dashboard', compact(
        "user",
        'users',
        'users_count',
        'users_anggota_count',
        'mading_count',
        'ebook_count',
        'ebookData',
        'ebooks',
        'usersData',
        'ebookDates',
        'ebookCreationCounts',
        'madingDates',
        'madingCreationCounts'
    ));
}





}
