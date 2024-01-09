<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lembur extends Model
{
    use HasFactory;

    protected $fillable = [
        'karyawan_id', 'tanggal_lembur', 'jam_mulai', 'jam_selesai', 'hasil_lembur'
    ];
}
