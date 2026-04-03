<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aspirasi;
use App\Models\InputAspirasi;
use App\Models\Kategori;
// use App\Models\Kelas;
use App\Models\Siswa;
// use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalSiswa = Siswa::count();
        $totalReports = InputAspirasi::count();
        $totalKategori = Kategori::count();
        $pendingReports = InputAspirasi::where(function ($q) {
            $q->whereDoesntHave('aspirasi')
                ->orWhereHas('aspirasi', function ($q2) {
                    $q2->where('status', 'menunggu');
                });
        })->count();

        // Recent reports (join input + aspirasi + siswa + kategori)
        $reports = InputAspirasi::with(['aspirasi', 'siswa', 'kategori'])
            ->latest()
            ->take(8)
            ->get();

        // Line chart – reports per day (last 7 days)
        $userGrowthLabels = [];
        $userGrowthData   = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $userGrowthLabels[] = $date->format('d M');
            $userGrowthData[]   = InputAspirasi::whereDate('created_at', $date)->count();
        }

        // Bar chart – reports per category
        $categories          = Kategori::withCount('inputAspirasi')->get();
        $reportCategoryLabels = $categories->pluck('ket_kategori');
        $reportCategoryData  = $categories->pluck('input_aspirasi_count');

        return view('admin.dashboard', compact(
            'totalSiswa',
            'totalReports',
            'totalKategori',
            'pendingReports',
            'reports',
            'userGrowthLabels',
            'userGrowthData',
            'reportCategoryLabels',
            'reportCategoryData',
        ));
    }
}
