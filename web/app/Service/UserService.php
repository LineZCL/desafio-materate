<?php
namespace App\Service;

use App\Model\User;

class UserService{
	public static function  list($status){
		return User::where('active', $status)->get();
	}

	public static function delete($userId){
		$user = User::find($userId); 
		
		$user->active = false; 
		$user->save(); 
	}	
}