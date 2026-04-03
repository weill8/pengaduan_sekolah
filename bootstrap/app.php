<?php

use App\Http\Middleware\AuthAdmin;
use App\Http\Middleware\AuthSiswa;
use App\Http\Middleware\GuestAdmin;
use App\Http\Middleware\GuestSiswa;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
         $middleware->alias([
            'auth.admin'  => AuthAdmin::class,
            'auth.siswa'  => AuthSiswa::class,
            'guest.admin' => GuestAdmin::class,
            'guest.siswa' => GuestSiswa::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
