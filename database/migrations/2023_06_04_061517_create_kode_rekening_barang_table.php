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
        Schema::create('kode_rekening_barang', function (Blueprint $table) {
            $table->unsignedBigInteger('kode_rekening_id');
            $table->foreign('kode_rekening_id')->references('id')->on('kode_rekenings')->restrictOnUpdate()->restrictOnDelete();
            $table->unsignedBigInteger('barang_id');
            $table->foreign('barang_id')->references('id')->on('barangs')->restrictOnUpdate()->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kode_rekening_barang');
    }
};
