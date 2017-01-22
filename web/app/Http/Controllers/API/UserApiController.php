<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Service\UserService;
use App\Model\User;  

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
		return response	()->json($user, HttpErrorsCode::OK);
	}
}
