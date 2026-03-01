<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('add_jenis_cucian', function (Blueprint $table) {
            $table->id(); // id auto increment
            $table->string('nama')->unique()->comment('Nama jenis cucian, misal: reguler, express'); 
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Batalkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('add_jenis_cucian');
    }
};
