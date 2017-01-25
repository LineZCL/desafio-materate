<?php

namespace App\Http\Controllers\Web\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Service\UserService; 
class UserController extends Controller
{
	/**
	* Busca de usuários cadastrados no portal. 
	*
	**/
	public function list(){
		//Parametro para buscar usuarios que não foram deletados. 
		$active = true; 
		$users = UserService::list($active);
		
		return view('/web/user/list', ['users' => $users, 'edit' => $active]);
	}

	/**
	* Busca de usuários deletados. 
	*
	**/
	public function deletedUsers(){
		//Parametro para buscar usuarios que foram deletados. 
		$active = false; 
		$users = UserService::list($active);
		
		return view('/web/user/list', ['users' => $users, 'edit' => $active]);
	}	

	/**
	* Deleta usuários
	*
	**/
	public function delete($userId){
		UserService::delete($userId); 
		return redirect('/');
	}

	/**
	* Busca dados para a tela de edição dos usuários
	*
	**/	
	public function edit($userId){
		$user = UserService::findById($userId); 
		$roles = UserService::findRoles(); 

		return view('/web/user/edit', ['user' => $user, 'roles' => $roles]); 
	}

	/**
	* Salvar usuários no banco de dados. 
	*
	**/
	public function save(Request $request){
		$data = $request->all();
		$isNew = !array_key_exists( "id" ,$data);   
		$user = UserService::save($data, $isNew);

		if($user == null){
			return redirect()->route(
				'edit_user', ['userId' => $data["id"]]
				)->with('error', 'Erro ao salvar usuário!');
		}
		return redirect('/');
	}

}
