<?php

namespace App\Http\Controllers\API\Auth;

use Illuminate\Http\Request;

use App\Service\AuthApi\AuthApiService;
use App\Model\User;  
use App\Http\Controllers\API\HttpErrorsCode;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class AuthApiController extends Controller
{

	public function login(Request $request){
		$credentials = $request->all(); 
		$authService = new AuthApiService;

		//Verifica se as credenciais são válidas
		$user = $authService->findByCredentials($credentials);
		$errorMessage = null;  
		if($user == null){
			$errorMessage = ['message' => 'Invalid credentials.'];
			return response()->json($errorMessage, HttpErrorsCode::UNAUTHORIZED);
		}

		$userId = ($user->id);

		//Verifica se já está logado
		$token = $authService->findTokenByUser($userId); 
		if($token == null){
			$token = $authService->generateToken($userId);
			$authService->createUserLog($userId, $token->id);
		}

		Redis::set('token', $token->description);
		return response(HttpErrorsCode::OK);
	}

	public function logout(){
		$authService = new AuthApiService;

		$tokenAuth = Redis::get('token');
		$token = $authService->findTokenByDescription($tokenAuth);

		if($token == null){
			$errorMessage = ['message' => 'Invalid token'];
			return response()->json($errorMessage, HttpErrorsCode::BAD_REQUEST);
		}

		$authService->logoutUserLog($token->id);
		$authService->invalidateToken($token);
		Redis::set('token', null);
		return response(HttpErrorsCode::OK);
	}
}