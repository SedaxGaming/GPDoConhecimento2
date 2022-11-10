@extends('includes/requireLogin')
@extends('includes/master')
@extends('includes/footer')

<?php
use App\Models\Pergunta;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;

$etapas = DB::table('etapas')->orderBy('id', 'desc')->first();
$usuarios = Usuario::all()->where('ativo');
$perguntas = Pergunta::all()->where('ativo');

?>

<form class="m-3" method="POST" name="form">
    @csrf
    <div class="form-group">
        <label for="exampleFormControlInput1">Nome</label>
        <input type="name" class="form-control" id="nome" name="nome" placeholder="Insira um nome para a etapa...">
    </div>

    <div class="form-group">
        <label for="exampleFormControlInput1">Pontuação</label>
        <input type="number" class="form-control" id="pontuacao" name="pontuacao" placeholder="Insira uma pontuação equivalente a esta etapa...">
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
            @if (isset($etapas->id) and $etapas->id != null) 
            <input readonly type="number" value="{{$etapas->id + 1}}" class="form-control" id="codigo" name="codigo"/> 
            @else
            <input readonly type="number" value="1" class="form-control" id="codigo" name="codigo"/> 
            @endif
        </label>
        </div>

        <button type="submit" class="btn btn-info mt-5">Cadastrar Etapa</button>
    </div>
</form>
@if (session('error'))
<div class="alert alert-error">
    {{ session('error') }}
</div>
@endif
