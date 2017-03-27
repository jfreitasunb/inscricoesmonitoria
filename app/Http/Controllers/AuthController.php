<?php

namespace Monitoriamat\Http\Controllers;


/**
* Classe para visualização da página inicial.
*/
class HomeController extends Controller
{
	
	public function index()
	{
		return view('home');
	}
}