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
        Schema::create('barang_keluar_farmasetikas', function (Blueprint $table) {
            $table->id();
            $table->biginteger('id_barang')->unsigned();
            $table->integer('jumlah_keluar');
            $table->date('tanggal_keluar');

            $table->timestamps();

            $table->foreign('id_barang')->references('id')->on('inventaris_lab_farmasetikas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_keluar_farmasetikas');
    }
};
