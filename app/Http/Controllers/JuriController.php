<?php

namespace App\Http\Controllers;

use App\Jobs\IniciaEtapa;
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

    public function FinalizaEtapa()
    {
        Etapa::where('etapaAtual', 1)->update(['etapaAtual' => 0]);
        $provaAtual = Prova::where('provaAtual', 1); 
        $codEtapas = [];
        foreach ($provaAtual as $prova) {
           array_push($codEtapas,$prova->idetapas);
        };
        $etapas = DB::table('Etapas')->whereNotNull('dataIncio')->whereNotNull('dataFim')->whereIn('id',$codEtapas);
        if($etapas != null){
            Prova::where('provaAtual', 1)->update(['provaAtual' => 0]);
        }
        return redirect('/painel/juri/');
    }
}
