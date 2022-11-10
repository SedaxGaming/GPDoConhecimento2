<?php

namespace App\Http\Controllers;

use App\Models\Etapa;
use App\Models\Prova;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JuriController extends Controller
{
    public function EtapaAtualView()
    {
        return view('/juri/EtapaAtual');
    }

    public function EtapaAnteriorView()
    {
        return view('/juri/EtapaAnterior');
    }

    public function CriarEtapaView()
    {
        return view('/juri/CriarEtapa');
    }

    public function EditarEtapa(Request $request)
    {
        $type = "";
        if ($request->nome === null) {
            $type .= "É nescessário preencher o campo do nome da etapa! ";
        }
        if ($request->usuario === null) {
            $type .= "É nescessário preencher ao menos um usuario! ";
        }
        if ($type != "") {
            return redirect('/painel/juri/')->with('error', $type);
        } else {
            Etapa::where('numero', $request->codigo)->delete();
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
            return redirect('/painel/juri/')->with('error', $type);
        }
    }

    public function criarEtapa()
    {
        return view('/juri/FormCadastroEtapa');
    }

    public function EditEtapa($id)
    {
        $etapa = Etapa::find($id);
        return view('/juri/FormEditEtapa', ['etapa' => $etapa]);
    }

    public function VerEtapa($id)
    {
        $etapa = Etapa::find($id);
        return view('/juri/FormVerEtapa', ['etapa' => $etapa]);
    }

    public function InsertEtapa(Request $request)
    {
        $type = "";
        if ($request->nome === null) {
            $type .= "É nescessário preencher o campo do nome da etapa! ";
        }
        if ($request->usuario === null) {
            $type .= "É nescessário preencher ao menos um usuario! ";
        }
        if ($request->pontuacao === null) {
            $type .= "A pergunta precisa ter uma pontuação! ";
        }
        if ($type != "") {
            return redirect('/painel/juri/etapa/criar')->with('error', $type);
        } else {
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
            return redirect('/painel/juri')->with('error', $type);
        }
    }

    public function ProvaAtualView()
    {
        return view('/juri/ProvaAtual');
    }

    public function ProvaAnteriorView()
    {
        return view('/juri/ProvaAnterior');
    }

    public function CriarProvaView()
    {
        return view('/juri/CriarProva');
    }

    public function EditarProva(Request $request)
    {
        $type = "";
        if ($request->nome === null) {
            $type .= "É nescessário preencher o campo do nome da prova! ";
        }
        if ($request->etapas === null) {
            $type .= "É nescessário preencher ao menos uma etapa! ";
        }
        if ($type != "") {
            return redirect('/painel/juri/')->with('error', $type);
        } else {
            Prova::where('numero', $request->codigo)->delete();
            $etapas = $request->etapas;
            foreach ($etapas as $etapa) {
                Prova::insert([
                    'numero' => $request->codigo,
                    'nome' => $request->nome,
                    'idetapas' => $etapa,
                    'provaAtual' => 0
                ]);
            }
            $type = "Prova cadastrada com sucesso!";
            return redirect('/painel/juri/')->with('error', $type);
        }
    }

    public function EditProva($id)
    {
        $prova = Prova::find($id);
        return view('/juri/FormEditProva', ['prova' => $prova]);
    }

    public function InsertProva(Request $request)
    {
        $type = "";
        if ($request->nome === null) {
            $type .= "É nescessário preencher o campo do nome da prova! ";
        }
        if ($request->etapas === null) {
            $type .= "É nescessário preencher ao menos uma etapa! ";
        }
        if ($type != "") {
            return redirect('/painel/juri/prova/criar')->with('error', $type);
        } else {
            $etapas = $request->etapas;
            foreach ($etapas as $etapa) {
                Prova::insert([
                    'numero' => $request->codigo,
                    'nome' => $request->nome,
                    'idetapas' => $etapa,
                ]);
            }
            $type = "Prova cadastrada com sucesso!";
            return redirect('/painel/juri')->with('error', $type);
        }
    }

    public function criarProva()
    {
        return view('/juri/FormCadastroProva');
    }

    public function IniciaProva(Request $request)
    {
        Prova::where('numero', $request->provaIniciar)->update(['provaAtual' => 1]);

        return redirect('/painel/juri/');
    }

    public function IniciaEtapa(Request $request)
    {
        $type = "";
        if ($request->minutos === null) {
            $type .= "É nescessário preencher um tempo para a etapa! ";
        }
        if ($type != "") {
            return redirect('/painel/juri')->with('error', $type);
        } else {
            $datainicio = Carbon::now('America/Sao_Paulo');
            $datafim = Carbon::now('America/Sao_Paulo')->addMinutes($request->minutos);
            Etapa::where('numero', $request->EtapaIniciar)
                ->update(['etapaAtual' => 1, 'dataIncio' => $datainicio, 'dataFim' => $datafim]);
            return redirect('/painel/juri/');
        }
    }

    public function showGanhador($numero){
        return view('/ganhador', ['prova' => $numero]);
    }

    public function FinalizaEtapa()
    {
        $this->adicionarGanhador();
        Etapa::where('etapaAtual', 1)->update(['etapaAtual' => 0, 'dataFim' => Carbon::now('America/Sao_Paulo')]);
        $provaAtual = Prova::where('provaAtual', 1)->get();
        $numeroProva= '';
        $codEtapas = [];
        foreach ($provaAtual as $prova) {
            array_push($codEtapas, $prova->idetapas);
            $numeroProva = $prova->numero;
        };
        $etapas = DB::table('Etapas')->whereNull('dataIncio')->whereNull('dataFim')->whereIn('id', $codEtapas)->get();
        if (!isset($etapas[0])) {//encerra a Prova tambem
            $this->adicionarGanhador();
            Prova::where('provaAtual', 1)->update(['provaAtual' => 0]); 
            $this->showGanhador($numeroProva);
        }
        return redirect('/painel/juri/');
    }

    private function adicionarGanhador()
    {
        $arrayFinal = array();
        $provaAtual = DB::table('provas')->where('provaAtual', 1)->get();
        if (isset($provaAtual[0])) {
            $respostas = DB::table('resposta_equipes')->where('numero_prova',  $provaAtual[0]->numero)->get();
            $arrayParticipantes = [];
            foreach ($respostas as $resposta) {
                array_push($arrayParticipantes, $resposta->idusuarios);
            }
            $jogadores = DB::table('usuarios')->whereIn('id', $arrayParticipantes)->get();
            $etapa = DB::table('etapas')->where('id', $provaAtual[0]->idetapas)->get();
            $etapas = Etapa::all()->where('numero', $etapa[0]->numero)->unique('idusuario');

            foreach ($jogadores as $jogador) {
                $resp = DB::table('resposta_equipes')->where('numero_prova',  $provaAtual[0]->numero)->where('idusuarios', $jogador->id)->get();
                $respostasCorretas = [];
                $pontuacao = 0;
                foreach ($resp as $respFinal) {
                    $perguntas = DB::table('perguntas')->select('id')->where('respostaCorreta', $respFinal->resposta)->get();
                    foreach ($perguntas as $pergunta) {
                        array_push($respostasCorretas, $pergunta);
                    }
                }
                $arrayRespostas = [];
                foreach ($respostasCorretas as $array) {
                    array_push($arrayRespostas, $array->id);
                }
                foreach ($etapas as $pontos) {
                    if (in_array($pontos->idpergunta, $arrayRespostas)) {
                        $pontuacao += $pontos->pontuacao;
                    }
                }
                array_push($arrayFinal,[
                    'jogador' => $jogador->id,
                    'pontuacao final' => $pontuacao
                ]);
            }
        }
        $ganhador = '';
        $pontosGanhador = null;
        foreach ($arrayFinal as $total) {
            if($total['pontuacao final'] > $pontosGanhador){
                $ganhador = $total['jogador'];
                $pontosGanhador = $total['pontuacao final'];
            } 
            // o codigo comentado a baixo referencia o progresso se caso mais de um jogador finalizar com a mesma quantidade de pontos, no momento não define ganhador
            // else if ($total['pontuacao final'] == $pontosGanhador){
            //     $ganhador .= ' ' . $total['jogador'];
            //     $pontosGanhador = $total['pontuacao final'];
            // }
            // if (str_contains($ganhador, ' ')) {
            //     $ganhadores = explode(' ', $ganhador);
            //     foreach ($ganhadores as $winner) {
            //         dd($provaAtual);
            //         $provaAtual = DB::table('provas')->where('provaAtual', 1);
            //     }
            // }
        }
        DB::table('provas')->where('provaAtual', 1)->update(['ganhador' => $ganhador]);
    }
}
