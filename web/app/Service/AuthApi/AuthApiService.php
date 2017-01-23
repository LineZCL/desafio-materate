<?php
namespace App\Service\AuthApi;

use App\Model\User;  
use App\Model\Token; 
use App\Model\UserLog;


use DateTime;
class AuthApiService{	

	/**
	* Busca usuário pelas credenciais passadas para a API
 	*
 	**/
 	public   function findByCredentials($credentials){
 		$email = $credentials['email'];
 		$password = $credentials['password']; 
 		$user  = User::where('email', $email)->first(); 
 		$credentialsIsValid = false; 

 		if($user != null){
 			$credentialsIsValid = $this->validateCredential($user, $password);
 		}		
 		return ($credentialsIsValid) ? $user : null; 	
 	}

	/**
	* Verifica se a senha que o usuário passou está correta
	*
	**/
	private   function validateCredential($user, $password){
		return crypt($password, $user->password) == $user->password; 
	}
	
	/**
	*Busca token valido para o usuario; 
	*
	**/
	public   function findTokenByUser($userId){
		return Token::where('user_id', $userId)->where('active', true)->first();
	}

	/**
	*Busca token pelo token de acesso e verifica se está ativo; 
	*
	**/
	public function findTokenByDescription($tokenAuth){
		return Token::where('description', $tokenAuth)->where('active', true)->first();
	}

	/**
	*Invalida o token. 
	*
	**/
	public function invalidateToken($token){
		$token->active = false; 
		$token->save(); 
	}
	
	/**
	* Gera token de autenticação
	*
	**/
	public  function generateToken($userId){
		$token = ['description' => bcrypt( time() ), 'user_id' => $userId ]; 
		return  Token::create($token);
	}

	/**
	* Registra Login e sua data e horario.
	*
	**/
	public function createUserLog($userId, $tokenId){
		$userLog = ['user_id' => $userId, 'login_date' => new DateTime(), 'token_id' => $tokenId]; 
		return UserLog::create($userLog);
	}


	/**
	* Registra a data e horario do logout
	*
	**/
	public function logoutUserLog($tokenId){
		$userLog = UserLog::where('token_id', $tokenId)->first();
		$userLog->logout_date = new DateTime(); 
		$userLog->save(); 
	}
	

}	

