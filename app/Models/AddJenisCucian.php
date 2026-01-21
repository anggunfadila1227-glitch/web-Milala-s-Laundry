<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddJenisCucian extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database
     */
protected $table = 'add_jenis_cucian';
protected $fillable = ['nama']; // nama jenis cucian
public $timestamps = false;

public function layanans()
{
    return $this->hasMany(Layanan::class, 'jenis_cucian_id');
}
}