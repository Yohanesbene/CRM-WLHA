<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ObatController;

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
Route::group(['prefix' => 'auth', 'as' => 'auth.', 'namespace' => 'Auth'], function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login.proses');
    Route::get('/login/error/{id}/{urls}', [AuthController::class, 'error'])->name('login.error');
    Route::get('/login/error/login', [AuthController::class, 'errorLogin'])->name('login.error2');
    Route::get('/login/error/0', [AuthController::class, 'errorLogin'])->name('login.error3');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

//admin
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin'], function () {
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
Route::group(['prefix' => 'user', 'as' => 'user.', 'namespace' => 'User'], function () {
    Route::get('dashboard', [UserController::class, 'dashboard'])->name('dashboard');
});


// Inventory Obat
Route::get('/daftar_obat', [ObatController::class, 'index']);
Route::get('/daftar_obat/fetch_data/', [ObatController::class, 'fetch_data'])->name('daftarobat.fetch_data');

Route::get('/detail_obat/{id}', [ObatController::class, 'detail']);
Route::get('/detail_obat/{id}/detail_data', [ObatController::class, 'detail_data']);

Route::get('/transaksi_obat', [ObatController::class, 'transaksi']);
Route::get('/transaksi_obat/fetch_data', [ObatController::class, 'transaksi_data']);
Route::get('/edit_transaksi/{id}/{trans}', [ObatController::class, 'edit_transaksi']);
Route::get('/delete_transaksi/konfirmasi/{id}', [ObatController::class, 'konfirmasi_delete_transaksi']);
Route::post('/delete_transaksi', [ObatController::class, 'delete_stok']);

Route::get('/hapus_obat/{id}', [ObatController::class, 'deleteConfirm']);
Route::post('/delete_obat', [ObatController::class, 'delete_obat']);

Route::get('/tambah_obat/{form}/{nama}', [ObatController::class, 'tambah_obat']);
Route::post('/simpan_obat', [ObatController::class, 'simpan_obat']);

Route::get('/edit_stok/{id}/{trans}', [ObatController::class, 'edit_stok']);
Route::get('/tambah_stok/{id}', [ObatController::class, 'tambah_stok']);
Route::get('/kurang_stok/{id}', [ObatController::class, 'kurang_stok']);
Route::get('/delete_stok/konfirmasi/{id}', [ObatController::class, 'konfirmasi_delete_stok']);
Route::post('/delete_stok', [ObatController::class, 'delete_stok']);
Route::post('/simpan_stok', [ObatController::class, 'simpan_stok']);
