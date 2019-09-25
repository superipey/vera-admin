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
    Route::patch('siswa/{siswa}', 'SiswaController@store')->name('siswa.update');

    Route::get('siswa/foto/{siswa}', 'SiswaController@getFoto')->name('siswa.foto');
    Route::post('siswa/foto', 'SiswaController@storeFoto')->name('siswa.storeFoto');
    Route::get('siswa/delete-foto/{nis}/{foto}', 'SiswaController@destroyFoto')->name('siswa.destroyFoto');
    Route::post('siswa/search', 'SiswaController@search')->name('siswa.search');

    // Guru
    Route::resource('guru', 'GuruController');
    Route::patch('guru/{guru}', 'GuruController@store')->name('guru.update');

    // Kelas
    Route::resource('kelas', 'KelasController');
    Route::patch('kelas/{kela}', 'KelasController@store')->name('kelas.update');

    // Tahun Pelajaran
    Route::resource('tahun-pelajaran', 'TahunPelajaranController');
    Route::patch('tahun-pelajaran/{tahun_pelajaran}', 'TahunPelajaranController@store')->name('tahun-pelajaran.update');
    Route::get('tahun-pelajaran/aktif/{tahun_pelajaran}', 'TahunPelajaranController@setAktif')->name('tahun-pelajaran.aktif');
});

Route::get('images/{path}', 'ImagesController@get');