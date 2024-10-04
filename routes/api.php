<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\EnsureTelegramIsVerified;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::middleware([
    EnsureTelegramIsVerified::class,
    Authenticate::class,
])
    ->prefix('v1')
    ->group(function () {
        Route::post('users', [UserController::class, 'index']);

        Route::post('articles', [ArticleController::class, 'index']);
    });
