<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Arr;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
            'owner' => \App\Http\Middleware\OwnerMiddleware::class,
            'subscription' => \App\Http\Middleware\CheckSubscription::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // --- Vercel debug fix ---
        // Laravel selalu coba render Blade view khusus (mis. 500.blade.php)
        // untuk HttpException, terlepas dari APP_DEBUG. Kalau ViewServiceProvider
        // gagal register karena error lain lebih awal, ini bikin error asli
        // ketutup sama "Target class [view] does not exist".
        // Override render() di sini supaya SELALU balas JSON mentah dulu,
        // biar kita bisa lihat root cause-nya tanpa lewat Blade.
        $exceptions->render(function (\Throwable $e, $request) {
            if (config('app.debug')) {
                return response()->json([
                    'exception' => get_class($e),
                    'message'   => $e->getMessage(),
                    'file'      => $e->getFile(),
                    'line'      => $e->getLine(),
                    'previous'  => $e->getPrevious() ? [
                        'exception' => get_class($e->getPrevious()),
                        'message'   => $e->getPrevious()->getMessage(),
                        'file'      => $e->getPrevious()->getFile(),
                        'line'      => $e->getPrevious()->getLine(),
                    ] : null,
                    'trace' => collect($e->getTrace())
                        ->map(fn ($t) => Arr::except($t, ['args']))
                        ->take(15)
                        ->all(),
                ], 500);
            }
        });
    })->create();

// --- Vercel fix: filesystem read-only kecuali /tmp ---
if (getenv('VERCEL') || getenv('VERCEL_ENV')) {
    $app->useStoragePath('/tmp/storage');

    $directories = [
        '/tmp/storage/framework/cache/data',
        '/tmp/storage/framework/sessions',
        '/tmp/storage/framework/testing',
        '/tmp/storage/framework/views',
        '/tmp/storage/logs',
        '/tmp/storage/app/public',
    ];

    foreach ($directories as $directory) {
        if (!is_dir($directory)) {
            mkdir($directory, 0775, true);
        }
    }
}

return $app;