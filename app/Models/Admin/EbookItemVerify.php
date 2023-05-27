<?php

namespace App\Models\Admin;

use App\Models\Admin\EbookItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EbookItemVerify extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function ebook()
    {
        return $this->belongsTo(Ebook::class);
    }


    public function ebook_item()
    {
        return $this->belongsTo(EbookItem::class, 'ebook_id', 'id');
    }
}
