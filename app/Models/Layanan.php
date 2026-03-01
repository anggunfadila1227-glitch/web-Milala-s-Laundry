<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
<<<<<<< HEAD
    protected $table = 'layanans';

        protected $fillable = [
        'nama_layanan',
        'jenis_cucian',
        'jenis_layanan',
        'harga',
        'status',
        'deskripsi',
    ];

=======
    use HasFactory;

    // Nama tabel (opsional, tapi aman ditulis)
    protected $table = 'layanans';

    // Kolom yang boleh diisi (WAJIB sinkron dengan controller & form)
     protected $fillable = [
        'nama_layanan',
        'jenis_layanan',
        'jenis_cucian', // 🔥 WAJIB ADA
        'deskripsi',
        'harga',
        'status',
    ];

    /**
     * Relasi ke detail transaksi
     * 1 layanan bisa dipakai di banyak detail transaksi
     */
    public function detailTransaksis()
    {
        return $this->hasMany(DetailTransaksi::class);
    }
>>>>>>> e999c14f69206e4aa972ca0970161628359b90e6
}
