<?php

namespace App\Http\Controllers;

use App\Models\Administradore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AdmLoginController extends Controller
{
    public function Login(Request $request){
        //TODO -> capturar o request e verificar os dados no banco de dados. retornar o painel principal 
        $adm = Administradore::where('email', '=', $request->email)
            ->where('senha','=',$request->password)->count(); 
        
        if ($adm >=1){

            echo("ok!");
        }else{
            $type ="Os dados inseridos estão incorretos, por favor tente novamente!";
            return redirect('adm')->with('error', $type);
            
            
        }
        
    }

    public function layout(){
        return view("adm/login");
    }
}
