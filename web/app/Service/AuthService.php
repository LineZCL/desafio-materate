<?php
namespace App\Service;

use App\Model\User;
use Auth;
class AuthService{

	public static function login($email, $password){
		$user = User::where('email', $email)->first();

		if($user->isAdmin()){
			if (Auth::attempt(['email' => $email, 'password' => $password])) {
				return "Autenticado";
			}
		}
		return redirect()->back();
	}
}