<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Authentication
{
    /**
     * Se o usuário não estiver logado, enviar para a página de login. 
     *
     */
    public function handle($request, Closure $next)
    {
        if( Auth::guest() ){
            return redirect('/login');
        }
        return $next($request);
    }
}
