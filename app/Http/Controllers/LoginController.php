<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function Login(Request $request){
        //TODO -> Verificar o login no banco e levar ao menu do jogo
        $email = $request ->email;
        $senha = $request ->password;
        $string = "Seu email:" . $email . "sua senha:" . $senha;
        return ($request);
    }

    public function layout(){
        return view("login");
    }
}
