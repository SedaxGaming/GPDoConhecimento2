@extends('includes/requireLogin')

<?php

use App\Models\Pergunta;

$perguntas = Pergunta::all();
?>
<a href="/painel/cadastros/perguntas/novo">
  <button type="button" class="btn btn-success mb-4">Novo registro</button>
</a>

<div class="table-responsive">
  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
      <tr>
        <th>Pergunta</th>
        <th>Resposta Correta</th>
        <th>Situação</th>
        <th>Ações</th>
      </tr>
    </thead>

    <tbody>
      @foreach($perguntas as $pergunta)
      <tr>
        <td>{{$pergunta->pergunta}}</td>
        <td>{{$pergunta->respostaCorreta}}</td>
        <td>@if($pergunta->ativo == 1) Ativa @else Inativa @endif</td>
        <td>
          <a href="{{route('perguntas.edit',$pergunta->id)}}"><button type="button" class="btn btn-outline-success btn-info">Visualizar e Editar</button></a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>