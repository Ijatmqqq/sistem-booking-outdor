<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    Schema::create('sewa', function (Blueprint $table) {
        $table->id();
        $table->string('nama_penyewa');
        $table->string('nik')->nullable();
        $table->text('alamat')->nullable();
        $table->string('no_hp')->nullable();
        $table->string('nama_barang');
        $table->date('tanggal_pinjam');
        $table->date('tanggal_kembali');
        $table->integer('jumlah');
        $table->bigInteger('total_harga');
        $table->bigInteger('denda')->default(0);
        $table->enum('status_denda',['Belum','Lunas'])->default('Belum');
        $table->text('keterangan')->nullable();
        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sewas');
    }
};
