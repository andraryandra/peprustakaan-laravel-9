<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class EbookExport implements FromCollection, WithHeadings
{
    protected $ebooks;

    public function __construct($ebooks)
    {
        $this->ebooks = $ebooks;
    }

    public function collection()
    {
        return $this->ebooks->map(function ($ebook, $index) {

            return [
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
        });
    }

    public function headings(): array
    {
        return [
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
            'Tanggal'
        ];
    }
}
