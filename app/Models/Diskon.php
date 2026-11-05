<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Diskon extends Model
{
    use HasFactory;

    protected $fillable = [
        'barang_id',
        'tipe',
        'nilai',
        'mulai',
        'selesai',
        'aktif',
    ];

    protected $casts = [
        'mulai'   => 'date',
        'selesai' => 'date',
        'aktif'   => 'boolean',
    ];

    // ✅ relasi ke barang
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    // ✅ cek diskon masih berlaku
    public function isValid()
    {
        $now = Carbon::now();

        if (!$this->aktif) return false;

        if ($this->mulai && $now->lt($this->mulai)) return false;
        if ($this->selesai && $now->gt($this->selesai)) return false;

        return true;
    }
}
