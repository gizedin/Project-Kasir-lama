<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'barang_id',
        'qty',
        'harga_asli',
        'diskon',
        'harga_final',
        'payment',
        'status',
    ];

    public function akun()
    {
        return $this->belongsTo(\App\Models\Akun::class, 'user_id');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
