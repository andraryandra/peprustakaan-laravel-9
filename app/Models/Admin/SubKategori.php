<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Kategori;

class SubKategori extends Model
{
    use HasFactory;

    protected $guarded = [''];

    protected $table = "subkategoris";

    public function kategori()
    {
        return $this->belongsTo(Kategori::class,"kategori_id", "id");
    }
}
