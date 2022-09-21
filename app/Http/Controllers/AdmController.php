<?php

namespace App\Http\Controllers;

use App\Models\Administradore;
use Illuminate\Http\Request;

class AdmController extends Controller
{
    public function layout(){
        return view("adm/painel");
    }
    public function menuCadastros(){
        return view("adm/cadastros");
    }
    public function menuJuri(){
        return view("adm/juri");
    }
    public function placar(){
        return view("adm/placar");
    }
    public function cronometro(){
        return view("adm/cronometro");
    }

    public function show(){
        return view("/tabelas/administradores");
    }
    public function create(){
        return view("/forms/cads/administrador");
    }
    public function edit($id){
        $adm = Administradore::find($id);
        return view('/forms/edits/administrador', ['adm' =>$adm]);
    }
    public function editar(Request $request, Administradore $adm)
    {
        $type = "";
        if($request->name === null || $request->name === ""){
            $type .= "É nescessário preencher o campo do nome! ";
        } if($request->email === null || $request->email === ""){
            $type .= "É nescessário informar um email! ";
        } if($request->senha === null || $request->senha === ""){
            $type .= "É nescessário preencher uma nova senha! ";
        }
        if($type != ""){
            return redirect('/painel/cadastros')->with('error', $type);    
        } else{
            $adm->nome =$request->name;
            $adm->email =$request->email;
            $adm->senha =md5($request->senha);
            $adm->ativo =$request->ativo;
            $adm->permissao =$request->permissao;
            $adm->save();
            $type = "Cadastro alterado com sucesso!";
            return redirect('/painel/cadastros')->with('error', $type);
        }
           
    }
    public function insert(Request $request){
        $type = "";
        $jatem = Administradore::where('email', '=', $request->email)->count();
        if($request->email === null || $request->email === ""){
            $type .= "É nescessário preencher o campo email! ";
        } if($request->senha === null || $request->senha === ""){
            $type .= "É nescessário informar uma senha! ";
        } if($request->name === null || $request->name === ""){
            $type .= "É nescessário preencher um nome! ";
        } if($jatem >=1){$type .= "Este email já está em uso";}
        
        if($type != ""){
            return redirect('/painel/cadastros/administradores/novo')->with('error', $type);    
        } else{
            Administradore::insert([
                'nome' => $request->name,
                'email' => $request->email,
                'senha' => md5($request->senha),
                'ativo' => $request->ativo,
                'permissao' => $request->permissao
            ]);
            $type = "Administrador cadastrado com sucesso!";
            return redirect('/painel/cadastros/administradores/novo')->with('error', $type);
        }
        
    }
}
