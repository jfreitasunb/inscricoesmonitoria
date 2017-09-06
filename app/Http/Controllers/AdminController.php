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
	}

}