<?php
namespace App\Service;

use App\Model\User;
use App\Model\Role; 
use Validator;

class UserService{
	public static function  list($status){
		return User::where('active', $status)->get();
	}
	
	public static function findById($userId){
		return $user = User::find($userId); 
	}
	
	public static function delete($userId){
		$user = UserService::findById($userId);
		
		$user->active = false; 
		$user->save(); 
	}	

	public static function findRoles(){
		return Role::all();
	}
	
	public static function save( $data, $isNew){
		$validator = ($isNew) ? UserService::validatorNew($data) : UserService::validatorNew($data); 
		$userId = ($isNew) ? null : $data['id'];

		if ($validator->fails()) {
			//return redirect()->back()->withErrors($validator);
			//return 'Deu ruim!';
		}

		return User::updateOrCreate(['id' => $userId], $data );
	}

	

	private static function validatorEdit( $data){
		$rules = array(
			'name' => 'required',
			'email' => 'required | email',
			'roleId' => 'required'
			);
		return Validator::make($data, $rules);
	}

	private static function validatorNew( $data){
		$rules = array(
			'name' => 'required',
			'email' => 'required | email | unique:users',
			'roleId' => 'required', 
			'password' => 'required'
			);
		return Validator::make($data, $rules);
	}

	
}