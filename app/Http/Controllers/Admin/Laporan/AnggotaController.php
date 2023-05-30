<?php

namespace App\Http\Controllers\Admin\Laporan;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Admin\HistoryEbook;
use App\Exports\HistoryEbookExport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AnggotaController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());
        $users = User::get();
        $users_count = User::count();
        $historyEbooks = HistoryEbook::with(['user', 'ebook', 'ebook_item','subkategori','kategori'])->get();

        return view("admin.laporan.dataanggota.de_index", compact(
            "user",
            "users",
            "users_count",
            "historyEbooks"

        ));
    }

    public function exportCustom(Request $request)
{
    $tanggalMulai = $request->input('tanggal_mulai');
    $tanggalAkhir = $request->input('tanggal_akhir');

    // Query data sesuai filter tanggal
    $historyEbooks = HistoryEbook::with(['user', 'ebook', 'ebook_item'])
        ->when($tanggalMulai, function ($query) use ($tanggalMulai) {
            $query->whereDate('created_at', '>=', $tanggalMulai);
        })
        ->when($tanggalAkhir, function ($query) use ($tanggalAkhir) {
            $query->whereDate('created_at', '<=', $tanggalAkhir);
        })
        ->get();

    // Menentukan nama kolom pada CSV
    $headings = [
        'No.',
        'User',
        'Keterangan User',
        'Kategori Ebook',
        'Sub Kategori Ebook',
        'Judul Ebook',
        'Judul Item Ebook',
        'Link Ebook',
        'Waktu Akses Item Ebook',
    ];

    // Generate nama file dengan format riwayat_ebook_dd-mm-yyyy.csv
    $fileName = 'riwayat_ebook_' . date('d-m-Y') . '.csv';

    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename=' . $fileName,
    ];

    $callback = function () use ($historyEbooks, $headings) {
        $file = fopen('php://output', 'w');
        fputcsv($file, $headings);

        foreach ($historyEbooks as $index => $historyEbook) {
            fputcsv($file, [
                $index + 1,
                $historyEbook->user->name,
                $historyEbook->user->keterangan,
                $historyEbook->ebook->kategori->nama_kategori,
                $historyEbook->ebook->subkategori->subkategori,
                $historyEbook->ebook->judul_buku,
                $historyEbook->ebook_item->judul_part,
                $historyEbook->slug_ebook_item,
                $historyEbook->accessed_ebook_item_at,
            ]);
        }

        fclose($file);
    };

    return new StreamedResponse($callback, 200, $headers);
}

    public function printCustom(Request $request)
    {
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalAkhir = $request->input('tanggal_akhir');

        // Query data sesuai filter tanggal
        $historyEbooks = HistoryEbook::with(['user', 'ebook', 'ebook_item','subkategori','kategori'])
            ->when($tanggalMulai, function ($query) use ($tanggalMulai) {
                $query->whereDate('created_at', '>=', $tanggalMulai);
            })
            ->when($tanggalAkhir, function ($query) use ($tanggalAkhir) {
                $query->whereDate('created_at', '<=', $tanggalAkhir);
            })
            ->get();

        // Menentukan nama kolom pada tabel
        $headings = [
            'No.',
            'User',
            'Keterangan User',
            'Kategori Ebook',
            'Sub Kategori Ebook',
            'Judul Ebook',
            'Judul Item Ebook',
            'Link Ebook',
            'Waktu Akses Item Ebook',
        ];

        // Generate nama file dengan format riwayat_ebook_dd-mm-yyyy.pdf
        $fileName = 'riwayat_ebook_' . date('d-m-Y') . '.pdf';

        // Generate PDF
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        $pdfOptions->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($pdfOptions);
        $dompdf->loadHtml(view('admin.laporan.dataanggota.print', compact('historyEbooks', 'headings')));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Generate and download PDF file
        $dompdf->stream($fileName);
    }

    public function export(Request $request)
    {
        $historyEbooks = HistoryEbook::with(['user', 'ebook', 'ebook_item','subkategori','kategori'])->get();

        return Excel::download(new HistoryEbookExport($historyEbooks), 'history_ebook.xlsx');
    }

    public function print()
    {
        $historyEbooks = HistoryEbook::with(['user','ebook','subkategori','kategori'])->get();

        return view('admin.laporan.dataanggota.print', compact('historyEbooks'));
    }
}
