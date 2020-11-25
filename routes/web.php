<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PersonController;
/**
 * ----------------------------------------------------------
 * Welcome zone
 * ----------------------------------------------------------
 */
Route::get('/', function () {
    return view('welcome');
});

/**
 * ----------------------------------------------------------
 * App zone
 * ----------------------------------------------------------
 */
Route::get('/app', function(){
    return view('app');
})->middleware('auth')->name('home');
Route::post('/person/store', [ PersonController::class, 'store' ])->name('person_store');
// Sesion
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('start_login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
