<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [
        // bisa tambahkan middleware global jika perlu
    ];

    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'cekprofil' => \App\Http\Middleware\CekProfilLengkap::class,
        'profile.complete' => \App\Http\Middleware\CheckProfileComplete::class,
        'is_pengguna' => \App\Http\Middleware\IsPengguna::class,
        'is_kabid' => \App\Http\Middleware\IsKabid::class,
        'is_evaluator' => \App\Http\Middleware\IsEvaluator::class,
        'is_kadis' => \App\Http\Middleware\IsKadis::class,
    ];
}
