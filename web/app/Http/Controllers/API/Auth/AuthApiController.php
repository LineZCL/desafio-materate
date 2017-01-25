<?php

namespace App\Http\Controllers\API\Auth;

use Illuminate\Http\Request;

use App\Service\AuthApi\AuthApiService;
use App\Service\AuthApi\TokenService;
use App\Service\AuthApi\UserLogService;

use App\Model\User;  
use App\Http\Controllers\API\HttpCode;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class AuthApiController extends Controller
{
	//Faz Login
	public function login(Request $request){
		$credentials = $request->all(); 
		

		//Verifica se as credenciais são válidas
		$user = AuthApiService::findByCredentials($credentials);
		$errorMessage = null;  
		if($user == null){
			$errorMessage = ['message' => 'Invalid credentials.'];
			return response()->json($errorMessage, HttpCode::UNAUTHORIZED);
		}

		$userId = ($user->id);

		//Verifica se já está logado
		$token = TokenService::findTokenByUser($userId); 
		if($token == null){
			$token = TokenService::generateToken($userId);
			UserLogService::createUserLog($userId, $token->id);
		}

		return response(HttpCode::OK)->cookie('token', $token->description);
	}

	//Faz logout
	public function logout(Request $request){

		$tokenAuth = $request->cookie('token');

		$token = TokenService::findTokenByDescription($tokenAuth);

		if($token == null){
			$errorMessage = ['message' => 'Invalid token'];
			return response()->json($errorMessage, HttpCode::BAD_REQUEST);
		}

		UserLogService::logoutUserLog($token->id);
		TokenService::invalidateToken($token);
		
		return response(HttpCode::OK);
	}
}