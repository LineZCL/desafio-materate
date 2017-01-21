<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'description', 'role_number'
    ];
    
    public function users()
    {
        return $this->hasMany(User::class);
    }

}
