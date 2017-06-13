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
use Storage;

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

	public function geraRelatorio($id_monitoria)
       {

       	$arquivo_relatorio = "Relatorio_inscritos_".$id_monitoria.".csv";


              $file_path = storage_path()."/csv/";

              $csv_relatorio = Writer::createFromPath($file_path.$arquivo_relatorio, 'w+');


              $relatorio = new FinalizaEscolha();
              $usuarios_finalizados = $relatorio->retorna_usuarios_relatorios($id_monitoria);

              $cabecalho = ["Nome","E-mail","Celular","Curso de Graduação", "IRA", "Tipo de Monitoria", "Monitor Convidado", "Nome do Professor", "Escolhas", "Horários", "Atuações Anteoriores"];

              $csv_relatorio->insertOne($cabecalho);


              foreach ($usuarios_finalizados as $usuario) {

                     $linha_arquivo = [];
       		$id_user = $usuario->id_user;

                     $user = New User();

                     $email = $user->find($id_user)->email;

       		$dado_pessoal = new DadoPessoal();
       		$dados_pessoais = $dado_pessoal->retorna_dados_pessoais($id_user);

                     $linha_arquivo['nome'] = $dados_pessoais->nome;
                     
                     $linha_arquivo['email'] = $email;

                     $linha_arquivo['celular'] = $dados_pessoais->celular;

       		$dado_academico = new DadoAcademico();

       		$dados_academicos = $dado_academico->retorna_dados_academicos($id_user);

                     $linha_arquivo['curso_graduacao'] = $dados_academicos->curso_graduacao;

                     $linha_arquivo['ira'] = $dados_academicos->ira;

                     $linha_arquivo['tipo_monitoria'] = $usuario->tipo_monitoria;

                     if ($dados_academicos->monitor_convidado) {
                            $linha_arquivo['monitor_convidado'] = $dados_academicos->monitor_convidado;

                            $linha_arquivo['nome_professor'] = $dados_academicos->nome_professor;

                     }else{
                            
                            $linha_arquivo['monitor_convidado'] = "Não";

                            $linha_arquivo['nome_professor'] = "";
                     }
                     


       		$escolheu = new EscolhaMonitoria();

       		$escolhas_candidato = $escolheu->retorna_escolha_monitoria($id_user,$id_monitoria);

       		$disciplina = new DisciplinaMat();


       		for ($i=0; $i < sizeof($escolhas_candidato); $i++) { 
       			
       			$codigo = $escolhas_candidato[$i]->escolha_aluno;

       			$nome_disciplina = $disciplina->retorna_nome_pelo_codigo($codigo);

       			$nome = $nome_disciplina[0]->nome;

       			$linha_arquivo['escolha_'.($i+1)] = $nome.",".$escolhas_candidato[$i]->mencao_aluno;

       		}

       		$horario = new HorarioEscolhido();

       		$horarios_escolhidos = $horario->retorna_horarios_escolhidos($id_user,$id_monitoria);

       		for ($j=0; $j < sizeof($horarios_escolhidos); $j++) { 
       			
       			$linha_arquivo['horario'.($j+1)] = $horarios_escolhidos[$j]->dia_semana.",".$horarios_escolhidos[$j]->horario_monitoria;
       		}


                     $csv_relatorio->insertOne($linha_arquivo);



              }
       
    }

	

	public function getRelatorioMonitoria()
	{

		return view('templates.partials.coordenador.relatorio_monitoria');
	}

}