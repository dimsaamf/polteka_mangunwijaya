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
            $table->string('pengajuan_barang_labfarmasis_kode_pengajuan')->unique('uniq_labfarmasis_kode_pengajuan')->nullable();
            $table->string('pengajuan_barang_lab_ankes_kode_pengajuan')->unique('uniq_labankes_kode_pengajuan')->nullable();
            $table->foreign('pengajuan_barang_labfarmasis_kode_pengajuan', 'fk_labfarmasis_kode_pengajuan')
                  ->references('kode_pengajuan')
                  ->on('pengajuan_barang_labfarmasis')
                  ->onDelete('cascade');
            $table->foreign('pengajuan_barang_lab_ankes_kode_pengajuan', 'fk_labankes_kode_pengajuan')
                  ->references('kode_pengajuan')
                  ->on('pengajuan_barang_lab_ankes')
                  ->onDelete('cascade');
            $table->enum('status', ['Disetujui', 'Ditunda', 'Ditolak','Disetujui Sebagian', 'Menunggu Konfirmasi']);
            $table->text('keterangan')->nullable();
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
