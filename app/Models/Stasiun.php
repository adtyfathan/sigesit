<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Transaksi;

class Stasiun extends Model
{
    protected $table = 'stasiun';

    protected $fillable = [
        'kode_stasiun',
        'nama_stasiun',
        'lokasi',
    ];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'stasiun_id');
    }
}
