<?php

namespace Monitoriamat\Http\Controllers;

use Auth;
use DB;
use Mail;
use Session;
use Carbon\Carbon;
use Monitoriamat\Models\User;
use Monitoriamat\Models\ConfiguraInscricao;
use Monitoriamat\Models\DadoPessoal;
use Monitoriamat\Models\DisciplinaMat;
use Monitoriamat\Models\DisciplinaMonitoria;
use Monitoriamat\Models\FinalizaEscolha;
use Illuminate\Http\Request;
use Monitoriamat\Mail\EmailVerification;
use Monitoriamat\Http\Controllers\Controller;
use Monitoriamat\Http\Controllers\AuthController;
use Illuminate\Foundation\Auth\RegistersUsers;

/**
* Classe para visualização da página inicial.
*/
class RelatorioController extends BaseController
{

	public function getListaRelatorios()
	{

		$relatorio = new ConfiguraInscricao();

		$relatorio_disponivel = $relatorio->retorna_lista_para_relatorio();

		return view('templates.partials.coordenador.relatorio_monitoria')->with('relatorio_disponivel', $relatorio_disponivel);
	}

	public function geraRelatorio($id_monitoria){
       $relatorio = new FinalizaEscolha();
       $usuarios_finalizados = $relatorio->retorna_usuarios_relatorios($id_monitoria);

       foreach ($usuarios_finalizados as $usuario) {

       		$dado_pessoal = new DadoPessoal();
       		$dados_pessoais = $dado_pessoal->retorna_dados_pessoais($usuario->id_user);
       		dd($dados_pessoais);
       }
       
    }

	

	public function getRelatorioMonitoria()
	{

		return view('templates.partials.coordenador.relatorio_monitoria');
	}

}