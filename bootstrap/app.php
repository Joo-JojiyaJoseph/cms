<?php 
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\Middleware\Authenticate; // Laravel 11 auth middleware

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php', // ✅ Correct path
        commands: __DIR__.'/../routes/console.php', // ✅ Correct path
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'auth' => Authenticate::class,
            'admin.access' => \App\Http\Middleware\AdminAccessMiddleware::class,
            'ward.access' => \App\Http\Middleware\WardAccessMiddleware::class,
        ]);

        // Middleware groups
        $middleware->group('admin', [
            'auth',
            'admin.access',
        ]);

        $middleware->group('ward', [
            'auth',
            'ward.access',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
