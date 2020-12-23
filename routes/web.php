<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\PersonEmailController;
use App\Http\Controllers\PersonCellphoneController;
use App\Http\Controllers\PermissionParticipantController;
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
    Route::post('/person/store', [ PersonController::class, 'store' ])->name('person_store');
    Route::post('/participants/generate-avatar', [ ParticipantController::class, 'getAvatarFromString' ])->name('participant_generate_avatar');
    Route::post('/participants/list-from-programmer', [ ParticipantController::class, 'listFromProgrammer' ])->name('participants_list_programmer');
    Route::post('/participant/store', [ ParticipantController::class, 'store' ])->name('participant_store');
    Route::post('/participant/update', [ ParticipantController::class, 'update' ])->name('participant_update');
    Route::post('/persons-emails/store-array', [ PersonEmailController::class, 'storeArray' ])->name('persons_emails_store_array');
    Route::post('/persons-emails/email-exists', [ PersonEmailController::class, 'emailExists' ])->name('persons_email_exists');
    Route::post('/persons-emails/emails-exists', [ PersonEmailController::class, 'emailsExists' ])->name('persons_emails_exists');
    Route::post('/persons-cellphones/store-array', [ PersonCellphoneController::class, 'storeArray' ])->name('persons_mobiles_store_array');
    Route::post('/persons-cellphones/cellphone-exists', [ PersonCellphoneController::class, 'cellphoneExists' ])->name('persons_cellphone_exists');
    Route::post('/persons-cellphones/cellphones-exists', [ PersonCellphoneController::class, 'cellphonesExists' ])->name('persons_cellphones_exists');
    Route::post('/permissions-participants/store', [ PermissionParticipantController::class, 'store' ])->name('permissions_participants_store');
    Route::post('/permissions-participants/list-permissions', [ PermissionParticipantController::class, 'listPermissionsParticipant' ])->name('list_permissions');
    Route::post('/categories/list-from-programmer', [ CategorieController::class, 'listFromProgrammer' ])->name('list_categories_from_programmer');
});
// Sesion
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('start_login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
