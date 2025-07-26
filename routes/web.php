<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



require __DIR__.'/users.auth.php';
require __DIR__.'/admins.auth.php';
require __DIR__.'/sellers.auth.php';

Route::get('/login', function () {
    if (auth('admin')->check()) {
        return redirect()->route('admin.login');
    }

    if (auth('seller')->check()) {
        return redirect()->route('seller.login');
    }

    return redirect()->route('user.login');
})->name('login');

Route::get('/dashboard', function () {
    $guards = ['admin', 'seller', 'web'];
    foreach ($guards as $guard) {
        if (Auth::guard($guard)->check()) {
            return view("{$guard}.dashboard");
        }
    }
    return redirect()->route('login');
})->middleware(['auth:admin,seller,web', 'verified'])->name('dashboard');
