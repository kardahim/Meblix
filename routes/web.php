<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

// |--------------------------------------------------------------------------
// | Account System
// |--------------------------------------------------------------------------

Route::get('/login', function () {
    return view('users.login');
});

Route::post('/login', [UserController::class, 'login']);

Route::get('/logout', function () {
    Session::forget('user');
    return Redirect('/');
});

// |--------------------------------------------------------------------------
// | Product System
// |--------------------------------------------------------------------------
Route::get('/', [ProductController::class, 'index']);
