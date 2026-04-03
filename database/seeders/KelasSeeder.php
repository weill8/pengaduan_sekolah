<?php

namespace Database\Seeders;

use App\Models\Kelas;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run(): void
    {
        $tingkat = ['X', 'XI', 'XII'];
        $jurusan = ['RPL', 'DKV', 'TKJ', 'TITL'];

        foreach ($tingkat as $t) {
            foreach ($jurusan as $j) {
                for ($i = 1; $i <= 3; $i++) {
                    Kelas::create([
                        'nama_kelas' => "$t $j $i",
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}
