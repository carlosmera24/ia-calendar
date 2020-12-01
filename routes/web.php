<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\PersonEmailController;
use App\Http\Controllers\PersonCellphoneController;
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
Route::group(['middleware' => ['auth']], function(){
    Route::get('/app', function(){
        return view('app');
    })->name('home');
    Route::get('person/ui-avatar', [PersonController::class, 'getUiAvatar'])->name('person_uiavatar');
    Route::post('/person/store', [ PersonController::class, 'store' ])->name('person_store');
    Route::post('/participant/store', [ ParticipantController::class, 'store' ])->name('participant_store');
    Route::post('/persons-emails/store-array', [ PersonEmailController::class, 'storeArray' ])->name('persons_emails_store_array');
    Route::post('/persons-emails/email-exist', [ PersonEmailController::class, 'emailExist' ])->name('persons_emails_exist');
    Route::post('/persons-cellphones/store-array', [ PersonCellphoneController::class, 'storeArray' ])->name('persons_mobiles_store_array');
    Route::post('/persons-cellphones/cellphone-exist', [ PersonCellphoneController::class, 'emailExist' ])->name('persons_cellphone_exist');
});
// Sesion
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('start_login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
