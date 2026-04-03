<?php

namespace App\Models;

use App\Models\Admin;
use App\Models\InputAspirasi;
use Illuminate\Database\Eloquent\Model;

class Aspirasi extends Model
{
    protected $table = 'tb_aspirasi';
    protected $primaryKey = 'id_aspirasi';

    protected $fillable = [
        'id_pelaporan',
        'status',
        'feedback',
        'id_admin',
    ];

    public function inputAspirasi()
    {
        return $this->belongsTo(InputAspirasi::class, 'id_pelaporan');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin');
    }
}
