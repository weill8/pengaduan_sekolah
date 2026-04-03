<?php

namespace App\Models;

use App\Models\InputAspirasi;
use App\Models\Kelas;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Siswa extends Authenticatable
{
    protected $table = 'tb_siswa';
    protected $primaryKey = 'nis';

    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'nis',
        'nama',
        'id_kelas',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function inputAspirasi()
    {
        return $this->hasMany(InputAspirasi::class, 'nis');
    }
}
