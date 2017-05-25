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

	public function getDadosPessoais()
	{
		$user = Auth::user();
		$nome = $user->nome;
		$id_user = $user->id_user;
		
		$candidato = new DadoPessoal();
		$dados_pessoais = $candidato->retorna_dados_pessoais($id_user);

		if (is_null($dados_pessoais)) {
			return view('templates.partials.candidato.dados_pessoais')->with('nome', $nome);	
		}else{

			echo "temp";
		}
		
	}

	public function postDadosPessoais(Request $request)
	{
			$this->validate($request, [
			'numerorg' => 'required',
			'emissorrg' => 'required',
			'cpf' => 'required|cpf',
			'endereco' => 'required',
			'cidade' => 'required',
			'cep' => 'required',
			'estado' => 'required',
			'telefone' => 'required',
			'celular' => 'required',
		]);

			$user = Auth::user();
			$id_user = $user->id_user;

			$user->nome = $request->input('nome');
			$user->save();

			$candidato = new DadoPessoal();

			$candidato->id_user = $id_user;
			$candidato->numerorg = $request->input('numerorg');
			$candidato->emissorrg = $request->input('emissorrg');
			$candidato->cpf = $request->input('cpf');
			$candidato->endereco = $request->input('endereco');
			$candidato->cidade = $request->input('cidade');
			$candidato->cep = $request->input('cep');
			$candidato->estado = $request->input('estado');
			$candidato->telefone = $request->input('telefone');
			$candidato->celular = $request->input('celular');

			$candidato->save();
	}



}