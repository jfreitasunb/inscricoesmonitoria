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

Route::get('/get-cidades/{idEstado}', '\InscricoesMonitoria\Http\Controllers\CandidatoController@getCidades');

/*
*Área do candidato
*/

Route::prefix('aluno')->middleware('user.role:aluno')->group(function () {

	Route::get('/', '\InscricoesMonitoria\Http\Controllers\CandidatoController@getMenu')->name('menu.candidato');

	Route::get('dados/academicos', '\InscricoesMonitoria\Http\Controllers\CandidatoController@getDadosAcademicos')->name('dados.academicos');

	Route::post('dados/academicos', '\InscricoesMonitoria\Http\Controllers\CandidatoController@postDadosAcademicos')->name('dados.academicos');

	Route::get('dados/bancarios', '\InscricoesMonitoria\Http\Controllers\CandidatoController@getDadosBancarios')->name('dados.bancarios');

	Route::post('dados/bancarios', '\InscricoesMonitoria\Http\Controllers\CandidatoController@postDadosBancarios')->name('dados.bancarios');

	Route::get('dados/pessoais', '\InscricoesMonitoria\Http\Controllers\CandidatoController@getDadosPessoais')->name('dados.pessoais');

	Route::post('dados/pessoais', '\InscricoesMonitoria\Http\Controllers\CandidatoController@postDadosPessoais');

	Route::get('dados/escolhas', '\InscricoesMonitoria\Http\Controllers\CandidatoController@getEscolhaCandidato')->name('dados.escolhas');

	Route::post('dados/escolhas', '\InscricoesMonitoria\Http\Controllers\CandidatoController@postEscolhaCandidato');
});


/*
*Área do Admin
 */

Route::get('/admin', [
	'uses' => '\InscricoesMonitoria\Http\Controllers\AdminController@getMenu',
	'as'   => 'menu.admin',
	'middleware' => ['user.role:admin'],
]);

Route::get('/admin/ativa/conta', [
	'uses' => '\InscricoesMonitoria\Http\Controllers\AdminController@getAtivaConta',
	'as'   => 'ativa.conta',
	'middleware' => ['user.role:admin'],
]);

Route::post('/admin/ativa/conta', [
	'uses' => '\InscricoesMonitoria\Http\Controllers\AdminController@postAtivaConta',
	'as'   => 'ativa.conta',
	'middleware' => ['user.role:admin'],
]);

Route::get('/admin/pesquisar/papel', [
	'uses' => '\InscricoesMonitoria\Http\Controllers\AdminController@getPesquisarPapelAtual',
	'as'   => 'pesquisar.papel',
	'middleware' => ['user.role:admin'],
]);

Route::post('/admin/pesquisar/papel', [
	'uses' => '\InscricoesMonitoria\Http\Controllers\AdminController@postPesquisarPapelAtual',
	'as'   => 'pesquisar.papel',
	'middleware' => ['user.role:admin'],
]);

Route::post('/admin/atribuir/papel', [
	'uses' => '\InscricoesMonitoria\Http\Controllers\AdminController@postAtribuirPapel',
	'as'   => 'atribuir.papel',
	'middleware' => ['user.role:admin'],
]);

Route::get('/admin/cria/coordenador', [
	'uses' => '\InscricoesMonitoria\Http\Controllers\AdminController@getCriaCoordenador',
	'as'   => 'criar.coordenador',
	'middleware' => ['user.role:admin'],
]);

Route::post('/admin/cria/coordenador', [
	'uses' => '\InscricoesMonitoria\Http\Controllers\AdminController@postCriaCoordenador',
	'as'   => 'criar.coordenador',
	'middleware' => ['user.role:admin'],
]);

/*
*Área do coordenador
 */

Route::get('/coordenador/cadastrar/disciplina',[
    'uses' => '\InscricoesMonitoria\Http\Controllers\CoordenadorController@getCadastraDisciplina',
    'as'   => 'cadastra.disciplina',
    'middleware' => ['user.role:coordenador,admin'],
]);

Route::post('/coordenador/cadastrar/disciplina',[
    'uses' => '\InscricoesMonitoria\Http\Controllers\CoordenadorController@PostCadastraDisciplina',
    'as'   => 'cadastra.disciplina',
    'middleware' => ['user.role:coordenador,admin'],
]);

Route::get('/coordenador/relatorio/{id_monitoria}',[
    'uses' => '\InscricoesMonitoria\Http\Controllers\RelatorioController@geraRelatorio',
    'as'   => 'gera.relatorio',
    'middleware' => ['user.role:coordenador,admin'],
]);

Route::get('/coordenador/relatorio', [
	'uses' => '\InscricoesMonitoria\Http\Controllers\RelatorioController@getListaRelatorios',
	'as' => 'relatorio.monitoria',
	'middleware' => ['user.role:coordenador,admin'],
]);

Route::get('/coordenador/configura/monitoria', [
	'uses' => '\InscricoesMonitoria\Http\Controllers\CoordenadorController@getConfiguraMonitoria',
	'as' => 'configura.monitoria',
	'middleware' => ['user.role:coordenador,admin'],
]);

Route::post('/coordenador/configura/monitoria', [
	'uses' => '\InscricoesMonitoria\Http\Controllers\CoordenadorController@postConfiguraMonitoria',
	'middleware' => ['user.role:coordenador,admin'],
]);

Route::get('/coordenador', [
	'uses' => '\InscricoesMonitoria\Http\Controllers\CoordenadorController@getMenu',
	'as'   => 'menu.coordenador',
	'middleware' => ['user.role:coordenador'],
]);

/**
* Logout
 */

Route::get('/logout', [
		'uses'	=> '\InscricoesMonitoria\Http\Controllers\Auth\AuthController@getLogout',
		'as'	=> 'auth.logout',
]);

Route::post('/login', [
		'uses'	=> '\InscricoesMonitoria\Http\Controllers\Auth\AuthController@postLogin',
]);

/**
* Logar
 */

Route::get('/login', [
		'uses'	=> '\InscricoesMonitoria\Http\Controllers\Auth\AuthController@getLogin',
		'as'	=> 'auth.login',
		'middleware' => ['guest'],
]);

Route::post('/login', [
		'uses'	=> '\InscricoesMonitoria\Http\Controllers\Auth\AuthController@postLogin',
]);

Route::get('register/verify/{token}',[
	'uses' => '\InscricoesMonitoria\Http\Controllers\Auth\AuthController@verify',
	'middleware' => ['guest'],
]);

/**
* Registrar
 */
Route::get('/registrar', [
		'uses'	=> '\InscricoesMonitoria\Http\Controllers\Auth\AuthController@getSignup',
		'as'	=> 'auth.registrar',
		'middleware' => ['guest','autoriza.inscricao']
]);

Route::post('/registrar', [
		'uses'	=> '\InscricoesMonitoria\Http\Controllers\Auth\AuthController@postSignup',
]);

/*
*Password Reset Routes
 */

Route::get('esqueci/senha', [
		'uses'	=> '\InscricoesMonitoria\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm',
		'as'	=> 'password.request',
		'middleware' => ['guest'],
]);

Route::post('esqueci/senha/link', [
		'uses'	=> '\InscricoesMonitoria\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail',
		'as' => 'password.email',
		'middleware' => ['guest'],
]);

Route::get('/esqueci/senha/{token}', [
		'uses'	=> '\InscricoesMonitoria\Http\Controllers\Auth\ResetPasswordController@showResetForm',
		'as' => 'password.reset',
		'middleware' => ['guest'],
]);

Route::post('/esqueci/senha/{token}', [
		'uses'	=> '\InscricoesMonitoria\Http\Controllers\Auth\ResetPasswordController@reset',
		'as' => 'password.reset',
		'middleware' => ['guest'],
]);

Route::get('/mudousenha', [
		'uses'	=> '\InscricoesMonitoria\Http\Controllers\Auth\AuthController@getMudouSenha',
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
		'uses'	=> '\InscricoesMonitoria\Http\Controllers\HomeController@index',
		'as'	=> 'home',
]);