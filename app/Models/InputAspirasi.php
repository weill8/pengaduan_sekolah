<?php

namespace App\Models;

use App\Models\Aspirasi;
use App\Models\Kategori;
use App\Models\Siswa;
use Illuminate\Database\Eloquent\Model;

class InputAspirasi extends Model
{
    protected $table = 'tb_input_aspirasi';
    protected $primaryKey = 'id_pelaporan';

    protected $fillable = [
        'nis',
        'id_kategori',
        'lokasi',
        'ket',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nis');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function aspirasi()
    {
        return $this->hasOne(Aspirasi::class, 'id_pelaporan');
    }
}
