<?php

namespace Monitoriamat\Http\Controllers;

use Monitoriamat\Models\Monitoria;


/**
* Classe para visualização da página inicial.
*/
class HomeController extends Controller
{
	
	public function index()
	{
		$monitoria = new Monitoria();

		$periodo_inscricao = $monitoria->retorna_periodo_inscricao();

		return view('home',['periodo_inscricao' => $periodo_inscricao]);
	}

	public function testando()
	{	
		$monitoria = new Monitoria();
		dd($monitoria->retorna_periodo_inscricao());
	}
}