<?php

namespace App\Exports;

use App\Models\Admin\HistoryEbook;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class HistoryEbookExport implements FromCollection, WithHeadings
{
    protected $historyEbooks;

    public function __construct($historyEbooks)
    {
        $this->historyEbooks = $historyEbooks;
    }

    public function collection()
    {
        return $this->historyEbooks->map(function ($historyEbook, $index) {
            return [
                $index + 1,
                $historyEbook->user->name,
                $historyEbook->user->keterangan,
                $historyEbook->ebook->kategori->nama_kategori,
                $historyEbook->ebook->subkategori->subkategori,
                $historyEbook->ebook->judul_buku,
                $historyEbook->ebook_item->judul_part,
                $historyEbook->slug_ebook_item,
                $historyEbook->accessed_ebook_item_at,
            ];
        });
    }

    public function headings(): array
    {
        return [
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
    }
}
