<?php

namespace App\Models; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Transaksi;

class Skm extends Model 
{
    use HasFactory;

    protected $table = 'skm';

    protected $fillable = [
        'total_skor',
        'skor_layanan',
        'skor_fasilitas',
        'skor_petugas',
        'skor_aksesibilitas',
        'komentar',
        'user_id',
        'transaksi_id',
        'tanggal_survey'    
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }
}