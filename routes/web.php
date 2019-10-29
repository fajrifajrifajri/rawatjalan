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

Route::get('/', 'PagesController@frontPageContent');
Route::get('/kontak', 'PagesController@frontPageKontak');
Route::get('/resepsionis/sukses', 'PagesController@ResepsionisSukses');
Route::get('/resepsionis/antrian', 'PagesController@ResepsionisAntrian');
Route::get('/administrator/laporan', 'PagesController@AdministratorLaporan');
Route::get('/administrator', 'PagesController@Dashboard');

Route::resource('/resepsionis/pasien', 'PatientsController');
Route::resource('/administrator/daftar', 'RegisterAdmController');
Route::resource('/administrator/ubah-user', 'EditUserAdmController');
Route::resource('/administrator/pasien', 'PatientsAdmController');
Route::resource('/administrator/dokter', 'DoctorsAdmController');
	Route::resource('/administrator/poliklinik', 'PoliclinicsAdmController');
Route::resource('/administrator/obat', 'MedicinesAdmController');
	Route::resource('/administrator/resep-dokter', 'DoctorRecipeAdmController');
Route::resource('/administrator/pemeriksaan', 'DiagnosesController');
Route::resource('/administrator/pembayaran', 'PaymentsController');
Route::resource('/administrator/laporan', 'ReportsController');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
