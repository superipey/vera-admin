<?php

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

Auth::routes();

Route::group(['middleware' => ['auth:web']], function () {
    Route::get('/', 'DashboardController@index');
    Route::get('dashboard', 'DashboardController@index');

    Route::get('logout', 'Auth\LoginController@logout');

    // Siswa
    Route::resource('siswa', 'SiswaController');
    Route::get('siswa/foto/{siswa}', 'SiswaController@getFoto')->name('siswa.foto');
    Route::post('siswa/foto', 'SiswaController@storeFoto')->name('siswa.storeFoto');
    Route::get('siswa/delete-foto/{nis}/{foto}', 'SiswaController@destroyFoto')->name('siswa.destroyFoto');
    Route::post('siswa/search', 'SiswaController@search')->name('siswa.search');

    Route::resource('tahun-pelajaran', 'TahunPelajaranController');
});

Route::get('images/{path}', 'ImagesController@get');