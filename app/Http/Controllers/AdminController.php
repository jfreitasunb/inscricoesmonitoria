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

}