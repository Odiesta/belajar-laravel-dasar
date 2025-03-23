<?php

use App\Exceptions\ValidationException;
use App\Http\Middleware\ContohMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        // $middleware->appendToGroup('contoh', [
        //     ContohMiddleware::class
        // ]);

        $middleware->alias([
            'contoh' => ContohMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
        $exceptions->reportable(function (Throwable $e) {
            var_dump($e);
            return false;
        });

        $exceptions->renderable(function (ValidationException $exception, Request $request) {
            return response("Bad Request", 400);
        });

        $exceptions->dontReport([
            ValidationException::class
        ]);
    })->create();
