<?php

use App\Http\Controllers\Seller\AuthenticatedSessionController;
use App\Http\Controllers\Seller\ConfirmablePasswordController;
use App\Http\Controllers\Seller\EmailVerificationNotificationController;
use App\Http\Controllers\Seller\EmailVerificationPromptController;
use App\Http\Controllers\Seller\NewPasswordController;
use App\Http\Controllers\Seller\PasswordController;
use App\Http\Controllers\Seller\PasswordResetLinkController;
use App\Http\Controllers\Seller\RegisteredSellerController; // لو مسمى الكلاس كده فعلاً
use App\Http\Controllers\Seller\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::prefix('sellers')->name('seller.')->group(function () {

    Route::middleware('guest:seller')->group(function () {
        Route::get('register', [RegisteredSellerController::class, 'create'])
            ->name('register');

        Route::post('register', [RegisteredSellerController::class, 'store']);

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

    Route::middleware('auth:seller')->group(function () {
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

        Route::put('password', [PasswordController::class, 'update'])
            ->name('password.update');

        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
            ->name('logout');
    });

});
