<?php

namespace App\Models; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkmResult extends Model 
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
}