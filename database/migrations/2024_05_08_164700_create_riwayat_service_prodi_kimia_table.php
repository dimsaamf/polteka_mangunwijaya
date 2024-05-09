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
        Schema::create('riwayat_service_prodi_kimia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inventaris_kimias_id')->constrained('inventaris_kimias')->onDelete('cascade');
            $table->date('tanggal_service');
            $table->string('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_service_prodi_kimia');
    }
};
