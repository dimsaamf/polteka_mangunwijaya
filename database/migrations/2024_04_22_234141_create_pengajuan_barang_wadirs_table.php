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
        Schema::create('pengajuan_barang_wadirs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengajuan_barang_labfarmasi_id');
            $table->foreign('pengajuan_barang_labfarmasi_id')->references('id')->on('pengajuan_barang_labfarmasis')->onDelete('cascade');
            $table->enum('status', ['Diterima', 'Ditunda', 'Ditolak']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_barang_wadirs');
    }
};
