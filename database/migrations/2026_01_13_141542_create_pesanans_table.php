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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();

            // RELASI
            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('layanan_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // DATA PESANAN
            $table->string('jenis_cucian');
            $table->integer('berat');

            $table->date('tanggal_masuk')->nullable();
            $table->date('estimasi_selesai')->nullable();

            $table->text('catatan')->nullable();

            $table->integer('total');

            $table->enum('status', ['proses', 'selesai'])
                  ->default('proses');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};