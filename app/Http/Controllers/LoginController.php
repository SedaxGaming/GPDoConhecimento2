<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function Login(Request $request){
        //TODO -> Verificar o login no banco e levar ao menu do jogo
        $user = Usuario::where('email', '=', $request->email)
            ->where('senha','=',$request->password)->count(); 
        
        if ($user >=1){

            echo("ok!");
        }else{
            $type ="Os dados inseridos estão incorretos, por favor tente novamente!";
            return redirect('login')->with('error', $type);
            
    }
}

    public function layout(){
        return view("login");
    }
}
