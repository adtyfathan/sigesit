<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;
use App\Models\Transaksi;

class Produk extends Model
{
    protected $table = 'produk';
    protected $fillable = [
        'nama_produk',
        'harga_per_jam',
        'gambar_produk',
        'deskripsi_produk',
        'wilayah_peta',
        'kategori_id'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}