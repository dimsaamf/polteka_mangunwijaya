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
        Schema::create('riwayat_service_lab_kimia_analisas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inventaris_lab_kimia_analisas_id')->nullable()->constrained('inventaris_lab_kimia_analisas')->onDelete('cascade')->index('riwayat_service_lab_kimia_analisas_foreign');
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
        Schema::dropIfExists('riwayat_service_lab_kimia_analisas');
    }
};
