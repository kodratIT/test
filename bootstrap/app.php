<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\http\Middleware\IsPengguna;
use App\http\Middleware\IsKabid;
use App\http\Middleware\IsEvaluator;
use App\http\Middleware\IsKadis;
use App\Http\Middleware\Auth;
use App\Http\Middleware\EnsureProfileIsComplete;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            //'auth' => Authenticate::class,
            //'cek_profil' => CekProfilLengkap::
            'profile.complete' => EnsureProfileIsComplete::class,
            'is_pengguna' => IsPengguna::class,
            'is_kabid' => IsKabid::class,
            'is_evaluator' => IsEvaluator::class,
            'is_kadis' => IsKadis::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
