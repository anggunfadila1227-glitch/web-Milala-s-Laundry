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
        Schema::create('layanans', function (Blueprint $table) {
            $table->id();

            // nama layanan (contoh: Cuci Basah, Cuci Kering)
            $table->string('nama_layanan');

            // jenis cucian (pakaian, selimut, karpet, dll)
            $table->string('jenis_cucian');

            // harga per kg
            $table->integer('harga');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanans');
    }
};