<?php

namespace App\Http\Controllers;

use App\Models\Pergunta;
use Illuminate\Http\Request;

class PerguntasController extends Controller
{
    public function show(){
        return view("/tabelas/perguntas");
    }
    public function create(){
        return view("/forms/cads/pergunta");
    }
    public function edit($id){
        $pergunta = Pergunta::find($id);
        return view('/forms/edits/pergunta', ['pergunta' =>$pergunta]);
    }
    public function editar(Request $request, Pergunta $pergunta)
    {
        $type = "";
        if($request->pergunta === null || $request->pergunta === ""){
            $type .= "É nescessário preencher o campo de pergunta! ";
        } if($request->respostaCorreta === null || $request->respostaCorreta === ""){
            $type .= "É nescessário informar uma resposta correta! ";
        } if($request->resposta1 === null || $request->resposta1 === ""
            || $request->resposta2 === null || $request->resposta2 === ""
            || $request->resposta3 === null || $request->resposta3 === ""){
            $type .= "É nescessário preencher todas as respostas erradas! ";
        }
        
        if($type != ""){
            return redirect('/painel/cadastros')->with('error', $type);    
        } else{
            $pergunta->pergunta =$request->pergunta;
            $pergunta->respostaCorreta =$request->respostaCorreta;
            $pergunta->resposta1 =$request->resposta1;
            $pergunta->resposta2 =$request->resposta2;
            $pergunta->resposta3 =$request->resposta3;
            $pergunta->ativo = $request->ativo;
            $pergunta->save();
            $type = "Cadastro alterado com sucesso!";
            return redirect('/painel/cadastros')->with('error', $type);
        }
           
    }
    public function insert(Request $request){
        $type = "";
        $jatem = Pergunta::where('pergunta', 'like', '%'.$request->pergunta)->count();
        if($request->pergunta === null || $request->pergunta === ""){
            $type .= "É nescessário preencher o campo de pergunta! ";
        } if($request->respostaCorreta === null || $request->respostaCorreta === ""){
            $type .= "É nescessário informar uma resposta correta! ";
        } if($request->resposta1 === null || $request->resposta1 === ""
            || $request->resposta2 === null || $request->resposta2 === ""
            || $request->resposta3 === null || $request->resposta3 === ""){
            $type .= "É nescessário preencher todas as respostas erradas! ";
        } if($jatem >=1){$type .= "Já existe uma pergunta relacionada a esta!";}
        
        if($type != ""){
            return redirect('/painel/cadastros/perguntas/novo')->with('error', $type);    
        } else{
            Pergunta::insert([
                'pergunta' => $request->pergunta,
                'resposta1' => $request->resposta1,
                'resposta2' => $request->resposta2,
                'resposta3' => $request->resposta3,
                'respostaCorreta' => $request->respostaCorreta,
                'ativo' => $request->ativo
            ]);
            $type = "Pergunta cadastrada com sucesso!";
            return redirect('/painel/cadastros/perguntas/novo')->with('error', $type);
        }
        
    }
}
