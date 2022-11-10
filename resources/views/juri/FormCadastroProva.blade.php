@extends('includes/requireLogin')
@extends('includes/master')
@extends('includes/footer')

<?php

use App\Models\Etapa;
use App\Models\Prova;

$etapas = Etapa::all()->unique('nome');
$provas = Prova::orderBy('id', 'desc')->first();

?>

<form class="m-3" method="POST" name="form">
    @csrf
    <div class="form-group">
        <label for="exampleFormControlInput1">Nome</label>
        <input type="name" class="form-control" id="nome" name="nome" placeholder="Insira um nome para a prova...">
    </div>

        <div>
            <p>Preencha as etapas desta prova:
            <select multiple id="etapas" name="etapas[]">
                @foreach($etapas as $etapa)
                <option value="{{$etapa->id}}">{{$etapa->nome}}</option>
                @endforeach
            </select>
            </p>
            <p>(Para selecionar varios, é nescessário segurar a tecla "control" no seu teclado)</p>
        </div>

        <div class="form-group">
        <label for="exampleFormControlInput1">Código da prova
            @if (isset($provas->id) and $provas->id != null) 
            <input readonly type="number" value="{{$provas->id + 1}}" class="form-control" id="codigo" name="codigo"/> 
            @else
            <input readonly type="number" value="1" class="form-control" id="codigo" name="codigo"/> 
            @endif
        </label>
        </div>

        <button type="submit" class="btn btn-info mt-5">Cadastrar Prova</button>
    </div>
</form>
@if (session('error'))
<div class="alert alert-error">
    {{ session('error') }}
</div>
@endif
