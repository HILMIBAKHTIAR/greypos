<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kategori extends Model
{
    //
    protected $fillable = [
        'nama_kategori'
    ];

    public function Produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
