<?php
namespace App\Service\AuthApi;
use App\Model\Token;
class TokenService{
	/**
	* Buscar token valido para o usuario; 
	*
	**/
	public  static  function findTokenByUser($userId){
		return Token::where('user_id', $userId)->where('active', true)->first();
	}

	/**
	*Buscar token pelo token de acesso e verifica se está ativo; 
	*
	**/
	public static function findTokenByDescription($tokenAuth){
		return Token::where('description', $tokenAuth)->where('active', true)->first();
	}

	/**
	*Invalidar  token. 
	*
	**/
	public static function invalidateToken($token){
		$token->active = false; 
		$token->save(); 
	}
	
	/**
	* Gerar token de autenticação
	*
	**/
	public static  function generateToken($userId){
		$token = ['description' => bcrypt( time() ), 'user_id' => $userId ]; 
		return  Token::create($token);
	}

	/**
	* Buscar usuário logado. 
	*
	**/
	public static function findUserByToken($request){
		$tokenAuth = $request->cookie('token');
		$token = TokenService::findTokenByDescription($tokenAuth); 

		return $token->user; 
	}
}