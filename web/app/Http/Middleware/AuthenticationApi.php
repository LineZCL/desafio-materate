<?php

namespace App\Http\Middleware;

use Closure;
use App\Service\AuthApi\TokenService; 
use App\Http\Controllers\API\HttpCode;

use Illuminate\Support\Facades\Redis;

class AuthenticationApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $tokenAuth = $request->cookie('token');
        $token = TokenService::findTokenByDescription($tokenAuth);


        if($token == null){
            $errorMessage = ['message' => 'Invalid Token'];//'Invalid token'];
            return response()->json($errorMessage, HttpCode::BAD_REQUEST);
        }
        return $next($request);
    }
}
