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
					return redirect()->back()->with("error", "Email or password invalid!");
				}	
			}
			else{
				return redirect()->back()->with("error",  "You don't have permission to access this portal.");
			}
		}
		return redirect()->back()->with("error",  "You're not registered.");
	}

	public static function logout(){
		if(!Auth::guest()){
			Auth :: logout();
		}
		return redirect("/");
	}
}