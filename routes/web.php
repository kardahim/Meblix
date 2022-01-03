<?php

use App\Http\Controllers\AdminController;
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

Route::get('/rejestracja', function () {
    return view('users.register');
})->name('register');

Route::post('/rejestracja', [UserController::class, 'register'])->name('register');

// |--------------------------------------------------------------------------
// | Product System
// |--------------------------------------------------------------------------

Route::get('/', [ProductController::class, 'index']);

Route::get("/produkt/{id}", [ProductController::class, 'detail'])->name('detail');

Route::get("/szukaj", [ProductController::class, 'search'])->name('search');

Route::get("/katalog/{id}", [ProductController::class, 'catalog'])->name('catalog');

Route::post("/dodaj", [ProductController::class, 'addToCart'])->name('addToCart');

Route::get("/koszyk", [ProductController::class, 'cartList'])->name('cartList');

Route::get("/usuń/{id}", [ProductController::class, 'removeFromCart'])->name('removeFromCart');

Route::get("/zwieksz/{id}", [ProductController::class, 'increseAmount'])->name('increseAmount');

Route::get("/zmniejsz/{id}", [ProductController::class, 'decreseAmount'])->name('decreseAmount');

// |--------------------------------------------------------------------------
// | Admin System
// |--------------------------------------------------------------------------

Route::get('/admin/{id}', [AdminController::class, 'adminPanel'])->name('adminPanel');;
