<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Produk;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $fillable = [
        'jumlah_transaksi',
        'tanggal_transaksi',
        'status',
        'user_id',
        'produk_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}