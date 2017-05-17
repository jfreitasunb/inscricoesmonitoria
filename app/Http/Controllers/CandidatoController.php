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
		$nome = Auth::user()->nome;
		$id_user = Auth::user()->id_user;
		
		$candidato = new DadoPessoal();
		$dados_pessoais = $candidato->retorna_dados_pessoais($id_user);

		if (is_null($dados_pessoais)) {
			return view('templates.partials.candidato.dados_pessoais')->with('nome', Auth::user()->nome);	
		}else{

			echo "temp";
		}
		


		
	}

	// public function showNome()
	// {
		

	// 	return view('templates.partials.candidato.dados_pessoais')->with('nome', Auth::user()->nome);
	// }

	// public function postConfiguraMonitoria(Request $request)
	// {

	// 	$this->validate($request, [
	// 		'inicio_inscricao' => 'required|date_format:"d/m/Y"|before:fim_inscricao|after:today',
	// 		'fim_inscricao' => 'required|date_format:"d/m/Y"|after:inicio_inscricao|after:today',
	// 		'semestre' => 'required',
	// 		'escolhas_coordenador' => 'required',
	// 	]);
    
 //    	$inicio = Carbon::createFromFormat('d/m/Y', $request->inicio_inscricao);
 //    	$fim = Carbon::createFromFormat('d/m/Y', $request->fim_inscricao);

 //    	$data_inicio = $inicio->format('Y-m-d');
 //    	$data_fim = $fim->format('Y-m-d');

 //    	$ano = $inicio->format('Y');

 //    	$monitoria = new ConfiguraInscricao();

	// 	$monitoria->ano_monitoria = $ano;
	// 	$monitoria->semestre_monitoria = $request->semestre;
	// 	$monitoria->inicio_inscricao = $data_inicio;
	// 	$monitoria->fim_inscricao = $data_fim;

	// 	$monitoria->save();

	// 	$id_monitoria=$monitoria->id_monitoria;

	// 	for ($i=0; $i < sizeof($request->escolhas_coordenador); $i++) { 

	// 		$disciplinamonitoria = new DisciplinaMonitoria;

	// 		$disciplinamonitoria->id_monitoria = $id_monitoria;
			
	// 		$disciplinamonitoria->codigo_disciplina = $request->escolhas_coordenador[$i];

	// 		$disciplinamonitoria->save();

	// 	}

	// 	return redirect()->route('configura.monitoria')->with('info','Dados gravados com sucesso');

		

	// }

	// public function getRelatorioMonitoria()
	// {

	// 	return view('templates.partials.coordenador.relatorio_monitoria');
	// }

}