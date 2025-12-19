<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = [
        'kategori_barang',
        'nama_barang',
        'deskripsi',
        'stok',
        'harga_per_hari',
        'foto',
    ];
}
