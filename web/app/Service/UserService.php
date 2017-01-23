<?php
namespace App\Service;

use App\Model\User;
use App\Model\Role; 
use Validator;

use App\Service\AuthApi\AuthApiService; 

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
	
	public static function getUserData(){
		$authService = new AuthApiService;
		$userLogged = $authService->findUserByToken(); 

		$userLogs = $userLogged -> userLogs;
		$loggedTime = UserService::calculateTimeLogged($userLogs); 

		return ['email' => $userLogged->email, 'name' => $userLogged->name, 'timeLogged'=> $loggedTime, 'count_logins'=>$userLogs->count()];
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

	private static function calculateTimeLogged($userLogs){
		$loggedTime = 0; 

		foreach ($userLogs as $userLog) {
			if($userLog->logout_date != null){
				$loginTime = strtotime($userLog->login_date);
				$logoutTime = strtotime($userLog->logout_date); 
				$interval = $logoutTime - $loginTime;
				$loggedTime = $loggedTime + ($interval / 60);
			}
		}
		return round($loggedTime);
	}	
}