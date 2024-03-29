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
        Schema::create('kode_rekenings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode')->unique();
            $table->string('uraian');
            $table->string('slug')->unique();
            $table->unsignedBigInteger('kegiatan_id');
            $table->unsignedBigInteger('anggaran_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kode_rekenings');
    }
};
