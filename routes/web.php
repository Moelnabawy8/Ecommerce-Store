<?php


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



require __DIR__.'/users.auth.php';
require __DIR__.'/admins.auth.php';
require __DIR__.'/sellers.auth.php';

