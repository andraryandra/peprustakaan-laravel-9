<?php

namespace App\Http\Controllers\Admin\Laporan;

use Dompdf\Dompdf;
use App\Models\User;
use Barryvdh\DomPDF\PDF;
use App\Models\Admin\Mading;
use Illuminate\Http\Request;
use App\Exports\MadingExport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\StreamedResponse;

class MadingController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());
        $madings = Mading::with(['mading_items'])->get();
        $mading_count = Mading::count();

        return view("admin.laporan.datamading.dm_index", compact(
            "user",
            "madings",
            "mading_count",
        ));
    }

    public function export()
    {
        $madings = Mading::with(['user','mading_items'])->get();

        return Excel::download(new MadingExport($madings), 'laporan_mading.xlsx');
    }

    public function exportCustom(Request $request)
    {
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalAkhir = $request->input('tanggal_akhir');

        // Query data sesuai filter tanggal
        $madings = Mading::with(['user', 'mading_items'])
            ->when($tanggalMulai, function ($query) use ($tanggalMulai) {
                $query->whereDate('created_at', '>=', $tanggalMulai);
            })
            ->when($tanggalAkhir, function ($query) use ($tanggalAkhir) {
                $query->whereDate('created_at', '<=', $tanggalAkhir);
            })
            ->get();

        // Mengubah format data menjadi array
        $exportData = [];
        foreach ($madings as $index => $mading) {
            $tags = json_decode($mading->tags, true);
            $formattedTags = collect($tags)->pluck('value')->implode(', ');

            $exportData[] = [
                $index + 1,
                $mading->user->name,
                $mading->image,
                $mading->judul,
                $mading->isi_content,
                $mading->mading_items->pluck('verifikasi_mading')->implode(', '),
                $formattedTags,
                $mading->created_at->format('d-m-Y'),
            ];
        }

        // Menentukan nama kolom pada CSV
        $headings = [
            'No.',
            'Diposting Oleh',
            'File Gambar',
            'Judul Mading',
            'Isi Content Mading',
            'Verifikasi',
            'Tags',
            'Tanggal',
        ];

         // Generate nama file dengan format laporan_mading_dd-mm-yyyy.csv
         $fileName = 'laporan_mading_' . date('d-m-Y') . '.csv';

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
        $madings = Mading::with(['user', 'mading_items'])
            ->when($tanggalMulai, function ($query) use ($tanggalMulai) {
                $query->whereDate('created_at', '>=', $tanggalMulai);
            })
            ->when($tanggalAkhir, function ($query) use ($tanggalAkhir) {
                $query->whereDate('created_at', '<=', $tanggalAkhir);
            })
            ->get();

        // Mengirim data ke view
        $data = [
            'madings' => $madings,
        ];

        // Generate nama file dengan format laporan_mading_dd-mm-yyyy.pdf
        $fileName = 'laporan_mading_' . date('d-m-Y') . '.pdf';

        // Membuat instance Dompdf
        $dompdf = new Dompdf();

        // Render tampilan ke dalam PDF
        $dompdf->loadHtml(view('admin.laporan.datamading.print', $data)->render());

        // Proses rendering PDF
        $dompdf->render();

        // Mengunduh file PDF
        return $dompdf->stream($fileName);
    }



    public function print()
    {
        $madings = Mading::with(['user', 'mading_items'])->get();

        return view('admin.laporan.datamading.print', compact('madings'));
    }

}
