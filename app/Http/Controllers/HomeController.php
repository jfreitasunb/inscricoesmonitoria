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
		$periodo_inscricao = Monitoria::retorna_periodo_inscricao();

		return view('home',['periodo_inscricao' => $periodo_inscricao]);
	}
}