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
        Schema::create('t_peminjaman', function (Blueprint $table) {
            $table->id('f_id');

            $table->unsignedBigInteger('f_idadmin');
            $table->foreign('f_idadmin')->references('f_id')->on('t_admin');

            $table->unsignedBigInteger('f_idanggota');
            $table->foreign('f_idanggota')->references('f_id')->on('t_anggota');

            $table->date('f_tanggalpeminjaman');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_peminjaman');
    }
};
