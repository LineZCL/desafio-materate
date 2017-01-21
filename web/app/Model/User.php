<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const COMON = 1; 
    const ADMIN = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function userLogs()
    {
        return $this->hasMany(UserLog::class);
    }

    public function role(){    
        return $this->belongsTo('App\Model\Role');
    }

    /*
    * Verifica se o usuário é ou não admin;
    */
    public function isAdmin(){
            return $this->role->role_number == User::ADMIN;
    }
}
