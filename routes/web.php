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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function() {
	// rutas para el usuario debidamente regustrado
	Route::get('/home', 'TimelineController@index');
	
	Route::post('/newsinodalia', 'SinodaliaController@create');

	Route::get('/teachers', 'admintableController@teachers');

	Route::get('/teachersPanel', 'admintableController@teachersPanel')->name('teachersPanel');

	Route::get('/sinodalias', 'SinodaliaController@index');

	Route::get('/periodo', 'periodoController@index')->name('periodoMenu');

	// para createNewAssignment component
	Route::get('/periodosDisponibles', 'periodoController@availables');

	Route::get('/periodoConfirm', 'periodoController@confirm');

	Route::post('/periodo/create', 'periodoController@create');

	Route::post('/closePeriodo','periodoController@close');
});