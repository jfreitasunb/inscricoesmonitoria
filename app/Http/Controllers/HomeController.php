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
		$monitoria_ativa = Monitoria::retorna_monitoria_ativa();
		return view('home',['periodo_inscricao' => $monitoria_ativa]);
	}
}