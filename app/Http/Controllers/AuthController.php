<?php

namespace Monitoriamat\Http\Controllers;

use Illuminate\Http\Request;

/**
* Classe para visualização da página inicial.
*/
class AuthController extends Controller
{

	public function getSignup()
	{
		return view('auth.registrar');
	}

	public function postSignup( Request $request)
	{

		$this->validate($request,[
			'nome' => 'required|max:255',
			'username'  => 'required|max:255',
			'email'  => 'required|unique:users|email|max:255',
			'confirmar-email'  => 'required|email|confirmed|max:255',
			'password'  => 'required|min:8',
			'confirmar-password'  => 'required|confirmed|min:8',

		]);
	}	
	
}