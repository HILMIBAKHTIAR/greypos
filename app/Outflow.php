<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outflow extends Model
{
    //
    protected $fillable = 
    [
        'tanggal pembelian',
        'keterangan',
        'jumlah_pembelian',
        'invoice'
    ];
}
