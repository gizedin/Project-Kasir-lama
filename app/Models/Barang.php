<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'namabarang',
        'deskripsi',
        'gambar',
        'stok',
        'harga',
    ];

    /**
     * Diskon AKTIF & SESUAI TANGGAL
     */
    public function diskon()
    {
        return $this->hasOne(Diskon::class)
            ->where('aktif', true)
            ->whereDate('mulai', '<=', now())
            ->whereDate('selesai', '>=', now());
    }
}
