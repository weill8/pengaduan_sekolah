<?php

namespace App\Models;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'tb_kelas';
    protected $fillable = [
        'nama_kelas',
    ];

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id_kelas');
    }
}
