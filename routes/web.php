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
		'uses'	=> '\Monitoriamat\Http\Controllers\CandidatoController@showNome',
]);


Route::get('/teste2', [
		'uses'	=> '\Monitoriamat\Http\Controllers\HomeController@testando',
		'middleware' => ['user.role:coordenador'],
]);

/*
*Área do candidato
*/

Route::get('/aluno', [
	'uses' => '\Monitoriamat\Http\Controllers\CandidatoController@getMenu',
	'as'   => 'menu.candidato',
	'middleware' => ['user.role:aluno'],
]);

Route::get('/aluno/dados/academicos', [
	'uses' => '\Monitoriamat\Http\Controllers\CandidatoController@getDadosAcademicos',
	'as'   => 'dados.academicos',
	'middleware' => ['user.role:aluno'],
]);

Route::post('/aluno/dados/academicos', [
	'uses' => '\Monitoriamat\Http\Controllers\CandidatoController@postDadosAcademicos',
	'as'   => 'dados.academicos',
	'middleware' => ['user.role:aluno'],
]);

Route::get('/aluno/dados/bancarios', [
	'uses' => '\Monitoriamat\Http\Controllers\CandidatoController@getDadosBancarios',
	'as'   => 'dados.bancarios',
	'middleware' => ['user.role:aluno'],
]);

Route::post('/aluno/dados/bancarios', [
	'uses' => '\Monitoriamat\Http\Controllers\CandidatoController@postDadosBancarios',
	'as'   => 'dados.bancarios',
	'middleware' => ['user.role:aluno'],
]);

Route::get('/aluno/dados/pessoais', [
	'uses' => '\Monitoriamat\Http\Controllers\CandidatoController@getDadosPessoais',
	'as'   => 'dados.pessoais',
	'middleware' => ['user.role:aluno'],
]);

Route::post('/aluno/dados/pessoais', [
	'uses' => '\Monitoriamat\Http\Controllers\CandidatoController@postDadosPessoais',
	'middleware' => ['user.role:aluno'],
]);

Route::get('/aluno/dados/escolhas', [
	'uses' => '\Monitoriamat\Http\Controllers\CandidatoController@getEscolhaCandidato',
	'as'   => 'dados.escolhas',
	'middleware' => ['user.role:aluno'],
]);

Route::post('/aluno/dados/escolhas', [
	'uses' => '\Monitoriamat\Http\Controllers\CandidatoController@postEscolhaCandidato',
	'middleware' => ['user.role:aluno'],
]);


/*
*Área do coordenador
 */

Route::get('/coordenador/relatorio/monitoria', [
	'uses' => '\Monitoriamat\Http\Controllers\CoordenadorController@getRelatorioMonitoria',
	'as' => 'relatorio.monitoria',
	'middleware' => ['user.role:coordenador'],
]);

Route::get('/coordenador/configura/monitoria', [
	'uses' => '\Monitoriamat\Http\Controllers\CoordenadorController@getConfiguraMonitoria',
	'as' => 'configura.monitoria',
	'middleware' => ['user.role:coordenador'],
]);

Route::post('/coordenador/configura/monitoria', [
	'uses' => '\Monitoriamat\Http\Controllers\CoordenadorController@postConfiguraMonitoria',
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
		'uses'	=> '\Monitoriamat\Http\Controllers\Auth\AuthController@getLogout',
		'as'	=> 'auth.logout',
]);

Route::post('/login', [
		'uses'	=> '\Monitoriamat\Http\Controllers\Auth\AuthController@postLogin',
]);

/**
* Logar
 */

Route::get('/login', [
		'uses'	=> '\Monitoriamat\Http\Controllers\Auth\AuthController@getLogin',
		'as'	=> 'auth.login',
		'middleware' => ['guest'],
]);

Route::post('/login', [
		'uses'	=> '\Monitoriamat\Http\Controllers\Auth\AuthController@postLogin',
]);

Route::get('register/verify/{token}',[
	'uses' => '\Monitoriamat\Http\Controllers\Auth\AuthController@verify',
	'middleware' => ['guest'],
]);

/**
* Registrar
 */
Route::get('/registrar', [
		'uses'	=> '\Monitoriamat\Http\Controllers\Auth\AuthController@getSignup',
		'as'	=> 'auth.registrar',
		'middleware' => ['guest','autoriza.inscricao']
]);

Route::post('/registrar', [
		'uses'	=> '\Monitoriamat\Http\Controllers\Auth\AuthController@postSignup',
]);

/*
*Password Reset Routes
 */

Route::get('esqueci/senha', [
		'uses'	=> '\Monitoriamat\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm',
		'as'	=> 'password.request',
		'middleware' => ['guest'],
]);

Route::post('esqueci/senha/link', [
		'uses'	=> '\Monitoriamat\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail',
		'as' => 'password.email',
		'middleware' => ['guest'],
]);

Route::get('/esqueci/senha/{token}', [
		'uses'	=> '\Monitoriamat\Http\Controllers\Auth\ResetPasswordController@showResetForm',
		'as' => 'password.reset',
		'middleware' => ['guest'],
]);

Route::post('/esqueci/senha/{token}', [
		'uses'	=> '\Monitoriamat\Http\Controllers\Auth\ResetPasswordController@reset',
		'as' => 'password.reset',
		'middleware' => ['guest'],
]);

Route::get('/mudousenha', [
		'uses'	=> '\Monitoriamat\Http\Controllers\Auth\AuthController@getMudouSenha',
		'as'	=> 'mudou.senha',
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