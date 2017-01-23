<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
	protected $fillable = ['user_id', 'login_date', 'logout_date', 'token_id'];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function token(){
		return $this->hasOne(Token::class);
	}
}
