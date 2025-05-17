<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'syndrome' => \App\Http\Middleware\MiddlewareShrek::class,
            'session' => \App\Http\Middleware\SessionUserAccountMW::class,

        ]);

        // $middleware->append([
        //     \App\Http\Middleware\AnnouncementMW::class,
        // ]);
    
        $middleware->group('mwgroup', [
            App\Http\Middleware\MwOne::class,
            App\Http\Middleware\MwTwo::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
