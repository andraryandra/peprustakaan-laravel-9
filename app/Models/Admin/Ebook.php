<?php

namespace App\Models\Admin;

use App\Models\User;
use App\Models\Admin\Kategori;
use App\Models\Admin\SubKategori;
use App\Models\Admin\EbookItemVerify;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ebook extends Model
{
    use HasFactory;

    protected $guarded = [''];

    protected $table = "ebooks";

    public function kategori()
    {
        return $this->belongsTo(Kategori::class,"kategori_id", "id");
    }

    public function subkategori()
    {
        return $this->belongsTo(SubKategori::class,"subkategori_id", "id");
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function ebook_item_verify()
    {
        return $this->hasMany(EbookItemVerify::class, 'ebook_id', 'id');
    }
}
