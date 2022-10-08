<?php

namespace App\Http\Controllers;

use App\Models\Etapa;
use Illuminate\Http\Request;

class JuriController extends Controller
{
    public function EtapaAtualView(){
        return view('/juri/EtapaAtual');
    }

    public function EtapaAnteriorView(){
        return view('/juri/EtapaAnterior');
    }

    public function CriarEtapaView(){
        return view('/juri/CriarEtapa');
    }

    public function EditarEtapa(){

    }

    public function criarEtapa(){
        return view('/juri/FormCadastro');
    }

    public function EditEtapa(){

    }
    
    public function InsertEtapa(Request $request){
        $type = "";
        if($request->nome === null){
            $type .= "É nescessário preencher o campo do nome da etapa! ";
        } if($request->usuario === null){
            $type .= "É nescessário preencher ao menos um usuario! ";
        } 
        if($type != ""){
            return redirect('/painel/juri/etapa/criar')->with('error', $type);    
        } else{
            $usuarios = $request->usuario;
            foreach ($usuarios as $user) {
                Etapa::insert([
                    'numero' => $request->codigo,
                    'nome' => $request->nome,
                    'pontuacao' => $request->pontuacao,
                    'idpergunta' => $request->pergunta,
                    'idusuarios' => $user,
                    'etapaAtual' => 0
                ]);
            }
            $type = "Etapa cadastrada com sucesso!";
            return redirect('/painel/juri/etapa/criar')->with('error', $type);
        }
    }

    public function ProvaAtualView(){
        return view('/juri/ProvaAtual');
    }

    public function ProvaAnteriorView(){
        return view('/juri/ProvaAnterior');
    }

    public function CriarProvaView(){
        return view('/juri/CriarEtapa');
    }

    public function EditarProva(){

    }

    public function EditProva(){

    }

    public function InsertProva(){

    }
}
