@extends('includes/requireLogin')
@extends('includes/master')
@extends('includes/footer')

<?php

use App\Models\Pergunta;
use App\Models\Usuario;

$usuarios = Usuario::all()->where('ativo');
$perguntas = Pergunta::all()->where('ativo');

?>

<form class="m-3" method="POST" name="form" action="{{route('etapas.editar', $etapa)}}">
    @csrf
    @method('put')
    <div class="form-group">
        <label for="exampleFormControlInput1">Nome</label>
        <input type="name" class="form-control" id="nome" name="nome" value="{{$etapa->nome}}">
    </div>

    <div class="form-group">
        <label for="exampleFormControlInput1">Pontuação</label>
        <input type="number" class="form-control" id="pontuacao" name="pontuacao" value="{{$etapa->pontuacao}}">
    </div>

    <div class="m-3">
        <div>
            <p>Escolha a questão desta etapa:
            <select id="pergunta" name="pergunta">
                @foreach($perguntas as $questao)
                <option value="{{$questao->id}}">{{$questao->pergunta}}</option>
                @endforeach
            </select>
            </p>
        </div>

        <div>
            <p>Preencha os usuarios desta etapa:
            <select multiple id="usuario" name="usuario[]">
                @foreach($usuarios as $partipante)
                <option value="{{$partipante->id}}">{{$partipante->nome}}</option>
                @endforeach
            </select>
            </p>
            <p>(Para selecionar varios usuarios, é nescessário segurar a tecla "control" no seu teclado)</p>
        </div>

        <div class="form-group">
        <label for="exampleFormControlInput1">Código da etapa
            <input readonly type="number" value="{{$etapa->numero}}" class="form-control" id="codigo" name="codigo"/> 
        </label>
        </div>

        <button type="submit" class="btn btn-info mt-5">Editar Etapa</button>
        <p>AO EDITAR É NESCESSÁRIO SELECIONAR NOVAMENTE A ETAPA E OS USUARIOS</p>
    </div>
</form>
@if (session('error'))
<div class="alert alert-error">
    {{ session('error') }}
</div>
@endif
