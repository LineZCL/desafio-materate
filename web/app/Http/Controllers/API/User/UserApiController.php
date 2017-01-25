<?php

namespace App\Http\Controllers\API\User;

use Illuminate\Http\Request;

use App\Service\UserService;
use App\Model\User;  
use App\Http\Controllers\API\HttpCode;

use App\Http\Controllers\Controller;

class UserApiController extends Controller
{
	/**
	* Serviço de edição de usuario
	*
	**/
	public function edit(Request $request){
		
		return $this->save($request, false);

	}

	/**
	* Serviço de criar usuario
	*
	**/
	public  function create(Request $request){
		return $this->save($request, true);
	}

	/**
	* Faz as devidas modificações no objeto, de acordo for usuário que está sendo editado ou inserido. 
	*
	**/
	private  function save(Request $request, $isNew){
		
		$data = $request->all(); 

		$data['role_id'] = User::COMMON; 
		if($isNew){
			$data['password'] = bcrypt($data['password']);
		}

		$user = UserService::save($data,  $isNew);
		if($user == null){
			$errorMessage = ['message' => 'Error to save user'];
			return response()->json($errorMessage, HttpCode::BAD_REQUEST);
		}
		return response()->json($user, HttpCode::OK);

	}

	/**
	* Servço que retorna os dados dos usuário. 
	*
	**/
	public function getUserData(Request $request){
		$userData = UserService::getUserData($request); 
		return response()->json($userData, HttpCode::OK);
	}
}
