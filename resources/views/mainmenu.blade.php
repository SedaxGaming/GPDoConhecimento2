@extends('includes/requireLoginUsuario')
@extends('includes/master')

<?php

use App\Models\Etapa;
use App\Models\Pergunta;

$EtapaAtual = Etapa::where('etapaAtual', 1)->first();

if ($EtapaAtual != null) {
  $respostas = [];
  $pergunta = Pergunta::all()->where('id', $EtapaAtual->idpergunta)->first();
  array_push(
    $respostas,
    $pergunta->resposta1,
    $pergunta->resposta2,
    $pergunta->resposta3,
    $pergunta->respostaCorreta
  );
  shuffle($respostas);
}

?>

<div id="conteudo">
  @if (isset($pergunta))
  <table class="table table-bordered" id="" width="100%" cellspacing="10%">
    <thead>
      <tr>
        <th class="text-center" colspan="6">Responda a seguinte pergunta:</th>
      </tr>
      <th class="text-center" colspan="6">PERGUNTA: {{$pergunta->pergunta}}</th>
      <tr>
        <th class="text-center" colspan="6"> Escolha a alternativa que mais se encaixa com o enunciado</th>
      </tr>
    </thead>
    <form action="">
      <tbody>
        <!--  -->
        <form class="m-3" method="POST" name="confirmaResposta" action="">
          @csrf
          <div class="form-group">
      <tbody>
        @foreach($respostas as $resposta)
        <tr>
          <td class="center" colspan="5">R: {{$resposta}}</td>
          <td class="center" colspan="1">
            <a href=""><button type="button" class="btn btn-outline-success btn-info">Confirmar</button></a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </form>
    </tbody>
    </form>
  </table>
</div>
@else
  <div class="text-center row center">
    <p>
    <h3>Aguarde o início da próxima etapa!</h3>
    </p>
  </div>
  @endif