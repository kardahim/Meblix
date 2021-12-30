<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// landing page
Route::get('/', function () {
    return view('index');
});

// login
Route::get('/login', function () {
    return view('users.login');
});

Route::post('/login', [UserController::class, 'login']);

// logout
Route::get('/logout', function () {
    Session::forget('user');
    return Redirect('/');
});
