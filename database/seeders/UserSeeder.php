<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'          => 'admin',
            'nama_lengkap'  => 'Administrator',
            'email'         => 'admin@gmail.com',
            'password'      => Hash::make('password'),
            'role'          => 'admin',
            'nik'           => '1234567890123456',
            'alamat'        => 'Jl. Admin No. 1',
            'no_hp'         => '081234567890',
            'pekerjaan'     => 'Admin Sistem'
        ]);

        User::create([
            'name'          => 'user',
            'nama_lengkap'  => 'User Biasa',
            'email'         => 'user@gmail.com',
            'password'      => Hash::make('password'),
            'role'          => 'user',
            'nik'           => '0987654321098765',
            'alamat'        => 'Jl. User No. 2',
            'no_hp'         => '089876543210',
            'pekerjaan'     => 'Mahasiswa'
        ]);
    }
}

