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
        Schema::create('barang_masuk_farmakognosis', function (Blueprint $table) {
            $table->id();
            $table->biginteger('id_barang')->unsigned();
            $table->integer('jumlah_masuk');
            $table->date('tanggal_masuk');
            $table->string('nama_barang');
            $table->integer('jumlah');
            $table->string('satuan');
            $table->integer('harga');
            $table->text('keterangan');

            $table->timestamps();

            $table->foreign('id_barang')->references('id')->on('inventaris_labfarmakognosis');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_masuk_farmakognosis');
    }
};
