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
        Schema::create('barang_masuk_ankeskimias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_barang');
            $table->integer('jumlah_masuk');
            $table->date('tanggal_masuk');
            $table->text('keterangan_masuk');

            $table->timestamps();

            $table->foreign('id_barang')->references('id')->on('inventaris_lab_ankeskimias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_masuk_ankeskimias');
    }
};
