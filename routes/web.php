<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

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

Route::get('/', function () {
    return view('auth.login');
})->name('login.get');
Route::group(['prefix'=>'auth', 'as'=>'auth.', 'namespace'=>'Auth'], function(){
    Route::post('/login', [AuthController::class, 'login'])->name('login.proses');
    Route::get('/login/error/{id}/{urls}', [AuthController::class, 'error'])->name('login.error');
    Route::get('/login/error/login', [AuthController::class, 'errorLogin'])->name('login.error2');
    Route::get('/login/error/0', [AuthController::class, 'errorLogin'])->name('login.error3');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

//admin
Route::group(['prefix'=>'admin', 'as'=>'admin.', 'namespace'=>'Admin'], function(){
    Route::get('kepegawaian/', [AdminController::class, 'kepegawaian'])->name('kepegawaian');
    Route::get('kepegawaian/redirect', [AdminController::class, 'kepegawaianredirect'])->name('kepegawaian.redirect');
    Route::get('kepegawaian/success', [AdminController::class, 'success'])->name('kepegawaian.success');
    Route::get('/pegawai/tambah', [AdminController::class, 'tambahPegawai'])->name('pegawai.tambah');
    Route::post('/pegawai/tambah/proses', [AdminController::class, 'prosesTambahPegawai'])->name('pegawai.prosestambah');
    Route::get('/pegawai/ubahpassword', [AdminController::class, 'ubahpassword'])->name('pegawai.ubahpassword');
    Route::post('/pegawai/ubahpassword/proses', [AdminController::class, 'prosesUbahPassword'])->name('pegawai.prosesubahpassword');
    Route::post('/pegawai/detail', [AdminController::class, 'detail'])->name('pegawai.detail');
    Route::post('/pegawai/edit/get', [AdminController::class, 'getEdit'])->name('pegawai.edit.get');
    Route::post('/pegawai/detail', [AdminController::class, 'detail'])->name('pegawai.detail');
    Route::post('/pegawai/edit/proses', [AdminController::class, 'prosesEdit'])->name('pegawai.prosesedit');
});

//User
Route::group(['prefix'=>'user', 'as'=>'user.', 'namespace'=>'User'], function(){
    Route::get('dashboard', [UserController::class, 'dashboard'])->name('dashboard');
});
