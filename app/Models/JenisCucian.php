<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisCucian extends Model
{
    use HasFactory;

    protected $table = 'jenis_cucians';

    protected $fillable = [
        'nama_jenis',
    ];
}
