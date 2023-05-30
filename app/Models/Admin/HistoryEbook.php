<?php

namespace App\Models\Admin;

use App\Models\User;
use App\Models\Admin\Ebook;
use App\Models\Admin\Kategori;
use App\Models\Admin\EbookItem;
use App\Models\Admin\SubKategori;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HistoryEbook extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ebook()
    {
        return $this->belongsTo(Ebook::class, 'ebook_id', 'id');
    }

    public function ebook_item()
    {
        return $this->belongsTo(EbookItem::class, 'ebook_item_id', 'id');
    }

    public function subkategori()
    {
        return $this->belongsTo(SubKategori::class, 'subkategori_id', 'id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }
}
