<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/','AuthController@login')->name('login');
Route::post('/log','AuthController@log')->name('log');
Route::get('/logout','AuthController@logout')->name('logout');

Route::group(['prefix' => 'admin','middleware' => ['auth','admin-role']], function () {
    Route::get('/beranda','AdminController@beranda')->name('admin.beranda');
    Route::get('/pengguna-pelajar','PenggunaController@penggunaPelajar')->name('admin.penggunapelajar');
    Route::get('/pengguna-pendaftar','PenggunaController@penggunaPendaftar')->name('admin.penggunapendaftar');
    Route::get('/pengguna-pendaftar/lihat/{id}','PenggunaController@lihatPendaftar')->name('admin.penggunapendaftar.lihat');
    Route::post('/pengguna-pendaftar/migrasi/{id}','PenggunaController@migrasiPendaftar')->name('admin.penggunapendaftar.migrasi');
    Route::get('/pengguna-pendaftar/hapus/{id}','PenggunaController@hapusPendaftar')->name('admin.penggunapendaftar.hapus');
    Route::get('/pengguna-pendidik','PenggunaController@penggunaPendidik')->name('admin.penggunapendidik');
    Route::get('/pengguna-pelajar/lihat/{id}','PenggunaController@lihatPelajar')->name('admin.penggunapelajar.lihat');
    Route::get('/pengguna-pelajar/edit/{id}','PenggunaController@editPelajar')->name('admin.penggunapelajar.edit');
    Route::post('/pengguna-pelajar/update/{id}','PenggunaController@updatePelajar')->name('admin.penggunapelajar.update');
    Route::get('/pengguna-pelajar/editdata/{id}','PenggunaController@editDataPelajar')->name('admin.penggunapelajar.editdata');
    Route::post('/pengguna-pelajar/updatedata/{id}','PenggunaController@updateDataPelajar')->name('admin.penggunapelajar.updatedata');
    Route::get('/pengguna-pelajar/suspend/{id}','PenggunaController@suspendPelajar')->name('admin.penggunapelajar.suspend');
    Route::get('/pengguna-pelajar/hapus/{id}','PenggunaController@destroyPelajar')->name('admin.penggunapelajar.hapus');
    Route::get('/pengguna-pelajar-suspended','PenggunaController@penggunaPelajarSuspend')->name('admin.penggunasuspend');
    Route::get('/pengguna-pelajar-suspended/lihat/{id}','PenggunaController@lihatSuspended')->name('admin.penggunasuspend.lihat');
    Route::get('/pengguna-pelajar-suspended/cabut-suspend-pelajar/{id}','PenggunaController@cabutSuspendPelajar')->name('admin.penggunasuspend.cabutsuspendpelajar');

});



