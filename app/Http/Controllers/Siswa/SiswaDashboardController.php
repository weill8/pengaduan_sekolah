<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\InputAspirasi;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Http\Request;

class SiswaDashboardController extends Controller
{
    public function index(){

    $siswa = Auth::guard('siswa')->user();

        // Stat cards
        $totalLaporan   = InputAspirasi::where('nis', $siswa->nis)->count();
        $menunggu       = InputAspirasi::where('nis', $siswa->nis)
                            ->whereHas('aspirasi', fn($q) => $q->where('status', 'menunggu'))
                            ->orWhere(fn($q) => $q->where('nis', $siswa->nis)->doesntHave('aspirasi'))
                            ->count();
        $diproses       = InputAspirasi::where('nis', $siswa->nis)
                            ->whereHas('aspirasi', fn($q) => $q->where('status', 'proses'))
                            ->count();
        $selesai        = InputAspirasi::where('nis', $siswa->nis)
                            ->whereHas('aspirasi', fn($q) => $q->where('status', 'selesai'))
                            ->count();

        // Recent laporan
        $laporanTerbaru = InputAspirasi::with(['aspirasi', 'kategori'])
                            ->where('nis', $siswa->nis)
                            ->latest()
                            ->take(5)
                            ->get();

        return view('siswa.dashboard', compact(
            'siswa',
            'totalLaporan',
            'menunggu',
            'diproses',
            'selesai',
            'laporanTerbaru',
        ));
    }
}
