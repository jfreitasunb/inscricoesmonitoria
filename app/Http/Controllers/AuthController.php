<?php

namespace Monitoriamat\Http\Controllers;

use Auth;
use DB;
use Mail;
use Session;
use Monitoriamat\Models\User;
use Illuminate\Http\Request;
use Monitoriamat\Mail\EmailVerification;
use Monitoriamat\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

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
			'login'  => 'required|unique:users|max:255',
			'email'  => 'required|unique:users|email|max:255',
			'confirmar-email'  => 'required|email|same:email|max:255',
			'password'  => 'required|min:8',
			'confirmar-password'  => 'required|same:password|min:8',

		]);

		$user = User::create([
			'nome' => $request->input('nome'),
			'login' => $request->input('login'),
        	'email' => $request->input('email'),
        	'password' => bcrypt($request->input('password')),
        	'validation_code' =>  md5($STRING_VALIDA_EMAIL.$request->input('email').date("d-m-Y H:i:s:u")),
		]);

		$email = new EmailVerification(new User(['validation_code' => $user->validation_code, 'nome' => $user->nome]));

        Mail::to($user->email)->send($email);

		return redirect()->route('home')->with('info','Conta criada com sucesso.');

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