<?php

namespace App\Models;

use App\Models\InputAspirasi;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'tb_kategori';
    protected $primaryKey = 'id_kategori';

    protected $fillable = [
        'ket_kategori',
    ];

    public function inputAspirasi()
    {
        return $this->hasMany(InputAspirasi::class, 'id_kategori');
    }
}
