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
        Schema::create('pengajuan_barang_lab_ankes', function (Blueprint $table) {
            $table->id();
            $table->string('no_surat');
            $table->date('tanggal')->default(now());
            $table->text('detail_barang');
            $table->integer('total_harga');
            $table->string('file');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_barang_lab_ankes');
    }
};
