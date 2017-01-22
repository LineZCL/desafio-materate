<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Service\UserService; 
class UserController extends Controller
{
	public function list(){
		//Parametro para buscar usuarios que não foram deletados. 
		$active = true; 
		$users = UserService::list($active);
		
		return view('/web/list', ['users' => $users]);
	}

	public function deletedUsers(){
		//Parametro para buscar usuarios que foram deletados. 
		$active = false; 
		$users = UserService::list($active);
		
		return view('/web/list', ['users' => $users]);
	}	

	public function delete($userId){
		UserService::delete($userId); 
		return redirect('/users');
	}

	public function edit($userId){
		$user = UserService::findById($userId); 
		$roles = UserService::findRoles(); 

		return view('/web/user/edit', ['user' => $user, 'roles' => $roles]); 
	}

	public function save(Request $request){
		$data = $request->all();
		$user = UserService::save($data);
		return $user;
	}

}
