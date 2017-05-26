<?php

namespace Monitoriamat\Http\Controllers;

use Auth;
use DB;
use Mail;
use Session;
use Carbon\Carbon;
use Monitoriamat\Models\User;
use Monitoriamat\Models\ConfiguraInscricao;
use Monitoriamat\Models\DisciplinaMat;
use Monitoriamat\Models\DisciplinaMonitoria;
use Monitoriamat\Models\DadoPessoal;
use Monitoriamat\Models\DadoBancario;
use Monitoriamat\Models\DadoAcademico;
use Illuminate\Http\Request;
use Monitoriamat\Mail\EmailVerification;
use Monitoriamat\Http\Controllers\Controller;
use Monitoriamat\Http\Controllers\AuthController;
use Illuminate\Foundation\Auth\RegistersUsers;

/**
* Classe para manipulação do candidato.
*/
class CandidatoController extends BaseController
{

	public function getMenu()
	{	
		return view('home');
	}

/*
/Gravação dos dados Pessoais
 */

	public function getDadosPessoais()
	{
		$user = Auth::user();
		$nome = $user->nome;
		$id_user = $user->id_user;
		
		$candidato = new DadoPessoal();
		$dados_pessoais = $candidato->retorna_dados_pessoais($id_user);

		if (is_null($dados_pessoais)) {
			$dados = [
				'nome' => $nome,
			];
			return view('templates.partials.candidato.dados_pessoais')->with('dados', $dados);	
		}else{
			$dados = [
				'nome' => $nome,
				'numerorg' => $dados_pessoais->numerorg,
				'emissorrg' => $dados_pessoais->emissorrg,
				'cpf' => $dados_pessoais->cpf,
				'endereco' => $dados_pessoais->endereco,
				'cidade' => $dados_pessoais->cidade,
				'cep' => $dados_pessoais->cep,
				'estado' => $dados_pessoais->estado,
				'telefone' => $dados_pessoais->telefone,
				'celular' => $dados_pessoais->celular,
			];
			return view('templates.partials.candidato.dados_pessoais')->with('dados', $dados);	
		}
		
	}

	public function postDadosPessoais(Request $request)
	{
		$this->validate($request, [
			'numerorg' => 'required|max:21',
			'emissorrg' => 'required|max:201',
			'cpf' => 'required|cpf|numeric',
			'endereco' => 'required|max:256',
			'cidade' => 'required|max:101',
			'cep' => 'required|max:12',
			'estado' => 'required|max:3',
			'telefone' => 'required|max:21',
			'celular' => 'required|max:21',
		]);

			$user = Auth::user();
			$id_user = $user->id_user;
			
			$user->nome = $request->input('nome');
			$user->save();
			
			$dados_pessoais = [
				'id_user' => $id_user,
				'numerorg' => $request->input('numerorg'),
				'emissorrg' => $request->input('emissorrg'),
				'cpf' => $request->input('cpf'),
				'endereco' => $request->input('endereco'),
				'cidade' => $request->input('cidade'),
				'cep' => $request->input('cep'),
				'estado' => $request->input('estado'),
				'telefone' => $request->input('telefone'),
				'celular' => $request->input('celular'),
			];

			$candidato =  DadoPessoal::find($id_user);

			if (is_null($candidato)) {
				$cria_candidato = new DadoPessoal();
				$cria_candidato->id_user = $id_user;
				$cria_candidato->numerorg = $request->input('numerorg');
				$cria_candidato->emissorrg = $request->input('emissorrg');
				$cria_candidato->cpf = $request->input('cpf');
				$cria_candidato->endereco = $request->input('endereco');
				$cria_candidato->cidade = $request->input('cidade');
				$cria_candidato->cep = $request->input('cep');
				$cria_candidato->estado = $request->input('estado');
				$cria_candidato->telefone = $request->input('telefone');
				$cria_candidato->celular = $request->input('celular');
				$cria_candidato->save($dados_pessoais);
			}else{
				
				$candidato->update($dados_pessoais);
			}

			return redirect()->route('home')->with('success','Seus dados foram atualizados.');
	}

/*
/Gravação dos dados Bancários
 */

	public function getDadosBancarios()
	{
		$user = Auth::user();
		$id_user = $user->id_user;
		
		$candidato = new DadoBancario();
		$dados_bancarios = $candidato->retorna_dados_bancarios($id_user);

		if (!is_null($dados_bancarios)) {
			$dados = [
				'nome_banco' => $dados_bancarios->nome_banco,
				'numero_banco' => $dados_bancarios->numero_banco,
				'agencia_bancaria' => $dados_bancarios->agencia_bancaria,
				'numero_conta_corrente' => $dados_bancarios->numero_conta_corrente,
			];
			return view('templates.partials.candidato.dados_bancarios')->with('dados', $dados);	
		}else{
			return view('templates.partials.candidato.dados_bancarios');
		}
		
	}

	public function postDadosBancarios(Request $request)
	{
		$this->validate($request, [
			'nome_banco' => 'required|max:21',
			'numero_banco' => 'required|max:201',
			'agencia_bancaria' => 'required',
			'numero_conta_corrente' => 'required|max:256',
		]);

			$user = Auth::user();
			$id_user = $user->id_user;
			
			$dados_bancarios = [
				'id_user' => $id_user,
				'nome_banco' => $request->input('nome_banco'),
				'numero_banco' => $request->input('numero_banco'),
				'agencia_bancaria' => $request->input('agencia_bancaria'),
				'numero_conta_corrente' => $request->input('numero_conta_corrente'),
			];

			$banco =  DadoBancario::find($id_user);

			if (is_null($banco)) {
				$cria_banco = new DadoBancario();
				$cria_banco->id_user = $id_user;
				$cria_banco->nome_banco = $request->input('nome_banco');
				$cria_banco->numero_banco = $request->input('numero_banco');
				$cria_banco->agencia_bancaria = $request->input('agencia_bancaria');
				$cria_banco->numero_conta_corrente = $request->input('numero_conta_corrente');
				$cria_banco->save();
			}else{
				
				$banco->update($dados_bancarios);
			}

			return redirect()->route('home')->with('success','Seus dados foram atualizados.');
	}

/*
/Gravação dos dados Acadêmicos
 */
	public function getDadosAcademicos()
	{
		$user = Auth::user();
		$id_user = $user->id_user;
		
		$candidato = new DadoAcademico();
		$dados_academicos = $candidato->retorna_dados_academicos($id_user);

		if (!is_null($dados_academicos)) {
			$dados = [
				'ira' => $dados_academicos->ira,
				'curso_graduacao' => $dados_academicos->curso_graduacao,
			];
			return view('templates.partials.candidato.dados_academicos')->with('dados', $dados);	
		}else{
			return view('templates.partials.candidato.dados_academicos');
		}
		
	}

	public function postDadosAcademicos(Request $request)
	{
		$this->validate($request, [
			'ira' => 'required|max:21',
			'curso_graduacao' => 'required|max:201',
		]);

			$user = Auth::user();
			$id_user = $user->id_user;
			
			$dados_academicos = [
				'id_user' => $id_user,
				'nome_banco' => $request->input('nome_banco'),
				'numero_banco' => $request->input('numero_banco'),
				'agencia_bancaria' => $request->input('agencia_bancaria'),
				'numero_conta_corrente' => $request->input('numero_conta_corrente'),
			];

			// $academico =  DadoAcademico::find($id_user);

			// if (is_null($academico)) {
			// 	$cria_dados_academicos = new DadoAcademico();
			// 	$cria_dados_academicos->id_user = $id_user;
			// 	$cria_dados_academicos->nome_dados_academicos = $request->input('nome_dados_academicos');
			// 	$cria_dados_academicos->numero_dados_academicos = $request->input('numero_dados_academicos');
			// 	$cria_dados_academicos->agencia_bancaria = $request->input('agencia_bancaria');
			// 	$cria_dados_academicos->numero_conta_corrente = $request->input('numero_conta_corrente');
			// 	$cria_dados_academicos->save();
			// }else{
				
			// 	$academico->update($dados_academicos);
			// }

			// return redirect()->route('home')->with('success','Seus dados foram atualizados.');
	}



}