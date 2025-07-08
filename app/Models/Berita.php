<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\KomentarBerita;

class Berita extends Model
{
    protected $table = 'berita';
    protected $fillable = [
        'judul',
        'gambar_berita',
        'isi_berita',
        'tanggal_berita'
    ];

    public function komentarBerita()
    {
        return $this->hasMany(KomentarBerita::class, 'berita_id');
    }
}