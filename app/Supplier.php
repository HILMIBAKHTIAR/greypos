<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    //
    protected $fillable =
    ['perusahaan', 'nama_supplier', 'no_telp', 'situs_web', 'email', 'alamat', 'kota', 'kode_pos', 'catatan'];
}
