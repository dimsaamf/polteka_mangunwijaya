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
        Schema::create('inventaris_farmasis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->string('kode_barang');
            $table->integer('jumlah');
            $table->integer('jumlah_min');
            $table->string('satuan');
            $table->date('tanggal_service')->nullable();
            $table->boolean('reminder')->default(false);
            $table->boolean('sudah_dilayani')->default(false); 
            $table->integer('periode')->nullable();
            $table->integer('harga');
            $table->text('keterangan')->nullable();
            $table->string('gambar')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventaris_farmasis');
    }
};
