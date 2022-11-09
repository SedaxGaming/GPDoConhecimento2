@extends('includes/requireLogin')
@extends('includes/master')
<?php

use App\Models\Etapa;
use Illuminate\Support\Facades\DB;

$provaAtual = DB::table('provas')->where('provaAtual', 1)->get();
if (isset ($provaAtual[0])) {
    $respostas = DB::table('resposta_equipes')->where('numero_prova',  $provaAtual[0]->numero)->get();
    $arrayParticipantes = [];
    foreach ($respostas as $resposta) {
        array_push($arrayParticipantes,$resposta->idusuarios);
    }
    $jogadores = DB::table('usuarios')->whereIn('id', $arrayParticipantes)->get();
    $etapa = DB::table('etapas')->where('id',$provaAtual[0]->idetapas)->get();
    $etapas = Etapa::all()->where('numero', $etapa[0]->numero)->unique('idusuario');
}
?>

<link rel="stylesheet" href="/css/placar.css">

@if (isset($jogadores))
<div class="container bootstrap snippets bootdeys">
    <div class="row">
        @foreach ($jogadores as $jogador)
        <div class="col-md-4 col-sm-6 center content-card">
            <div class="card-big-shadow">
                <div class="card card-just-text" data-background="color" data-color="blue" data-radius="none">
                    <div class="content">
                        <h6 class="category">Equipe:</h6>
                        <h4 class="title">{{$jogador->nome}}</h4>
                        <p class="description">Pontuação total</p>
<?php   $resp = DB::table('resposta_equipes')->where('numero_prova',  $provaAtual[0]->numero)->where('idusuarios', $jogador->id)->get();  $respostasCorretas = []; $pontuacao=0;
foreach ($resp as $respFinal) {$perguntas = DB::table('perguntas')->select('id')->where('respostaCorreta', $respFinal->resposta)->get();
    foreach ($perguntas as $pergunta) {array_push($respostasCorretas, $pergunta);}}
    $arrayRespostas =[];
    foreach ($respostasCorretas as $array) {
       array_push($arrayRespostas,$array->id);}
foreach ($etapas as $pontos) {
    if(in_array($pontos->idpergunta,$arrayRespostas))
    {$pontuacao += $pontos->pontuacao;}}?>
                        <p class="title">{{$pontuacao}}</p>
                    </div>
                </div> 
            </div>
        </div>        
        @endforeach
    </div>
</div>
@else

<div>
    <p>
        Nenhuma prova está ativa, ou nenhuma pergunta foi respondida para mostrar a pontuação das equipes.
    </p>
</div>

@endif