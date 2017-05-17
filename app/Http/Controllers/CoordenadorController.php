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
use Illuminate\Http\Request;
use Monitoriamat\Mail\EmailVerification;
use Monitoriamat\Http\Controllers\Controller;
use Monitoriamat\Http\Controllers\AuthController;
use Illuminate\Foundation\Auth\RegistersUsers;

/**
* Classe para visualização da página inicial.
*/
class CoordenadorController extends BaseController
{

	public function getMenu()
	{	
		return view('home');
	}

	public function getConfiguraMonitoria()
	{

		$monitoria = new ConfiguraInscricao();

		$disciplina = new DisciplinaMat();

		$disciplinas = $disciplina->pega_disciplinas_monitoria();

		return view('templates.partials.coordenador.configurar_monitoria')->with('disciplinas', $disciplinas);
	}

	public function postConfiguraMonitoria(Request $request)
	{

		$this->validate($request, [
			'inicio_inscricao' => 'required|date_format:"d/m/Y"|before:fim_inscricao|after:today',
			'fim_inscricao' => 'required|date_format:"d/m/Y"|after:inicio_inscricao|after:today',
			'semestre' => 'required',
			'escolhas_coordenador' => 'required',
		]);
    
    	$inicio = Carbon::createFromFormat('d/m/Y', $request->inicio_inscricao);
    	$fim = Carbon::createFromFormat('d/m/Y', $request->fim_inscricao);

    	$data_inicio = $inicio->format('Y-m-d');
    	$data_fim = $fim->format('Y-m-d');

    	$ano = $inicio->format('Y');

    	$monitoria = new ConfiguraInscricao();

		$monitoria->ano_monitoria = $ano;
		$monitoria->semestre_monitoria = $request->semestre;
		$monitoria->inicio_inscricao = $data_inicio;
		$monitoria->fim_inscricao = $data_fim;

		$monitoria->save();

		$id_monitoria=$monitoria->id_monitoria;

		for ($i=0; $i < sizeof($request->escolhas_coordenador); $i++) { 

			$disciplinamonitoria = new DisciplinaMonitoria;

			$disciplinamonitoria->id_monitoria = $id_monitoria;
			
			$disciplinamonitoria->codigo_disciplina = $request->escolhas_coordenador[$i];

			$disciplinamonitoria->save();

		}

		return redirect()->route('configura.monitoria')->with('info','Dados gravados com sucesso');

		

	}

	public function getRelatorioMonitoria()
	{

		return view('templates.partials.coordenador.relatorio_monitoria');
	}

}