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
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('role_id')->references('id')->on('roles');
        });

        Schema::table('usulans', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('kode_rekening_id')->references('id')->on('kode_rekenings');
            $table->foreign('status')->references('slug')->on('roles');
        });

        Schema::table('kode_rekenings', function (Blueprint $table) {
            $table->foreign('kegiatan_id')->references('id')->on('kegiatans');
            $table->foreign('anggaran_id')->references('id')->on('anggarans');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('kegiatans', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('barangs', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('anggarans', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('usulans');
    }
};
