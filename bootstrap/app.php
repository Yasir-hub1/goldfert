<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        apiPrefix: 'api',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Habilitar sesiones para rutas API
        $middleware->api(prepend: [
            \Illuminate\Cookie\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
        ]);

        // Excluir verificación CSRF de todas las rutas API
        // Las rutas API usan autenticación basada en sesiones pero no requieren CSRF
        $middleware->validateCsrfTokens(except: [
            'api/*',
        ]);

        // Asegurar que las cookies no se cifren para facilitar debugging (opcional)
        $middleware->encryptCookies(except: []);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Manejar excepciones de POST demasiado grande con mensaje amigable
        $exceptions->render(function (\Illuminate\Http\Exceptions\PostTooLargeException $e, $request) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json([
                    'message' => 'La imagen es demasiado grande para enviar. Por favor, comprime la imagen antes de subirla o intenta con una imagen más pequeña (máximo 25MB).',
                    'error' => 'POST data too large'
                ], 413);
            }
        });
    })->create();
