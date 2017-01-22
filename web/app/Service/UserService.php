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
	
	public static function save( $data){

		$validator = UserService::validator($data); 

		if ($validator->fails()) {
			//return redirect()->back()->withErrors($validator);
			//return 'Deu ruim!';
		}

		User::updateOrCreate(
			['id' => $data['id']],
			['name' => $data['name'], 'email' => $data['email'], 'role_id' => intval($data['roleId'])]
			);
	}

	public static function validator( $data){
		$rules = array(
			'name' => 'required',
			'email' => 'required',
			'roleId' => 'required'
			);
		return Validator::make($data, $rules);
	}

	
}