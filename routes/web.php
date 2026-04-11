<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AspirasiController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\SuperAdmin\AkunAdminController;
use App\Http\Controllers\Admin\SuperAdmin\AkunSiswaController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\SiswaAuthController;
use App\Http\Controllers\Siswa\InputAspirasiController;
use App\Http\Controllers\Siswa\SiswaDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// ADMIN
Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('guest.admin')->group(function () {
        Route::get('/login',    [AdminAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login',   [AdminAuthController::class, 'login']);
        // Route::get('/register', [AdminAuthController::class, 'showRegisterForm'])->name('register');
        // Route::post('/register', [AdminAuthController::class, 'register']);
    });

    Route::middleware('auth.admin')->group(function () {
        Route::post('/logout',   [AdminAuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::resource('akunSiswa', AkunSiswaController::class)->only(['index', 'store', 'update', 'destroy']);
        Route::resource('kategori', KategoriController::class)->only(['index', 'store', 'update', 'destroy']);
        Route::resource('kelas', KelasController::class)->only(['index', 'store', 'update', 'destroy']);
        

        Route::prefix('aspirasi')->name('aspirasi.')->controller(AspirasiController::class)->group(function () {
            Route::get('/', 'index')->name('index');

            Route::get('/{aspirasi}', 'show')->name('show');
            Route::patch('/{aspirasi}/feedback', 'feedback')->name('feedback');
            Route::patch('/{aspirasi}/status', 'updateStatus')->name('updateStatus');
        });

        Route::prefix('histori')->name('histori.')->controller(AspirasiController::class)->group(function () {
            Route::get('/', 'histori')->name('histori');
            Route::get('/histori/{siswa}', 'historiSiswa')->name('histori.siswa');
        });

        Route::middleware('role:super_admin')->group(function () {
            Route::resource('akunAdmin', AkunAdminController::class)
                ->only(['index', 'store', 'update', 'destroy']);
        });
        
    });
});

// SISWA
Route::prefix('siswa')->name('siswa.')->group(function () {

    Route::middleware('guest.siswa')->group(function () {
        Route::get('/login', [SiswaAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [SiswaAuthController::class, 'login']);
        // Route::get('/register', [SiswaAuthController::class, 'showRegisterForm'])->name('register');
        // Route::post('/register', [SiswaAuthController::class, 'register']);
    });

    Route::middleware('auth.siswa')->group(function () {
        Route::post('/logout',   [SiswaAuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [SiswaDashboardController::class, 'index'])->name('dashboard');

        Route::prefix('aspirasi')->name('aspirasi.')->group(function () {
            Route::get('/buat', [InputAspirasiController::class, 'create'])->name('create');
            Route::post('/buat', [InputAspirasiController::class, 'store'])->name('store');
        });

        Route::prefix('histori')->name('histori.')->group(function () {
            Route::get('/histori', [InputAspirasiController::class, 'histori'])->name('histori');
            Route::get('/{inputAspirasi}', [InputAspirasiController::class, 'show'])->name('show');
            Route::put('/{id}', [InputAspirasiController::class, 'update'])->name('update');
        });
    });
});
