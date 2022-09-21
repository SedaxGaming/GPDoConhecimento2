<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function show(){
        return view("/tabelas/usuario");
    }
    public function create(){
        return view("/forms/cads/usuario");
    }
    public function edit($id){
        $usuario = Usuario::find($id);
        return view('/forms/edits/usuario', ['usuario' =>$usuario]);
    }
    public function editar(Request $request, Usuario $usuario)
    {
        $type = "";
        if($request->name === null || $request->name === ""){
            $type .= "É nescessário preencher o campo do nome! ";
        } if($request->email === null || $request->email === ""){
            $type .= "É nescessário informar um email! ";
        } if($request->senha === null || $request->senha === ""){
            $type .= "É nescessário informar uma senha! ";
        } 
        if($type != ""){
            return redirect('/painel/cadastros')->with('error', $type);    
        } else{
                $usuario->nome = $request->name;
                $usuario->email = $request->email;
                $usuario->senha = md5($request->senha);
                $usuario->ativo = $request->ativo;
        
                $usuario->save();
                $type = "Alteração feita com sucesso!";
        
            return redirect('/painel/cadastros')->with('error', $type);
        }
           
    }
    public function insert(Request $request){
        $type = "";
        $jatem = Usuario::where('email', '=', $request->email)->count();
        if($request->email === null || $request->email === ""){
            $type .= "É nescessário preencher o campo email! ";
        } if($request->senha === null || $request->senha === ""){
            $type .= "É nescessário informar uma senha! ";
        } if($request->name === null || $request->name === ""){
            $type .= "É nescessário preencher um nome! ";
        } if($jatem >=1){$type .= "Este email já está em uso";}
        
        if($type != ""){
            return redirect('/painel/cadastros/usuarios/novo')->with('error', $type);    
        } else{
            Usuario::insert([
                'nome' => $request->name,
                'email' => $request->email,
                'senha' => md5($request->senha),
                'ativo' => $request->ativo
            ]);
            $type = "Usuario cadastrado com sucesso!";
            return redirect('/painel/cadastros/usuarios/novo')->with('error', $type);
        }
        
    }
}
