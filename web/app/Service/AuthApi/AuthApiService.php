<?php
namespace App\Service\AuthApi;

use App\Model\User;  

use Illuminate\Support\Facades\Redis;

use DateTime;
class AuthApiService{	

	/**
	* Busca usuário pelas credenciais passadas para a API
 	*
 	**/
 	public  static  function findByCredentials($credentials){
 		$email = $credentials['email'];
 		$password = $credentials['password']; 
 		$user  = User::where('email', $email)->first(); 
 		$credentialsIsValid = false; 

 		if($user != null){
 			$credentialsIsValid = AuthApiService::validateCredential($user, $password);
 		}		
 		return ($credentialsIsValid) ? $user : null; 	
 	}

	/**
	* Verifica se a senha que o usuário passou está correta
	*
	**/
	private static function validateCredential($user, $password){
		return crypt($password, $user->password) == $user->password; 
	}
	
	
	
	

}	

