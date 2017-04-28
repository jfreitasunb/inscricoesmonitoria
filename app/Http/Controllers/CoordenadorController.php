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