<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('layanans', function (Blueprint $table) {

            // jenis layanan: reguler, cuci_kering, express
            if (!Schema::hasColumn('layanans', 'jenis_layanan')) {
                $table->string('jenis_layanan')->after('nama_layanan');
            }

            // deskripsi layanan
            if (!Schema::hasColumn('layanans', 'deskripsi')) {
                $table->text('deskripsi')->nullable()->after('jenis_layanan');
            }

            // status aktif / nonaktif
            if (!Schema::hasColumn('layanans', 'status')) {
                $table->enum('status', ['aktif', 'nonaktif'])
                      ->default('aktif')
                      ->after('harga');
            }
        });
    }

    public function down(): void
    {
        Schema::table('layanans', function (Blueprint $table) {
            $table->dropColumn(['jenis_layanan', 'deskripsi', 'status']);
        });
    }
};
