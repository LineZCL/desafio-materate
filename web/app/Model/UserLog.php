<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    protected $fillable = ['user_id'];

    public function user()
	{
	    return $this->belongsTo(User::class);
	}
}
