<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\PasswordController;
use App\Http\Controllers\User\NewPasswordController;
use App\Http\Controllers\User\VerifyEmailController;
use App\Http\Controllers\User\RegisteredUserController;
use App\Http\Controllers\User\PasswordResetLinkController;
use App\Http\Controllers\User\ConfirmablePasswordController;
use App\Http\Controllers\User\AuthenticatedSessionController;
use App\Http\Controllers\User\EmailVerificationPromptController;
use App\Http\Controllers\User\EmailVerificationNotificationController;

Route::prefix('users')->name('user.')->group(function () {

    Route::middleware('guest:web')->group(function () {
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

    Route::middleware('auth:web')->group(function () {
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

    Route::middleware(['auth:web',/*"verified"*/])->group(function () {

        Route::get('/dashboard', function () {
            return view('user.dashboard');
        })->name('dashboard');


        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});
