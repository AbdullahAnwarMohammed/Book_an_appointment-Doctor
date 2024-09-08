<?php

use App\Http\Middleware\Authenticate;
use App\Http\Middleware\RedirectifAuthenticated;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware('web')->prefix('doctor')->name('doctor.')->group(base_path('routes/doctor.php'));
            Route::middleware('web')->prefix('employee')->name('employee.')->group(base_path('routes/employee.php'));
            Route::middleware('web')->prefix('patient')->name('patient.')->group(base_path('routes/patient.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'is_login' =>  RedirectifAuthenticated::class,
            'Authenticate' => Authenticate::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
