<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Auth;
use MessageBag;
use App\Service\AuthService;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{

    public function index(){
        return view('/auth/login');
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        return AuthService :: login($email, $password);
    }

    public function logout(){
        return AuthService :: logout();
    }
}
