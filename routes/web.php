<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\mobilController;


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

//data mobil
Route::get('/rental', 'mobilController@tampilRental');
Route::post('/login/proses', 'prosesController@login')->name('login.proses');
Route::resource('/login', 'prosesController');
Route::get('/logout', 'prosesController@logout');

Route::middleware(['GerbangAdmin'])->group(function () {
    Route::get('/','homeController@index');
    
    Route::resource('/data_mobil', 'mobilController');
    
    Route::resource('/pengembalian', 'pinjamController');
    Route::patch('/perpanjang/{id}', 'pinjamController@perpanjang')->name('perpanjang.pengembalian');
    Route::patch('/sewa', 'pinjamController@sewa')->name('sewa.mobil');
    Route::resource('/admin', 'adminController');
    Route::post('/reset/{id}', 'adminController@reset')->name('admin.reset');
    
    Route::get('/laporan', 'pinjamController@laporan');
    
    Route::patch('cetak/{id}/laporanSewa','pdfController@laporanSewa')->name('cetak.laporanSewa');
    Route::post('cetak.laporan','pdfController@laporan')->name('cetak.laporan');
    
});

