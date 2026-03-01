<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    protected $table = 'transaksi_details';

    protected $fillable = [
        'id_transaksi',
        'layanan_id',
        'jenis_cucian_id',
        'qty',
        'harga',
        'subtotal',
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi');
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'layanan_id');
    }

    // ✅ FIX PALING PENTING
    public function jenisCucian()
    {
        return $this->belongsTo(JenisCucian::class, 'jenis_cucian_id');
    }
}
