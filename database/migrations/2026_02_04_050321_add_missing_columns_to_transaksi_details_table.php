<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transaksi_details', function (Blueprint $table) {
            // Tambahkan kolom yang hilang
            $table->unsignedBigInteger('layanan_id')->after('id_transaksi');
            $table->unsignedBigInteger('jenis_cucian_id')->after('layanan_id');
            $table->integer('qty')->default(1)->after('jenis_cucian_id');
            $table->integer('harga')->default(0)->after('qty');
            $table->integer('subtotal')->default(0)->after('harga');
        });
    }

    public function down(): void
    {
        Schema::table('transaksi_details', function (Blueprint $table) {
            $table->dropColumn([
                'layanan_id',
                'jenis_cucian_id',
                'qty',
                'harga',
                'subtotal',
            ]);
        });
    }
};
