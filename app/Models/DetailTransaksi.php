<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $table = 'detail_transaksi';

    protected $fillable = [
        'transaksi_id',
        'layanan_id', 
        'qty',
        'harga',
        'subtotal'
    ];

    // RELASI KE TRANSAKSI
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }

    // RELASI KE LAYANAN
    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'layanan_id');
    }
}
