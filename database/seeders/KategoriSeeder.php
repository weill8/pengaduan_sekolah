<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Fasilitas Sekolah',
            'Kebersihan Lingkungan',
            'Kegiatan Ekstrakurikuler',
            'Kualitas Pengajaran',
            'Kedisiplinan Siswa',
            'Pelayanan Administrasi',
            'Keamanan Sekolah',
            'Kantin Sekolah',
            'Perpustakaan',
            'Laboratorium',
            'Sarana Olahraga',
            'Parkiran',
            'Toilet Sekolah',
            'Jadwal Pelajaran',
            'Teknologi & Internet',
            'Hubungan Guru dan Siswa',
            'Kegiatan Sekolah',
            'Transportasi Sekolah',
            'Lingkungan Sekitar Sekolah',
            'Saran dan Kritik Umum',
        ];

        foreach ($data as $item) {
            Kategori::create([
                'ket_kategori' => $item,
            ]);
        }
    }
}
