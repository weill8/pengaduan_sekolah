<?php

namespace App\Models;

use App\Models\Aspirasi;
use Illuminate\Foundation\Auth\User as Authenticatable;

// use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable  
{
    protected $table = 'tb_admin';
    protected $primaryKey = 'id_admin';

    protected $fillable = [
        'username',
        'password',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function aspirasi()
    {
        return $this->hasMany(Aspirasi::class, 'id_admin');
    }

}
