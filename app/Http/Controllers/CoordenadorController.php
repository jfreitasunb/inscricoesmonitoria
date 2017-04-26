<?php

namespace Monitoriamat\Http\Controllers;

use Auth;
use DB;
use Mail;
use Session;
use Monitoriamat\Models\User;
use Monitoriamat\Models\ConfiguraInscricao;
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

		$disciplinas = $monitoria->pega_disciplinas_monitoria();

		return view('templates.partials.coordenador.configurar_monitoria')->with('disciplinas', $disciplinas);
	}

	public function getRelatorioMonitoria()
	{

		return view('templates.partials.coordenador.relatorio_monitoria');
	}

	public function getLogin()
	{	
		return view('auth.login');
	}

	public function postLogin(Request $request)
	{
		$this->validate($request, [
			'login' => 'required',
			'password' => 'required',
		]);

		
		$user = DB::table('users')->where('login', $request->input('login'))->value('ativo');

		if (!$user) {
			return redirect()->back()->with('info', 'Você não ativou sua conta ainda.');
		}else{
			if (!Auth::attempt($request->only(['login', 'password']))) {
				return redirect()->back()->with('info', 'erro ao logar');
			}
		}

		$user_type = DB::table('users')->where('login', $request->input('login'))->value('user_type');

		Session::put('user_type', $user_type);
		return redirect()->route('home')->with('info','Bem vindo');
	}

	public function getLogout()
	{
		Auth::logout();

		return redirect()->route('home')->with('info','Você saiu da sua conta');
	}

	public function verify($token)
	{
	    // The verified method has been added to the user model and chained here
	    // for better readability
	    User::where('validation_code',$token)->firstOrFail()->verified();
	    return redirect()->route('home')->with('info','Conta ativada com sucesso.');
	}

	
}