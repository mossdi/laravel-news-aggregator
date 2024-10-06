<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::prefix('v1')->group(function () {
        Route::post('users', [UserController::class, 'index']);

        Route::post('articles', [ArticleController::class, 'index']);
    });
});
