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

Route::get('/teste', [
		'uses'	=> '\Monitoriamat\Http\Controllers\HomeController@testando',
]);


Route::get('/teste2', [
		'uses'	=> '\Monitoriamat\Http\Controllers\HomeController@testando',
		'middleware' => ['user.role:coordenador'],
]);

/*
*Área do coordenador
 */

Route::get('/coordenador/configura/monitoria', [
	'uses' => '\Monitoriamat\Http\Controllers\CoordenadorController@getConfiguraMonitoria',
	'as' => 'configura.monitoria',
	'middleware' => ['user.role:coordenador'],
]);

Route::get('/coordenador', [
	'uses' => '\Monitoriamat\Http\Controllers\CoordenadorController@getMenu',
	'as'   => 'menu.coordenador',
	'middleware' => ['user.role:coordenador'],
]);

/**
* Logout
 */

Route::get('/logout', [
		'uses'	=> '\Monitoriamat\Http\Controllers\AuthController@getLogout',
		'as'	=> 'auth.logout',
]);

Route::post('/login', [
		'uses'	=> '\Monitoriamat\Http\Controllers\AuthController@postLogin',
]);

/**
* Logar
 */

Route::get('/login', [
		'uses'	=> '\Monitoriamat\Http\Controllers\AuthController@getLogin',
		'as'	=> 'auth.login',
		'middleware' => ['guest'],
]);

Route::post('/login', [
		'uses'	=> '\Monitoriamat\Http\Controllers\AuthController@postLogin',
]);

Route::get('register/verify/{token}',[
	'uses' => '\Monitoriamat\Http\Controllers\AuthController@verify',
	'middleware' => ['guest'],
]);

/**
* Registrar
 */
Route::get('/registrar', [
		'uses'	=> '\Monitoriamat\Http\Controllers\AuthController@getSignup',
		'as'	=> 'auth.registrar',
		'middleware' => ['guest','autoriza.inscricao']
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