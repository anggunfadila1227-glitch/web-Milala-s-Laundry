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
<<<<<<< HEAD
            $table->string('nama')->unique()->comment('Nama jenis cucian, misal: reguler, express'); 
=======
            $table->string('nama')->unique()->comment('Nama jenis cucian, misal: Baju, Celana'); 
>>>>>>> e999c14f69206e4aa972ca0970161628359b90e6
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
