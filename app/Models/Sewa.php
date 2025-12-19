<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sewa extends Model
{
    protected $table = 'sewa';
    protected $fillable = [
        'nama_penyewa','nik','alamat','no_hp','nama_barang',
        'tanggal_pinjam','tanggal_kembali','jumlah',
        'total_harga','denda','status_denda','keterangan'
    ];
}
