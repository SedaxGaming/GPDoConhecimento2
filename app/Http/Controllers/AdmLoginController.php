<?php

namespace App\Http\Controllers;

use App\Models\Administradore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AdmLoginController extends Controller
{
    public function Login(Request $request){
        $encrypPassword = md5($request->password); //senha encriptada

        $adm = Administradore::where('email', '=', $request->email) //pega os dados inseridos
            ->where('senha','=',$encrypPassword)->count(); 
        if ($adm >=1){
            $access = Administradore::where('email', '=', $request->email) //se corretos
            ->where('senha','=',$encrypPassword)->first();
            session_start();
            $_SESSION["loggedin"] = true;
            session(['loggedin' => true]);
            $_SESSION["email"] = $access->email;
            session(['email' => $access->email]);
            $_SESSION["nome"] = $access->nome;
            session(['nome' => $access->nome]);
            $_SESSION["nperm"] = $access->permissao;
            session(['nperm' => $access->permissao]);
                               
            return redirect('painel');
        }else{ //se incorretos
            $type ="Os dados inseridos estão incorretos, por favor tente novamente!";
            return redirect('adm')->with('error', $type);
        }
        
    }

    public function layout(){ //retorna a view
        return view("adm/login");
    }
}
