<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Berita;

class KomentarBerita extends Model
{
    protected $table = 'komentar_berita';
    protected $fillable = [
        'isi_komentar',
        'tanggal_komentar',
        'berita_id',
        'user_id'
    ];

    public function berita()
    {
        return $this->belongsTo(Berita::class, 'berita_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}