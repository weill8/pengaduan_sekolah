<?php

namespace App\Providers;

use App\Models\Aspirasi;
use App\Models\InputAspirasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.admin', function ($view) {
            // Base query semua laporan
            $baseQuery = InputAspirasi::query();

            // Total semua laporan
            $total = (clone $baseQuery)->count();

            // Belum di-handle (tidak ada relasi aspirasi)
            // $belum = (clone $baseQuery)
            //     ->whereDoesntHave('aspirasi')
            //     ->count();

            // Sudah di-handle (sudah ada relasi aspirasi)
            // $sudah = (clone $baseQuery)
            //     ->whereHas('aspirasi')
            //     ->count();

            // Menunggu (belum ada aspirasi ATAU status = menunggu)
            $menunggu = (clone $baseQuery)
                ->where(function ($q) {
                    $q->whereDoesntHave('aspirasi')
                        ->orWhereHas('aspirasi', function ($q2) {
                            $q2->where('status', 'menunggu');
                        });
                })
                ->count();

            $proses = (clone $baseQuery)
                ->whereHas('aspirasi', function ($q) {
                    $q->where('status', 'proses');
                })
                ->count();

            $selesai = (clone $baseQuery)
                ->whereHas('aspirasi', function ($q) {
                    $q->where('status', 'selesai');
                })
                ->count();

            // Kirim ke view
            $view->with([
                'total'   => $total,
                // 'belum'   => $belum,
                // 'sudah'   => $sudah,
                'menunggu' => $menunggu,
                'proses'  => $proses,
                'selesai' => $selesai,
            ]);
        });

        View::composer('layouts.siswa', function ($view) {
            $nis = Auth::guard('siswa')->id();

            $baseQuery = InputAspirasi::where('nis', $nis);

            $total = (clone $baseQuery)->count();

            $menunggu = (clone $baseQuery)
                ->where(function ($q) {
                    $q->whereDoesntHave('aspirasi')
                        ->orWhereHas('aspirasi', function ($q2) {
                            $q2->where('status', 'menunggu');
                        });
                })
                ->count();

            $proses = (clone $baseQuery)
                ->whereHas('aspirasi', function ($q) {
                    $q->where('status', 'proses');
                })
                ->count();

            $selesai = (clone $baseQuery)
                ->whereHas('aspirasi', function ($q) {
                    $q->where('status', 'selesai');
                })
                ->count();

            $view->with(compact('total', 'menunggu', 'proses', 'selesai'));
        });
    }
}
