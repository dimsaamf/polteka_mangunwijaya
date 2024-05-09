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
        Schema::create('inventaris_lab_kimia_fisikas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->string('kode_barang');
            $table->float('jumlah');
            $table->float('jumlah_min');
            $table->enum('satuan', ['ml', 'gr', 'pcs', 'lembar']);
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
        Schema::dropIfExists('inventaris_lab_kimia_fisikas');
    }
};
