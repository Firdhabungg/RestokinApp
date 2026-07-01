<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

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
        //
    })->create();

// --- Vercel fix: filesystem read-only kecuali /tmp ---
// Deteksi environment Vercel (Vercel selalu set env VERCEL=1)
if (getenv('VERCEL') || getenv('VERCEL_ENV')) {
    $app->useStoragePath('/tmp/storage');

    // Pastikan semua folder yang dibutuhkan Laravel ada,
    // karena /tmp kosong setiap kali cold start.
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