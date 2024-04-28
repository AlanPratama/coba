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
        Schema::create('t_buku', function (Blueprint $table) {
            $table->id('f_id');

            $table->unsignedBigInteger('f_idkategori')->nullable();
            $table->foreign('f_idkategori')->references('f_id')->on('t_kategori');

            $table->string('f_judul');
            $table->string('f_pengarang');
            $table->string('f_penerbit');
            $table->string('f_gambar')->nullable();
            $table->text('f_deskripsi');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_buku');
    }
};
