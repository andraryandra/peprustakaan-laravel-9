<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
