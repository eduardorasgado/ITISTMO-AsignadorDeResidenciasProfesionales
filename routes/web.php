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

	Route::get('/sinodalias/{id}', 'SinodaliaController@showSinodal');

	// en permisoSino.blade
	Route::get('/sinodalias/{id}/permiso', 'SinodaliaController@permisoParaEditar')->name('permisoEditar');

	//en permisoSino.blade, comprobar password
	Route::post('/sinoPermisoComp/{id}','SinodaliaController@verifyAdmin')->name('sinoPermisoComp');
	// proteccion en caso de get
	Route::get('/sinoPermisoComp/{id}', function()
	{
	    return Redirect::to('/');
	});

	// realizar la actualizacion de la sinodalia
	Route::post('/updateSino/{id}', 'SinodaliaController@updateSinodalia')->name('updateSino');
	Route::get('/updateSino/{id}', function()
	{
	    return Redirect::to('/');
	});

	//en sinodal.blade, aprobacion de anteproyecto
	Route::post('/sinoPermisoComp2/{id}','SinodaliaController@updateAprobacionProyecto')->name('sinoPermisoComp2');
	// proteccion en caso de get
	Route::get('/sinoPermisoComp2/{id}', function()
	{
	    return Redirect::to('/');
	});

	Route::get('/periodo', 'periodoController@index')->name('periodoMenu');

	// para createNewAssignment component
	Route::get('/periodosDisponibles', 'periodoController@availables');

	Route::get('/periodoConfirm', 'periodoController@confirm');

	Route::post('/periodo/create', 'periodoController@create');
	Route::get('/periodo/create', function()
	{
	    return Redirect::to('/');
	});

	Route::post('/closePeriodo','periodoController@close');
	Route::get('/closePeriodo', function()
	{
	    return Redirect::to('/');
	});

});