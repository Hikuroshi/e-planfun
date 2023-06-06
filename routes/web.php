<?php

use App\Http\Controllers\AnggaranController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\KodeRekeningController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsulanController;
use App\Http\Controllers\VerifikasiUsulanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::resource('/dashboard/usulans', UsulanController::class)->middleware('auth');

Route::middleware('can:super-user')->group(function () {
    Route::resource('/dashboard/users', UserController::class)->middleware('auth');
    Route::resource('/dashboard/kode-rekenings', KodeRekeningController::class)->middleware('auth');
    Route::resource('/dashboard/kegiatans', KegiatanController::class)->middleware('auth');
    Route::resource('/dashboard/barangs', BarangController::class)->middleware('auth');
    Route::resource('/dashboard/anggarans', AnggaranController::class)->middleware('auth');
});

Route::middleware('can:super-user')->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('/dashboard/users/{user:username}/edit-password', 'editPassword')->middleware('auth');
        Route::put('/dashboard/users/{user:username}/edit-password', 'updatePassword');
    });
});

Route::middleware('can:verifikator')->group(function(){
    Route::controller(VerifikasiUsulanController::class)->group(function(){
        Route::get('/dashboard/verifikasi-usulan', 'index')->middleware('auth');
        Route::get('/dashboard/verifikasi-usulan/{usulan:slug}', 'edit')->middleware('auth');
        Route::put('/dashboard/verifikasi-usulan/{usulan:slug}', 'update');
    });
});

Route::controller(PageController::class)->group(function(){
    Route::get('/', 'index')->name('dashboard')->middleware('auth');
});

Route::controller(LoginController::class)->group(function(){
    Route::get('/login', 'login')->name('login')->middleware('guest');
    Route::post('/login', 'authenticate');
    Route::get('/logout', 'logout')->middleware('auth');
});

Route::redirect('/dashboard', '/');