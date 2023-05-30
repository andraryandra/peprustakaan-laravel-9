<?php

namespace App\Exports;

use App\Models\Admin\Mading;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MadingExport implements FromCollection, WithHeadings
{
    protected $madings;

    public function __construct($madings)
    {
        $this->madings = $madings;
    }

    public function collection()
    {
        return $this->madings->map(function ($mading, $index) {
            $tags = json_decode($mading->tags, true);
            $formattedTags = collect($tags)->pluck('value')->implode(', ');

            return [
                $index + 1,
                $mading->user->name,
                $mading->image,
                $mading->judul,
                strip_tags($mading->content), // Menghapus tag HTML pada isi konten
                $mading->mading_items->pluck('verifikasi_mading')->implode(', '),
                $formattedTags,
                $mading->created_at->format('d-m-Y'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No.',
            'Diposting Oleh',
            'File Gambar',
            'Judul Mading',
            'Isi Content Mading',
            'Verifikasi ',
            'Tags',
            'Tanggal'
        ];
    }
}
