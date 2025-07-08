<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Role extends Model
{
    protected $table = 'role';
    
    protected $fillable = [
        'nama_role'
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}