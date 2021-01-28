<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProgrammerController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\PersonEmailController;
use App\Http\Controllers\PersonCellphoneController;
use App\Http\Controllers\IdentificationTypeController;
use App\Http\Controllers\ParticipantCategorieController;
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
    //Programmers
    Route::post('/programmer/update', [ ProgrammerController::class, 'update' ])->name('programmer_update');
    //Persons
    Route::post('/person/store', [ PersonController::class, 'store' ])->name('person_store');
    //Participants
    Route::post('/participants/generate-avatar', [ ParticipantController::class, 'getAvatarFromString' ])->name('participant_generate_avatar');
    Route::post('/participants/list-from-programmer', [ ParticipantController::class, 'listFromProgrammer' ])->name('participants_list_programmer');
    Route::post('/participant/store', [ ParticipantController::class, 'store' ])->name('participant_store');
    Route::post('/participant/update', [ ParticipantController::class, 'update' ])->name('participant_update');
    //Persons emails
    Route::post('/persons-emails/store-array', [ PersonEmailController::class, 'storeArray' ])->name('persons_emails_store_array');
    Route::post('/persons-emails/email-exists', [ PersonEmailController::class, 'emailExists' ])->name('persons_email_exists');
    Route::post('/persons-emails/emails-exists', [ PersonEmailController::class, 'emailsExists' ])->name('persons_emails_exists');
    Route::post('/persons-emails/emails-admin', [ PersonEmailController::class, 'getEmailsAdmin' ])->name('persons_emails_admin');
    Route::post('/persons-emails/store', [ PersonEmailController::class, 'store' ])->name('persons_emails_store');
    Route::post('/persons-emails/update', [ PersonEmailController::class, 'update' ])->name('persons_emails_update');
    //Persons cellphones
    Route::post('/persons-cellphones/store-array', [ PersonCellphoneController::class, 'storeArray' ])->name('persons_mobiles_store_array');
    Route::post('/persons-cellphones/cellphone-exists', [ PersonCellphoneController::class, 'cellphoneExists' ])->name('persons_cellphone_exists');
    Route::post('/persons-cellphones/cellphones-exists', [ PersonCellphoneController::class, 'cellphonesExists' ])->name('persons_cellphones_exists');
    //Permissiones participants
    Route::post('/permissions-participants/store', [ PermissionParticipantController::class, 'store' ])->name('permissions_participants_store');
    Route::post('/permissions-participants/list-permissions', [ PermissionParticipantController::class, 'listPermissionsParticipant' ])->name('list_permissions');
    //Categories
    Route::post('/categories/list-from-programmer', [ CategorieController::class, 'listFromProgrammer' ])->name('list_categories_from_programmer');
    //Participants categories
    Route::post('/participants-categories/store', [ ParticipantCategorieController::class, 'store' ])->name('participants_categories_store');
    Route::post('/participants-categories/list-categories', [ ParticipantCategorieController::class, 'listParticipantCategorie' ])->name('list_participant_categories');
    //Identifications types
    Route::post('/identifications-types/list', [ IdentificationTypeController::class, 'list' ])->name('list_identifications_types');
    //Image
    Route::get('images/64base', [ FileController::class, 'image64Base'])->name('image_64base');
});
// Sesion
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('start_login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
