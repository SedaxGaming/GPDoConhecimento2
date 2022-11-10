@extends('includes/requireLogin')
@extends('includes/master')
@extends('includes/footer')

<?php

use App\Models\Etapa;
use App\Models\Pergunta;
use App\Models\Usuario;

$codUsuarios = [];
$perguntas = Pergunta::where('id', $etapa->idpergunta)->first();
$etapas = Etapa::where('numero', $etapa->numero)->get();
foreach ($etapas as $partida) {
    array_push($codUsuarios, $partida->idusuarios);
}
$usuarios = Usuario::whereIn('id', $codUsuarios)->get();

?>
<div class="p-3 m-3">
    <div class="container">
        <div class="row">

            <div class="form-group col-sm">
                <label for="exampleFormControlInput1">Nome da etapa</label>
                <input readonly type="name" class="form-control" id="nome" name="nome" value="{{$etapa->nome}}">
            </div>

            <div class="form-group col-sm">
                <label for="exampleFormControlInput1">Pontuação da etapa</label>
                <input readonly type="number" class="form-control" id="pontuacao" name="pontuacao" value="{{$etapa->pontuacao}}">
            </div>
            <div class="form-group col-sm">
                <label for="exampleFormControlInput1">Código da etapa
                    <input readonly type="number" value="{{$etapa->numero}}" class="form-control" id="codigo" name="codigo" />
                </label>
            </div>
        </div>
    </div>
    <br>

    <div class="container">
        <div class="row">
            <div class="col-md">
                <p>Questão utilizada na etapa:</p>
                <h4>Código: {{$etapa->idpergunta}}, {{$perguntas->pergunta}}</h4>
            </div>
            <div class="col-md">
                <p>Usuarios participantes:
                    @foreach($usuarios as $partipante)
                <h5>Cód {{$partipante->id}} --> {{$partipante->nome}}</h5>
                @endforeach
                </select>
                </p>
            </div>
        </div>
        <br><br><br><br>
        <div class="container">
            <div class="row">
                <div class="col-md">
                    <p>Início:</p>
                    <h4>{{$etapa->dataIncio}}</h4>
                </div>
                <div class="col-md">
                    <p>Final:</p>
                    <h4>{{$etapa->dataFim}}</h4>
                </div>
            </div>
        </div>
    </div>
</div>