<?php

use App\Http\Middleware\UserBasicPlan;
use App\Http\Middleware\UserPlanActive;
use App\Http\Middleware\UserPremiumPlan;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(UserPlanActive::class);
        $middleware->append(UserBasicPlan::class);
        $middleware->append(UserPremiumPlan::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
