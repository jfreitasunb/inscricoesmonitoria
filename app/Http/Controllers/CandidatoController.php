<?php

namespace Monitoriamat\Http\Controllers;

use Auth;
use DB;
use Mail;
use Session;
use Validator;
use Carbon\Carbon;
use Monitoriamat\Models\User;
use Monitoriamat\Models\ConfiguraInscricao;
use Monitoriamat\Models\DisciplinaMat;
use Monitoriamat\Models\DisciplinaMonitoria;
use Monitoriamat\Models\DadoPessoal;
use Monitoriamat\Models\DadoBancario;
use Monitoriamat\Models\DadoAcademico;
use Monitoriamat\Models\AtuacaoMonitoria;
use Monitoriamat\Models\EscolhaMonitoria;
use Monitoriamat\Models\HorarioEscolhido;
use Monitoriamat\Models\Documento;
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
		
		$monitoria_ativa = new ConfiguraInscricao();
		$ano_semestre_ira = $monitoria_ativa->ira_ano_semestre();

		return view('templates.partials.candidato.dados_academicos')->with('ano_semestre_ira', $ano_semestre_ira);	
		
	}

	public function postDadosAcademicos(Request $request)
	{
		$this->validate($request, [
			'ira' => 'required|regex:/^\d+(,\d+)*(\.\d+)?$/|min:0',
			'curso_graduacao' => 'required|max:201',
			'checkbox_foi_monitor' => 'required',
			'arquivo' => 'required|max:10000'
		]);

			$user = Auth::user();
			$id_user = $user->id_user;


			for ($i=0; $i < sizeof($request->checkbox_foi_monitor); $i++) {
				$atuacao = new AtuacaoMonitoria;

				$atuacao->id_user = $id_user;
				$atuacao->atuou_monitoria = $request->checkbox_foi_monitor[$i];

				$atuacao->save();
			}

			$monitoria_ativa = new ConfiguraInscricao();

			$id_monitoria = $monitoria_ativa->retorna_inscricao_ativa()->id_monitoria;
			
			$cria_dados_academicos = new DadoAcademico();
			$cria_dados_academicos->id_user = $id_user;
			$cria_dados_academicos->ira = str_replace(',', '.', $request->input('ira'));
			$cria_dados_academicos->curso_graduacao = $request->input('curso_graduacao');
			$cria_dados_academicos->id_monitoria = $id_monitoria;
			$cria_dados_academicos->save();

			$filename = $request->arquivo->store('documentos');
			$arquivo = new Documento();
			$arquivo->id_user = $id_user;
			$arquivo->nome_arquivo = $filename;
			$arquivo->save();
			
			return redirect()->route('home')->with('success','Seus dados foram atualizados.');
	}


	/*
/Gravação dos escolhas do Candidato
 */
	public function getEscolhaCandidato()
	{
		$user = Auth::user();
		$id_user = $user->id_user;
		
		$monitoria_ativa = new ConfiguraInscricao();
		$id_monitoria = $monitoria_ativa->retorna_inscricao_ativa()->id_monitoria;
		
		$disciplinas_escolhas = new DisciplinaMonitoria();
		$escolhas = $disciplinas_escolhas->pega_disciplinas_monitoria($id_monitoria);	

		$array_horarios_disponiveis = array('12:00 às 13:00','13:00 às 14:00','18:00 às 19:00');

    
    	$array_dias_semana = array('Segunda-Feira','Terça-Feira','Quarta-Feira','Quinta-Feira','Sexta-Feira');

    	$escolhas_candidato = new EscolhaMonitoria();
		$fez_escolhas = $escolhas_candidato->retorna_escolha_monitoria($id_user,$id_monitoria);

		$disable[] = 'disabled="disabled"';

		if (count($fez_escolhas)==3) {
			return redirect()->back()->with('erro','Você já fez suas três escolhas possíveis.');
			return view('templates.partials.candidato.escolha_monitoria')->with(compact('disable','escolhas','array_horarios_disponiveis','array_dias_semana'));
		}else{
			$disable=[];
			$disable[] = '';
			return view('templates.partials.candidato.escolha_monitoria')->with(compact('disable','escolhas','array_horarios_disponiveis','array_dias_semana'));
		}
		
	}

	public function postEscolhaCandidato(Request $request)
	{
		$this->validate($request, [
			'escolha_aluno_1' => 'required',
			'mencao_aluno_1' => 'required',
			'monitor_convidado' => 'required',
			'nome_hora_monitoria' => 'required',
			'nome_professor' => 'required_if:monitor_convidado,==,sim',
			'tipo_monitoria' => 'required|is_voluntario:monitor_convidado',

		]);


		$user = Auth::user();
		$id_user = $user->id_user;
		$monitoria_ativa = new ConfiguraInscricao();
		$id_monitoria = $monitoria_ativa->retorna_inscricao_ativa()->id_monitoria;


		// $escolhas = new EscolhaMonitoria();
		// $fez_escolhas = $escolhas->retorna_escolha_monitoria($id_user,$id_monitoria);

		
		// if (count($fez_escolhas)==0 or count($fez_escolhas)<=3) {
		// 	$grava_escolhas = new EscolhaMonitoria();
		// 	$grava_escolhas->id_user = $id_user;
		// 	$grava_escolhas->id_monitoria = $id_monitoria;
		// 	$grava_escolhas->escolha_aluno = $request->input('escolha_aluno_1');
		// 	$grava_escolhas->mencao_aluno = $request->input('mencao_aluno_1');
		// 	$grava_escolhas->save();

		// 	$fez_escolhas = $escolhas->retorna_escolha_monitoria($id_user,$id_monitoria);

		// 	if (isset($request->escolha_aluno_2) and isset($request->mencao_aluno_2) and count($fez_escolhas) < 3) {
		// 		$grava_escolhas = new EscolhaMonitoria();
		// 		$grava_escolhas->id_user = $id_user;
		// 		$grava_escolhas->id_monitoria = $id_monitoria;
		// 		$grava_escolhas->escolha_aluno = $request->input('escolha_aluno_2');
		// 		$grava_escolhas->mencao_aluno = $request->input('mencao_aluno_2');
		// 		$grava_escolhas->save();
		// 	}

		// 	$fez_escolhas = $escolhas->retorna_escolha_monitoria($id_user,$id_monitoria);

		// 	if (isset($request->escolha_aluno_3) and isset($request->mencao_aluno_3) and count($fez_escolhas) < 3) {
		// 		$grava_escolhas = new EscolhaMonitoria();
		// 		$grava_escolhas->id_user = $id_user;
		// 		$grava_escolhas->id_monitoria = $id_monitoria;
		// 		$grava_escolhas->escolha_aluno = $request->input('escolha_aluno_3');
		// 		$grava_escolhas->mencao_aluno = $request->input('mencao_aluno_3');
		// 		$grava_escolhas->save();
		// 	}
		// }

		// $cria_dados_academicos = DadoAcademico::where('id_user', '=', $id_user)->where('id_monitoria', '=', $id_monitoria)->first();
		// if (isset($request->nome_professor)) {
		// 	$monitor_projeto = [
		// 		'monitor_convidado' => $request->input('monitor_convidado'),
		// 		'nome_professor' => $request->input('nome_professor'),
		// 	];
		// }else{
		// 	$monitor_projeto = [
		// 		'monitor_convidado' => $request->input('monitor_convidado'),
		// 	];
		// }

		// $cria_dados_academicos->update($monitor_projeto);
		// 
		
		

		$horario = $request->input('nome_hora_monitoria');

		foreach ($horario as $key) {
			$temp = explode('_', $key);
			$horario_escolhido = new HorarioEscolhido();
			$horario_escolhido->id_user = $id_user;
			$horario_escolhido->horario_monitoria = $temp[1];
			$horario_escolhido->dia_semana = $temp[0];
			$horario_escolhido->id_monitoria = $id_monitoria;

			$horario_escolhido->save();
		}
		


		// 	for ($i=0; $i < sizeof($request->checkbox_foi_monitor); $i++) {
		// 		$atuacao = new AtuacaoMonitoria;

		// 		$atuacao->id_user = $id_user;
		// 		$atuacao->atuou_monitoria = $request->checkbox_foi_monitor[$i];

		// 		$atuacao->save();
		// 	}

		// 	$monitoria_ativa = new ConfiguraInscricao();

		// 	$id_monitoria = $monitoria_ativa->retorna_inscricao_ativa()->id_monitoria;
			
		// 	$cria_dados_academicos = new DadoAcademico();
		// 	$cria_dados_academicos->id_user = $id_user;
		// 	$cria_dados_academicos->ira = $request->input('ira');
		// 	$cria_dados_academicos->curso_graduacao = $request->input('curso_graduacao');
		// 	$cria_dados_academicos->id_monitoria = $id_monitoria;
		// 	$cria_dados_academicos->save();

		// 	$filename = $request->arquivo->store('documentos');
		// 	$arquivo = new Documento();
		// 	$arquivo->id_user = $id_user;
		// 	$arquivo->nome_arquivo = $filename;
		// 	$arquivo->save();
			
		// 	return redirect()->route('home')->with('success','Seus dados foram atualizados.');
	}



}