<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;

    // nama tabel (opsional kalau sesuai plural)
    protected $table = 'layanans';

    // kolom yang boleh diisi
    protected $fillable = [
        'nama_layanan',
        'jenis_cucian',
        'harga',
    ];

    /**
     * Relasi ke detail transaksi
     * 1 layanan bisa dipakai di banyak transaksi
     */
    public function detailTransaksis()
    {
        return $this->hasMany(DetailTransaksi::class);
    }
}