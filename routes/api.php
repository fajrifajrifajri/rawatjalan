<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/antrian', 'APIController@getAntrian')->name('api.antrian');
Route::post('/realantrian', 'APIController@getAntrianRealAntrian')->name('api.realantrian');
Route::post('/dokter', 'APIController@getDokter')->name('api.dokter');
Route::post('/poliklinik', 'APIController@getPoliklinik')->name('api.poliklinik');
Route::post('/obat', 'APIController@getObat')->name('api.obat');
Route::post('/resep-dokter', 'APIController@getResepDokter')->name('api.resepdokter');
Route::post('/pemeriksaan', 'APIController@getPemeriksaan')->name('api.pemeriksaan');
Route::post('/pembayaranObat', 'APIController@getPembayaranObat')->name('api.pembayaranObat');
Route::post('/pembayaranResep', 'APIController@getPembayaranResep')->name('api.pembayaranResep');
Route::get('/pengunjungBulanan', 'APIController@getPengunjungBulanan')->name('api.pengunjungBulanan');
Route::get('/pengunjungTahunan', 'APIController@getPengunjungTahunan')->name('api.pengunjungTahunan');
Route::get('/poliklinikBulanan', 'APIController@getPoliklinikBulanan')->name('api.poliklinikBulanan');
Route::get('/poliklinikTahunan', 'APIController@getPoliklinikTahunan')->name('api.poliklinikTahunan');