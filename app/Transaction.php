<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    protected $fillable =
    [
        'kode_transaksi',
        'total_produk',
        'subtotal',
        'diskon',
        'total',
        'bayar',
        'kembali',
        'id_kasir',
        'kasir',
        'pembeli',
        'no_meja',
    ];

    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class);
    }
}
