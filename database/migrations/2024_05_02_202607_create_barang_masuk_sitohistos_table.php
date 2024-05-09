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
        Schema::create('barang_masuk_sitohistos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_barang');
            $table->float('jumlah_masuk');
            $table->date('tanggal_masuk');
            $table->text('keterangan_masuk');

            $table->timestamps();

            $table->foreign('id_barang')->references('id')->on('inventaris_lab_sitohistos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_masuk_sitohistos');
    }
};
