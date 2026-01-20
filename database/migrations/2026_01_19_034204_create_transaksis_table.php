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
        Schema::create('transaksis', function (Blueprint $table) {
        $table->id();
        $table->string('kode_transaksi')->default('')->unique();
        $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        $table->date('tanggal_masuk');
        $table->integer('total')->default(0);
        $table->integer('bayar')->default(0);
        $table->integer('kembalian')->default(0);
        $table->enum('status', ['belum_bayar','lunas'])->default('belum_bayar');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
