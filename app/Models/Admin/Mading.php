<?php

namespace App\Models\Admin;

use App\Models\User;
use App\Models\Admin\MadingItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mading extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function mading_items()
    {
        return $this->hasMany(MadingItem::class, 'mading_id', 'id');
    }
}
