<?php

namespace App\Models; // <--- PASTIKAN NAMESPACE INI BENAR

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkmResult extends Model // <--- PASTIKAN NAMA KELAS INI BENAR
{
    use HasFactory;

    protected $fillable = [
        'ikm_score',
        'comment',
        'service_aspect',
        'survey_date',
    ];

    protected $casts = [
        'survey_date' => 'datetime',
    ];

    // Jika Anda ingin mengoverride nama tabel (jika bukan 'skm_results')
    // protected $table = 'nama_tabel_anda';
}