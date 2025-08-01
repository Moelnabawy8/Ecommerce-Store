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
        return redirect()->route('admin.dashboard'); // لوحه تحكم الادمن
    }

    if (auth('seller')->check()) {
        return redirect()->route('seller.dashboard'); // لوحه تحكم البائع
    }

    if (auth('web')->check()) {
        return redirect()->route('web.dashboard'); // لوحه تحكم المستخدم العادي
    }

    return view('web.login'); // أو أي صفحة تسجيل دخول عامة لو عايز
})->name('login');


Route::get('/dashboard', function () {
    $guards = ['admin', 'seller', 'web'];
    foreach ($guards as $guard) {
        if (Auth::guard($guard)->check()) {
            return view("{$guard}.dashboard");
        }
    }
    return redirect()->route('login');
})->middleware(['auth:admin,seller,web', 'verified.custom'])->name('dashboard');
