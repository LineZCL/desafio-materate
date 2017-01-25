<?php
namespace App\Service;

use App\Model\User;
use Auth;
class AuthService{

	public static function login($email, $password){
		$user = User::where('email', $email)->first();
		if($user != null){
			if($user->isAdmin()){
				if (Auth::attempt(['email' => $email, 'password' => $password, 'active' => true])) {
					return redirect('/');
				}
				else{
					return redirect()->back()->with("error", "E-mail ou password incorreto!");
				}	
			}
			else{
				return redirect()->back()->with("error",  "Você não tem permissão para acessar este portal.");
			}
		}
		return redirect()->back()->with("error",  "Usuário não encontrado!");
	}

	public static function logout(){
		if(!Auth::guest()){
			Auth :: logout();
		}
		return redirect("/");
	}
}