<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_transaksi',
        'user_id',
        'tanggal_masuk',
        'total',
        'bayar',
        'kembalian',
        'status'
    ];

    // RELAKSI KE DETAIL TRANSAKSI
    public function details()
    {
        return $this->hasMany(DetailTransaksi::class, 'transaksi_id');
    }

    // RELASI KE USER
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
