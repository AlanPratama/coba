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
        Schema::create('t_admin', function (Blueprint $table) {
            $table->id('f_id');

            $table->string('f_nama');
            $table->string('f_username');
            $table->string('f_password');

            $table->enum('f_level', ['Admin', 'Pustakawan'])->default('Pustakawan');
            $table->enum('f_status', ['Aktif', 'Tidak Aktif'])->default('Tidak Aktif');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_admin');
    }
};
