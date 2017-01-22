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

	public function delete($user_id){
		UserService::delete($user_id); 
		return redirect('/users');
	}

}
