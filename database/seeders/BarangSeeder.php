<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('barangs')->insert([
            [
                'kategori_barang' => 'Tenda',
                'nama_barang'     => 'Tenda Kapasitas 2–3 Orang',
                'deskripsi'       => 'Tenda ringan untuk 2-3 orang, cocok untuk pendakian singkat.',
                'stok'            => 5,
                'harga_per_hari'  => 20000,
                'foto'            => 'dummy1.png'
            ],
            [
                'kategori_barang' => 'Tenda',
                'nama_barang'     => 'Tenda Kapasitas 4–5 Orang',
                'deskripsi'       => 'Tenda ukuran besar untuk 4-5 orang.',
                'stok'            => 3,
                'harga_per_hari'  => 25000,
                'foto'            => 'dummy2.png'
            ],
            [
                'kategori_barang' => 'Tas',
                'nama_barang'     => 'Tas Carrier 40–70 L',
                'deskripsi'       => 'Tas carrier besar cocok untuk pendakian beberapa hari.',
                'stok'            => 6,
                'harga_per_hari'  => 15000,
                'foto'            => 'dummy3.png'
            ],
            [
                'kategori_barang' => 'Sepatu',
                'nama_barang'     => 'Sepatu Outdoor',
                'deskripsi'       => 'Sepatu gunung ukuran M-XL.',
                'stok'            => 10,
                'harga_per_hari'  => 15000,
                'foto'            => 'dummy4.png'
            ],
            [
                'kategori_barang' => 'Perlengkapan Tidur',
                'nama_barang'     => 'Sleeping Bag',
                'deskripsi'       => 'Sleeping bag untuk suhu dingin.',
                'stok'            => 8,
                'harga_per_hari'  => 10000,
                'foto'            => 'dummy5.png'
            ],
            [
                'kategori_barang' => 'Pakaian',
                'nama_barang'     => 'Jaket Size M-XXL',
                'deskripsi'       => 'Jaket outdoor dengan berbagai ukuran.',
                'stok'            => 7,
                'harga_per_hari'  => 15000,
                'foto'            => 'dummy6.png'
            ],
            [
                'kategori_barang' => 'Perlengkapan Tidur',
                'nama_barang'     => 'Matras Spon',
                'deskripsi'       => 'Matras busa ringan.',
                'stok'            => 12,
                'harga_per_hari'  => 5000,
                'foto'            => 'dummy7.png'
            ],
            [
                'kategori_barang' => 'Peralatan Masak',
                'nama_barang'     => 'Kompor Kecil',
                'deskripsi'       => 'Kompor portable untuk camping.',
                'stok'            => 4,
                'harga_per_hari'  => 8000,
                'foto'            => 'dummy8.png'
            ],
        ]);
    }
}
