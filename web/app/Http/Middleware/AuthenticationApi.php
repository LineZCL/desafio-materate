<?php

namespace App\Http\Middleware;

use Closure;
use App\Service\AuthApi\TokenService; 
use App\Http\Controllers\API\HttpCode;

use Illuminate\Support\Facades\Redis;

class AuthenticationApi
{
    /**
     * Verifica pelo token se o usuário tem acesso ao serviço 
     *
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
