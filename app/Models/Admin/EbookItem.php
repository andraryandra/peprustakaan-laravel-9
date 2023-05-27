<?php

namespace App\Models\Admin;

use App\Models\User;
use App\Models\Admin\Ebook;
use App\Models\Admin\EbookItemVerify;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EbookItem extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function ebook()
    {
        return $this->belongsTo(Ebook::class, 'ebook_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function ebook_item_verify()
    {
        return $this->hasOne(EbookItemVerify::class, 'ebook_id', 'id');
    }
}
