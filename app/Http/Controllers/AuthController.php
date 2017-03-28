<?php

namespace Monitoriamat\Http\Controllers;

use Monitoriamat\Models\User;
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

		$STRING_VALIDA_EMAIL = "EsN7Qh2G#U(i24g@LQ=^=NMX74CmuVYZmAPNW?nE3ss6hxtUnvLZBjbD.V[7Y,8LW6trtj%CZWKr^aREKgm]QYW@87xZW4]CEK4mT[yz*o&t6VvzT,E2BGx2j2BP7%Jo{EkRM2Z=Pa4qWu4GeT83)pA]9*rHYctr}L4ka[c6YiweZq=Q>m$7tfPBQoW8wgFm86k8[iDu?HBA[9kiRJeH)7QGnND6oFAbD2Vq(2acX+TAmQbMq3jPUVJ,JPaA]9.)"; /*string usada para gerar o código de validação do e-mail. Deve ser grande por questões de segurança.*/

		$this->validate($request,[
			'nome' => 'required|max:255',
			'username'  => 'required|max:255',
			'email'  => 'required|unique:users|email|max:255',
			'confirmar-email'  => 'required|email|same:email|max:255',
			'password'  => 'required|min:8',
			'confirmar-password'  => 'required|same:password|min:8',

		]);

		User::create([
			'login' => $request->input('username'),
        	'email' => $request->input('email'),
        	'password' => bcrypt($request->input('password')),
        	'validation_code' =>  md5($STRING_VALIDA_EMAIL.$request->input('email').date("d-m-Y H:i:s:u")),
		]);

		return redirect()->route('home')->with('info','Conta criada com sucesso.');

	}	
	
}