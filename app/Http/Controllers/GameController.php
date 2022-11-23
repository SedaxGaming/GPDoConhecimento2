<?php

namespace App\Http\Controllers;

use App\Models\Resposta_equipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GameController extends Controller
{
    public function mainmenu(){
        return view('mainmenu');
    }
    public function lancarResposta(Request $request)
    {
        $input = $request->all();//recebe a resposta
        $jaexiste = DB::table('resposta_equipes')
        ->where('idetapas', $input['idEtapa'])
        ->where('idusuarios',session('id'))
        ->where('numero_prova', $input['provaID'])->first();

        if( $jaexiste == null){//verifica se ja existe uma resposta da equipe
            Resposta_equipe::insert([
                'idetapas' => $input['idEtapa'],
                'idusuarios' => session('id'),
                'resposta' => $input['respostas'],
                'numero_prova' => $input['provaID']
            ]);//processa
            return "Resposta computada com sucesso! Aguarde até a próxima chamada!";
        } else if ($jaexiste != null) {
            return "Uma resposta já foi preenchida para esta etapa, nessa prova! Você deve aguardar até a mesma ser finalizada";
        } else
        return 'Houve um erro ao processar, recarregue a página e tente novamente!';
    }
}
