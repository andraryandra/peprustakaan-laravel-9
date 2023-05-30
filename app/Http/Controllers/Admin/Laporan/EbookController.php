<?php

namespace App\Http\Controllers\Admin\Laporan;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\User;
use App\Models\Admin\Ebook;
use App\Exports\EbookExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\StreamedResponse;

class EbookController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());
        $ebook = Ebook::with(['user', 'kategori','subkategori','ebook_items','ebook_item_verify'])->get();

        return view("admin.laporan.dataebook.de_index", compact("user", "ebook"));
    }

    public function export()
    {
        $madings = Ebook::with(['user','ebook_item_verify','subkategori','kategori'])->get();

        return Excel::download(new EbookExport($madings), 'laporan_ebook.xlsx');
    }

    public function exportCustom(Request $request)
{
    $tanggalMulai = $request->input('tanggal_mulai');
    $tanggalAkhir = $request->input('tanggal_akhir');

    // Query data sesuai filter tanggal
    $ebooks = Ebook::with(['user', 'kategori', 'subkategori', 'ebook_item_verify'])
        ->when($tanggalMulai, function ($query) use ($tanggalMulai) {
            $query->whereDate('created_at', '>=', $tanggalMulai);
        })
        ->when($tanggalAkhir, function ($query) use ($tanggalAkhir) {
            $query->whereDate('created_at', '<=', $tanggalAkhir);
        })
        ->get();

    // Mengubah format data menjadi array
    $exportData = [];
    foreach ($ebooks as $index => $ebook) {
        $exportData[] = [
            $index + 1,
            $ebook->user->name,
            $ebook->kategori->nama_kategori,
            $ebook->subkategori->subkategori,
            $ebook->cover,
            $ebook->file,
            $ebook->judul_buku,
            strip_tags($ebook->sinopsis), // Menghapus tag HTML pada isi konten
            $ebook->penulis,
            $ebook->tahun_terbit,
            $ebook->ebook_item_verify->pluck('verifikasi_ebook')->implode(', '),
            $ebook->slug,
            $ebook->created_at->format('d-m-Y'),
        ];
    }

    // Menentukan nama kolom pada CSV
    $headings = [
        'No.',
        'Diposting Oleh',
        'Kategori',
        'Sub Kategori',
        'File Gambar',
        'File Ebook',
        'Judul Buku',
        'Sinopsis ',
        'Penulis',
        'Tahun Terbit',
        'Status',
        'Slug',
        'Tanggal',
    ];

    // Generate nama file dengan format laporan_ebook_dd-mm-yyyy.csv
    $fileName = 'laporan_ebook_' . date('d-m-Y') . '.csv';

    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename=' . $fileName,
    ];

    $callback = function () use ($exportData, $headings) {
        $file = fopen('php://output', 'w');
        fputcsv($file, $headings);

        foreach ($exportData as $data) {
            fputcsv($file, $data);
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
    $ebooks = Ebook::with(['user', 'kategori', 'subkategori', 'ebook_item_verify'])
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
        'Diposting Oleh',
        'Kategori',
        'Sub Kategori',
        'File Gambar',
        'File Ebook',
        'Judul Buku',
        'Sinopsis',
        'Penulis',
        'Tahun Terbit',
        'Status',
        'Slug',
        'Tanggal',
    ];

    // Generate nama file dengan format laporan_ebook_dd-mm-yyyy.pdf
    $fileName = 'laporan_ebook_' . date('d-m-Y') . '.pdf';

    // Generate PDF
    $pdfOptions = new Options();
    $pdfOptions->set('defaultFont', 'Arial');
    $pdfOptions->set('isRemoteEnabled', true);

    $dompdf = new Dompdf($pdfOptions);
    $dompdf->loadHtml(view('admin.laporan.dataebook.print', compact('ebooks', 'headings')));
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();

    // Generate and download PDF file
    $dompdf->stream($fileName);
}

    public function print()
    {
        $ebooks = Ebook::with(['user','ebook_item_verify','subkategori','kategori'])->get();

        return view('admin.laporan.dataebook.print', compact('ebooks'));
    }
}
