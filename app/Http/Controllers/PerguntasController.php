<?php

namespace App\Http\Controllers;

use App\Models\Imgquestoe;
use App\Models\Pergunta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isNull;

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
        $imagequestao = Imgquestoe::where('image', 'like', $pergunta->id. '.%')->get();
        return view('/forms/edits/pergunta', ['pergunta' =>$pergunta, 'imgquestao'=> (isset($imagequestao[0]) ? $imagequestao : null)]);
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
        }
        if($request->hasFile('image') && $request->file('image')->isValid()){
            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = $pergunta->id . '.' . $extension;

            $requestImage->move(public_path('imgquestoes'), $imageName);
            
            $existeIMG = Imgquestoe::where('image', 'like', $pergunta->id. '.%')->get();

            if (!isset($existeIMG[0])){
                Imgquestoe::insert([
                    'image' => $imageName
                ]);
            }

            $type .= "Imagem alterada com sucesso! ";
        }
        return redirect('/painel/cadastros')->with('error', $type);

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
        } if($jatem >=3){$type .= "Já existe uma pergunta relacionada a esta!";}

        if($type != ""){
            return redirect('/painel/cadastros/perguntas/novo')->with('error', $type);    
        } else{
            $perguntaSalva = Pergunta::insert([
                'pergunta' => $request->pergunta,
                'resposta1' => $request->resposta1,
                'resposta2' => $request->resposta2,
                'resposta3' => $request->resposta3,
                'respostaCorreta' => $request->respostaCorreta,
                'ativo' => $request->ativo
            ]);

            if($request->hasFile('image') && $request->file('image')->isValid()){

                $requestImage = $request->image;
    
                $extension = $requestImage->extension();
    
                $Ultimapergunta = DB::table('perguntas')->orderBy('id', 'desc')->first();
                $imageName = $Ultimapergunta->id . '.' . $extension;

                $requestImage->move(public_path('imgquestoes'), $imageName);

                Imgquestoe::insert([
                    'image' => $imageName
                ]);

                $type .= "Imagem cadastrada com sucesso! ";
            }
            $type .= "Pergunta cadastrada com sucesso! ";
            return redirect('/painel/cadastros/perguntas/novo')->with('error', $type);
        }
        
    }
}
