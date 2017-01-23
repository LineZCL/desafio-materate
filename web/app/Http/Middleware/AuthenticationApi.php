<?php

namespace App\Http\Middleware;

use Closure;
use App\Service\AuthApi\AuthApiService; 
use App\Http\Controllers\API\HttpErrorsCode;

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
        $authService = new AuthApiService; 
        $tokenAuth = Redis::get('token');
        $token = $authService->findTokenByDescription($tokenAuth);


        if($token == null){
            $errorMessage = ['message' => 'Invalid Token'];//'Invalid token'];
            return response()->json($errorMessage, HttpErrorsCode::BAD_REQUEST);
        }
        return $next($request);
    }
}
