<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function Login(Request $request){

        $encrypPassword = md5($request->password);
        $user = Usuario::where('email', '=', $request->email)
            ->where('senha','=',$encrypPassword)->count(); 

            if ($user >=1){
                $access = Usuario::where('email', '=', $request->email)
                ->where('senha','=',$encrypPassword)->first();
                session_start();
    
                $_SESSION["logado"] = true;
                session(['logado' => true]);
                $_SESSION["nome"] = $access->nome;
                session(['nome' => $access->nome]);
                $_SESSION["email"] = $access->email;
                session(['email' => $access->email]);
                
            return redirect('mainmenu');
        }else{
            $type ="Os dados inseridos estão incorretos, por favor tente novamente!";
            return redirect('login')->with('error', $type);
            
    }
}

    public function layout(){
        return view("login");
    }
}
