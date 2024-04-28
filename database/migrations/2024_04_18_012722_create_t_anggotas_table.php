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
        Schema::create('t_anggota', function (Blueprint $table) {
            $table->id('f_id');

            $table->string('f_nama');
            $table->string('f_username');
            $table->string('f_password');
            $table->string('f_tempatlahir');

            $table->date('f_tanggallahir');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_anggota');
    }
};
