<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
        // 未登入的人打到有 auth 的路 → 轉到 loginPage
        $middleware->redirectGuestsTo(
            fn (SymfonyRequest $request) => route('frontend.loginPage')
        );

        // 已登入的人打到有 guest 的路（例如 /loginPage）→ 轉到 home
        $middleware->redirectUsersTo(
            fn (SymfonyRequest $request) => route('frontend.home')
        );
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
