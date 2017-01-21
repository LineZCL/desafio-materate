<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use MessageBag;
use App\Service\AuthService;

class LoginController extends Controller
{

    public function index(){
        return view('login');
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        return AuthService :: login($email, $password);
    }

    public function logout(){
        Auth::logout();
        return view('login');
    }
}
