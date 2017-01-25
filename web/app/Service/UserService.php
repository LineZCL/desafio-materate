<?php
namespace App\Service;

use App\Model\User;
use App\Model\Role; 
use Validator;

use App\Service\AuthApi\TokenService; 

class UserService{

	/**
	* Listar usuários de acordo com o seu status. 
	*  $status = false //Usuário deletado
	* $status = true //Usuário no sistema
	**/
	public static function  list($status){
		return User::where('active', $status)->get();
	}
	
	/**
	* Buscar usuario pelo Id
	*
	**/
	public static function findById($userId){
		return $user = User::find($userId); 
	}
	
	/**
	* Desabilita o usuário do sistema, não  permitindo que ele logue; 
	*
	**/
	public static function delete($userId){
		$user = UserService::findById($userId);
		
		$user->active = false; 
		$user->save(); 
	}	

	/**
	* Buscar perfis.
	*
	**/
	public static function findRoles(){
		return Role::all();
	}
	
	/**
	* Salvar usuario no banco. 
	*
	**/
	public static function save( $data, $isNew){
		$validator = ($isNew) ? UserService::validatorNew($data) : UserService::validatorEdit($data); 
		$userId = ($isNew) ? null : $data['id'];

		if ($validator->fails()) {
			return null;
		}

		return User::updateOrCreate(['id' => $userId], $data );
	}
	
	/**
	* Buscar dados do usuário logado. 
	*
	**/
	public static function getUserData($request){
		$userLogged = TokenService::findUserByToken($request); 

		$userLogs = $userLogged -> userLogs;
		$loggedTime = UserService::calculateTimeLogged($userLogs); 

		return ['id'=> $userLogged->id, 'email' => $userLogged->email, 'name' => $userLogged->name, 'timeLogged'=> $loggedTime, 'count_logins'=>$userLogs->count()];
	}

	/**
	* Regra de validação da edição do usuario	
	*
	**/
	private static function validatorEdit( $data){
		$rules = array(
			'name' => 'required',
			'email' => 'required | email',
			'role_id' => 'required'
			);
		return Validator::make($data, $rules);
	}

	/**
	* Regra de validação da inserção do usuario	
	*
	**/
	private static function validatorNew( $data){
		$rules = array(
			'name' => 'required',
			'email' => 'required | email | unique:users',
			'role_id' => 'required', 
			'password' => 'required'
			);
		return Validator::make($data, $rules);
	}

	/**
	* Calcular o tempo logado.
	*
	**/
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