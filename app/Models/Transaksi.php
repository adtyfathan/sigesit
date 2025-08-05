<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Produk;
use App\Models\Skm;
use App\Models\Stasiun;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $fillable = [
        'total_harga',
        'tanggal_transaksi',
        'waktu_awal_pemesanan',
        'waktu_akhir_pemesanan',
        'status',
        'user_id',
        'produk_id',
        'order_id',
        'transaction_id',
        'payment_type',
        'stasiun_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    public function skm()
    {
        return $this->hasMany(Skm::class, 'transaksi_id');
    }

    public function stasiun()
    {
        return $this->belongsTo(Stasiun::class, 'stasiun_id');
    }

    // Scope for different payment statuses
    public function scopeSuccess($query)
    {
        return $query->where('status', 'success');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }
}