@extends('includes/requireLogin')
@extends('includes/master')
@extends('includes/footer')

<?php

use App\Models\Etapa;

$etapas = Etapa::all()->where('ganhadores', NULL)->where('dataIncio', NULL)->where('dataFim', NULL)->unique('nome');

?>

<form class="m-3" method="POST" name="form" action="{{route('provas.editar', $prova)}}">
    @csrf
    @method('put')
    <div class="form-group">
        <label for="exampleFormControlInput1">Nome</label>
        <input type="name" class="form-control" id="nome" name="nome" value="{{$prova->nome}}">
    </div>

    <div class="m-3">

        <div>
            <p>Preencha as etapas desta prova:
            <select multiple id="etapas" name="etapas[]">
                @foreach($etapas as $etapa)
                <option value="{{$etapa->id}}">{{$etapa->nome}}</option>
                @endforeach
            </select>
            </p>
            <p>(Para selecionar varios usuarios, é nescessário segurar a tecla "control" no seu teclado)</p>
        </div>

        <div class="form-group">
        <label for="exampleFormControlInput1">Código da prova
            <input readonly type="number" value="{{$prova->numero}}" class="form-control" id="codigo" name="codigo"/> 
        </label>
        </div>

        <button type="submit" class="btn btn-info mt-5">Editar Prova</button>
        <p>AO EDITAR É NESCESSÁRIO SELECIONAR NOVAMENTE AS ETAPAS</p>
    </div>
</form>
@if (session('error'))
<div class="alert alert-error">
    {{ session('error') }}
</div>
@endif
