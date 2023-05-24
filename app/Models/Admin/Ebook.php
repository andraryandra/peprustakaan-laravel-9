<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ebook extends Model
{
    use HasFactory;

    protected $guarded = [' '];

    protected $table = "ebooks";

    public function kategori()
    {
        return $this->belongsTo("App\Models\Admin\Kategori","kategori_id", "id");
    }

    public function subkategori()
    {
        return $this->belongsTo("App\Models\Admin\SubKategori","subkategori_id", "id");
    }
}
