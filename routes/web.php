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
    Route::post('/persons-emails/email-exists', [ PersonEmailController::class, 'emailExists' ])->name('persons_email_exists');
    Route::post('/persons-emails/emails-exists', [ PersonEmailController::class, 'emailsExists' ])->name('persons_emails_exists');
    Route::post('/persons-cellphones/store-array', [ PersonCellphoneController::class, 'storeArray' ])->name('persons_mobiles_store_array');
    Route::post('/persons-cellphones/cellphone-exists', [ PersonCellphoneController::class, 'cellphoneExists' ])->name('persons_cellphone_exists');
    Route::post('/persons-cellphones/cellphones-exists', [ PersonCellphoneController::class, 'cellphonesExists' ])->name('persons_cellphones_exists');
});
// Sesion
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('start_login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
