<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $fillable = [
        'description', 'active', 'user_id'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
