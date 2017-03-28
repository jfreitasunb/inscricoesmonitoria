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

/**
* Registrar
 */
Route::get('/registrar', [
		'uses'	=> '\Monitoriamat\Http\Controllers\AuthController@getSignup',
		'as'	=> 'auth.registrar',
]);

Route::post('/registrar', [
		'uses'	=> '\Monitoriamat\Http\Controllers\AuthController@postSignup',
]);

/**
* Alertas
 */
Route::get('/alert', function () {
	return redirect()->route('home')->with('info', 'Sucess.');
});

/**
* Home
 */
Route::get('/', [
		'uses'	=> '\Monitoriamat\Http\Controllers\HomeController@index',
		'as'	=> 'home',
]);