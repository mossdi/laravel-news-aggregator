<?php

use App\Http\Controllers\WebAuth\AuthenticatedSessionController;
use App\Http\Controllers\WebAuth\ConfirmablePasswordController;
use App\Http\Controllers\WebAuth\EmailVerificationNotificationController;
use App\Http\Controllers\WebAuth\EmailVerificationPromptController;
use App\Http\Controllers\WebAuth\NewPasswordController;
use App\Http\Controllers\WebAuth\PasswordController;
use App\Http\Controllers\WebAuth\PasswordResetLinkController;
use App\Http\Controllers\WebAuth\RegisteredUserController;
use App\Http\Controllers\WebAuth\AccountVerificationNoticeController;
use App\Http\Controllers\WebAuth\AccountVerificationNotificationController;
use App\Http\Controllers\WebAuth\AccountVerificationVerifyController;
use App\Http\Controllers\WebAuth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('account/verification/notice', AccountVerificationNoticeController::class)
        ->name('account.verification.notice');

    Route::post('account/verification/notification', AccountVerificationNotificationController::class)
        ->middleware('throttle:6,1')
        ->name('account.verification.notification');

    Route::post('account/verification/verify', AccountVerificationVerifyController::class)
        ->middleware('throttle:6,1')
        ->name('account.verification.verify');

    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
