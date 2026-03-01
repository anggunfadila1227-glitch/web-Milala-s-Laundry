<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Pesanan;
use App\Models\Transaksi;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

     protected $fillable = [
        'nama_user',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // RELASI
    public function pesanans()
    {
        return $this->hasMany(Pesanan::class);
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'user_id', 'id');
    }
}
