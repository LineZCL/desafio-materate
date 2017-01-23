<?php

namespace App\Http\Controllers\API\User;

use Illuminate\Http\Request;

use App\Service\UserService;
use App\Model\User;  
use App\Http\Controllers\API\HttpCode;

use App\Http\Controllers\Controller;

class UserApiController extends Controller
{
	public function save(Request $request){
		$data = $request->all(); 

		$isNew = !array_key_exists('id', $data);

		$data['role_id'] = User::COMMON; 
		if($isNew){
			$data['password'] = bcrypt($data['password']);
		}
		
		$user = UserService::save($data,  $isNew);
		return response	()->json($user, HttpCode::OK);
	}

	public function getUserData(){
		$userData = UserService::getUserData(); 
		return response()->json($userData, HttpCode::OK);
	}
}
