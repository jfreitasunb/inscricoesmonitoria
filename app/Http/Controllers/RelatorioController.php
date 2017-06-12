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
use Monitoriamat\Models\DadoAcademico;
use Monitoriamat\Models\DisciplinaMat;
use Monitoriamat\Models\DisciplinaMonitoria;
use Monitoriamat\Models\EscolhaMonitoria;
use Monitoriamat\Models\HorarioEscolhido;
use Monitoriamat\Models\FinalizaEscolha;
use Illuminate\Http\Request;
use Monitoriamat\Mail\EmailVerification;
use Monitoriamat\Http\Controllers\Controller;
use Monitoriamat\Http\Controllers\AuthController;
use Illuminate\Foundation\Auth\RegistersUsers;
use League\Csv\Writer;

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

       		$id_user = $usuario->id_user;

       		$dado_pessoal = new DadoPessoal();
       		$dados_pessoais = $dado_pessoal->retorna_dados_pessoais($id_user);
       		
       		$dado_academico = new DadoAcademico();

       		$dados_academicos = $dado_academico->retorna_dados_academicos($id_user);

       		$escolheu = new EscolhaMonitoria();

       		$escolhas_candidato = $escolheu->retorna_escolha_monitoria($id_user,$id_monitoria);

       		$disciplina = new DisciplinaMat();


       		for ($i=0; $i < sizeof($escolhas_candidato); $i++) { 
       			
       			$codigo = $escolhas_candidato[$i]->escolha_aluno;

       			$nome_disciplina = $disciplina->retorna_nome_pelo_codigo($codigo);

       			$nome = $nome_disciplina[0]->nome;

       			$linha_escolhas[] = $nome.";".$escolhas_candidato[$i]->mencao_aluno;
       		}

       		$horario = new HorarioEscolhido();

       		$horarios_escolhidos = $horario->retorna_horarios_escolhidos($id_user,$id_monitoria);

       		for ($j=0; $j < sizeof($horarios_escolhidos); $j++) { 
       			
       			$linha_horario_escolhidos[] = $horarios_escolhidos[$j]->dia_semana.";".$horarios_escolhidos[$j]->horario_monitoria;
       		}



       }
       
    }

	

	public function getRelatorioMonitoria()
	{

		return view('templates.partials.coordenador.relatorio_monitoria');
	}

}