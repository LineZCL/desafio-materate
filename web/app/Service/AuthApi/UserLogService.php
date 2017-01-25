<?php
namespace App\Service\AuthApi;

use App\Model\UserLog; 
use DateTime;
class UserLogService{
	/**
	* Registrar Login com data e horario.
	*
	**/
	public  static function createUserLog($userId, $tokenId){ 

		$userLog = ['user_id' => $userId, 'login_date' => new DateTime(), 'token_id' => $tokenId]; 
		return UserLog::create($userLog);
	}


	/**
	* Registrar a data e horario do logout
	*
	**/
	public static function logoutUserLog($tokenId){
		$userLog = UserLog::where('token_id', $tokenId)->first();
		$userLog->logout_date = new DateTime(); 
		$userLog->save(); 
	}
}