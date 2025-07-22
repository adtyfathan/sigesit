<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Produk;
use App\Models\Skm;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $fillable = [
        'jumlah_transaksi',
        'tanggal_transaksi',
        'status',
        'user_id',
        'produk_id',
        'order_id',
        'transaction_id',
        'payment_type'
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