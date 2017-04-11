<?php

namespace Monitoriamat\Http\Controllers;

use Monitoriamat\Models\Monitoria;
use Auth;


/**
* Classe para visualização da página inicial.
*/
class HomeController extends BaseController
{
	
	public function __construct(){
       parent::__construct();
    }

	public function index()
	{
		return view('home');
	}

	public function testando()
	{	
		$monitoria = new Monitoria();
		dd(Auth::user()->user_type);
	}
}