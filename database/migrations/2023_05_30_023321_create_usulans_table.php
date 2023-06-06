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
        Schema::create('usulans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('keterangan');
            $table->string('slug')->unique();
            $table->string('data_pendukung');
            $table->enum('status_verifikasi', ['Disetujui', 'Ditolak'])->default('Disetujui');
            $table->text('keterangan_verifikasi')->nullable();
            $table->string('status');
            $table->unsignedBigInteger('kode_rekening_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usulans');
    }
};
