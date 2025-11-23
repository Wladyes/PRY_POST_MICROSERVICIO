<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php', // Ruta al archivo de rutas API
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
        'auth.micro' => \App\Http\Middleware\CheckAuthToken::class, // Middleware personalizado para autenticación de microservicio
         ]);
        
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
