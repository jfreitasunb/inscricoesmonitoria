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
use Monitoriamat\Models\RelatorioController;
use Illuminate\Http\Request;
use Monitoriamat\Mail\EmailVerification;
use Monitoriamat\Http\Controllers\Controller;
use Monitoriamat\Http\Controllers\AuthController;
use Monitoriamat\Http\Controllers\CoordenadorController;
use Illuminate\Foundation\Auth\RegistersUsers;

/**
* Classe para visualização da página inicial.
*/
class AdminController extends CoordenadorController
{

	public function getMenu()
	{	
		return view('home');
	}


	public function getAtivaConta()
	{
		
		return view('templates.partials.admin.ativa_conta');
	}

	public function postAtivaConta(Request $request)
	{
		
		$this->validate($request, [
			'email' => 'email|max:256',
			'ativar' => 'required',
		]);

		$email = $request->email;
		$ativar_conta = $request->ativar;

		$usuario = new User();
		$user = $usuario->retorna_user_por_email($email);

		if (!is_null($user)) {
			
			$status_usuario = $user->ativo;

			if ($status_usuario) {
				
				return redirect()->route('ativa.conta')->with('info','A conta registrada com o e-mail: '.$email.' já foi ativada!');
			}else{

				if ($ativar_conta) {
					$user->ativo = TRUE;
					$user->save();

					return redirect()->route('ativa.conta')->with('success','A conta registrada com o e-mail: '.$email.' foi ativada com sucesso!');
				}

			}
		}else{
			return redirect()->route('ativa.conta')->with('erro','Não existe nenhuma conta registrada com o e-mail: '.$email.'!');
		}
	}

	public function getPesquisarPapelAtual()
	{
		$dados = null;
		return view('templates.partials.admin.atribuir_papel')->with('dados_usuario', $dados);
	}

	public function postPesquisarPapelAtual(Request $request)
	{

		$this->validate($request, [
			'email' => 'email|max:256',
		]);

		$email = $request->email;
		
		$usuario = new User();
		$user = $usuario->retorna_user_por_email($email);

		if (!is_null($user)) {

			$papeis_disponiveis = $usuario->retorna_papeis();

			$papel_corrente_usuario = $user->user_type;

			$dados_usuario['email'] = $email;
			$dados_usuario['papel_atual'] = $papel_corrente_usuario;

			return view('templates.partials.admin.atribuir_papel')->with(compact('dados_usuario', 'papeis_disponiveis'));
			
		}else{
			return redirect()->route('pesquisar.papel')->with('erro','Não existe nenhuma conta registrada com o e-mail: '.$email.'!');
		}

	}

	public function postAtribuirPapel(Request $request)
	{

		$this->validate($request, [
			'novo_papel' => 'required',
		]);


		$email = $request->email;

		$novo_papel = $request->novo_papel;

		$usuario = new User();
		$user = $usuario->retorna_user_por_email($email);

		$dados_usuario = null;
		
		if (!is_null($user)) {

			if ($novo_papel == "admin") {
				$user->user_type = "admin";
				$user->save();
				return redirect()->route('pesquisar.papel')->with('erro','Não existe nenhuma conta registrada com o e-mail: '.$email.'!');
			}elseif ($novo_papel=="coordenador") {
				$user->user_type = "coordenador";
				$user->save();
				return redirect()->route('pesquisar.papel')->with('erro','Não existe nenhuma conta registrada com o e-mail: '.$email.'!');
			}elseif ($novo_papel=="aluno") {
				$user->user_type = "aluno";
				$user->save();
				return redirect()->route('pesquisar.papel')->with('erro','Não existe nenhuma conta registrada com o e-mail: '.$email.'!');
			}
			
		}else{
			return redirect()->route('pesquisar.papel')->with('erro','Não existe nenhuma conta registrada com o e-mail: '.$email.'!');
		}

	}

	public function getCriaCoordenador()
	{
		return view('templates.partials.admin.criar_coordenador');	
	}

	public function postCriaCoordenador(Request $request)
	{

		$this->validate($request, [
			'email' => 'required|unique:users|email',
			'login' => 'required|unique:users',
		]);

		$novo_usuario = new User();

		$novo_usuario->login = $request->input('login');
        $novo_usuario->email = $request->input('email');
        $novo_usuario->password = bcrypt('SenhaTEmporaria'.date("d-m-Y H:i:s:u"));
        $novo_usuario->validation_code =  NULL;
        $novo_usuario->user_type = "coordenador";
        $novo_usuario->ativo = TRUE;

        $novo_usuario->save();

        return redirect()->route('criar.coordenador')->with('success','A conta de coordenador para o e-mail: '.$novo_usuario->email.' foi criada com sucesso!');
		

	}

}