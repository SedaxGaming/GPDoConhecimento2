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
    
                $_SESSION["logged"] = true;
                session(['logged' => true]);
                $_SESSION["name"] = $access->nome;
                session(['name' => $access->nome]);
                $_SESSION["mail"] = $access->email;
                session(['mail' => $access->email]);
                $_SESSION["id"] = $access->id;
                session(['id' => $access->id]);
                
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
