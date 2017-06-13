<?php

namespace Monitoriamat\Http\Controllers;

use Auth;
use DB;
use Mail;
use Session;
use File;
use ZipArchive;
use Carbon\Carbon;
use Monitoriamat\Models\User;
use Monitoriamat\Models\ConfiguraInscricao;
use Monitoriamat\Models\DadoPessoal;
use Monitoriamat\Models\Documento;
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

              $arquivo_relatorio = "";

              $documentos_zipados = "";

		return view('templates.partials.coordenador.relatorio_monitoria')->with(compact('relatorio_disponivel', 'arquivo_relatorio','documentos_zipados'));
	}


       public function getArquivosRelatorios($id_monitoria,$arquivo_relatorio,$documentos_zipados)
       {

              $relatorio = new ConfiguraInscricao();

              $relatorio_disponivel = $relatorio->retorna_lista_para_relatorio();

              $monitoria = $id_monitoria;

              return view('templates.partials.coordenador.relatorio_monitoria')->with(compact('monitoria','relatorio_disponivel','arquivo_relatorio','documentos_zipados'));
       }


	public function geraRelatorio($id_monitoria)
       {

       	$arquivo_relatorio = "Relatorio_inscritos_".$id_monitoria.".csv";
              $local_relatorios = "/app/relatorios/csv/";

              Storage::put($local_relatorios.$arquivo_relatorio, "");

              $file_path = storage_path().$local_relatorios;

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

                     $documento = new Documento();

                     $nome_historico_banco = $documento->retorna_arquivo_enviado($id_user)->nome_arquivo;

                     $nome_historico = storage_path()."/app/relatorios/temporario/".str_replace(' ', '_', $dados_pessoais->nome).".".File::extension($nome_historico_banco);

                     File::copy(storage_path('app/').$nome_historico_banco,$nome_historico);
              }

              $dirName = storage_path().'/app/relatorios/temporario/';

              // Choose a name for the archive.
              $documentos_zipados = 'Documentos_'.$id_monitoria.'.zip';

              // Create "MyCoolName.zip" file in public directory of project.
              $zip = new ZipArchive;

              if ( $zip->open( storage_path().'/app/relatorios/zip/'.$documentos_zipados, ZipArchive::CREATE ) === true )
              {
                     // Copy all the files from the folder and place them in the archive.
                     foreach (glob( $dirName.'/*') as $fileName )
                     {
                            $file = basename( $fileName );
                            $zip->addFile( $fileName, $file );
                     }

                     $zip->close();
              }

              File::cleanDirectory($dirName);

              return $this->getArquivosRelatorios($id_monitoria,$arquivo_relatorio,$documentos_zipados);

       
    }

	

	public function getRelatorioMonitoria()
	{

		return view('templates.partials.coordenador.relatorio_monitoria');
	}

}