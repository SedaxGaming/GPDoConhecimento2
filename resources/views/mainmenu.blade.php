@extends('includes/requireLoginUsuario')
@extends('includes/master')

<?php

use App\Models\Etapa;
use App\Models\Imgquestoe;
use App\Models\Pergunta;
use App\Models\Prova;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

$EtapaAtual = Etapa::where('etapaAtual', 1)->where('idusuarios', session('id'))->first();
$provaAtual = Prova::where('provaAtual', 1)->first();
if ($EtapaAtual != null) {
  $contador = (strtotime($EtapaAtual->dataFim) - strtotime(Carbon::now('America/Sao_Paulo')));
  $respostas = [];
  $pergunta = Pergunta::all()->where('id', $EtapaAtual->idpergunta)->first();
  $imgQuestao = Imgquestoe::where('image', 'like', $pergunta->id . '.%')->first();
  array_push(
    $respostas,
    $pergunta->resposta1,
    $pergunta->resposta2,
    $pergunta->resposta3,
    $pergunta->respostaCorreta
  );
  shuffle($respostas);

  $jaexisteResposta = DB::table('resposta_equipes')
    ->where('idetapas', $EtapaAtual->id)
    ->where('idusuarios', session('id'))
    ->where('numero_prova', $provaAtual->numero)->first();
} else $contador = 0;
if(isset($jaexisteResposta)){
  if($jaexisteResposta){
    unset($pergunta);
  }
}
?>

<script src="../js/cronometro.js"></script>
<script src="../js/Jquery.js"></script>

<div id="conteudo">
  @if (isset($pergunta))
  @if ($contador > 0)
  <meta id="EtapaAtual" content="{{$EtapaAtual->id}}">
  <meta id="provaid" content="{{$provaAtual->numero}}">
  <meta id="userid" content="{{session('id')}}">
  <meta id="csrf-token" content="{{ csrf_token() }}">
  <table class="table table-bordered" id="" width="100%" cellspacing="10%">
    <thead>
      <tr>
        <th class="text-center" colspan="6">Responda a seguinte pergunta:</th>
      </tr>
      <th class="text-center" colspan="6">PERGUNTA: {{$pergunta->pergunta}} 
      @if (!is_null($imgQuestao))
      <img src="/imgquestoes/{{$imgQuestao->image}}" alt="">
      @endif
      </th>
      <tr>
        <th class="text-center" colspan="6"> De acordo com seu conhecimento selecione a resposta que julga ser a correta.</th>
      </tr>
    </thead>
    <div class="form-group">
      <tbody>
        @foreach($respostas as $resposta)
        <tr>
          <td class="center" colspan="6">R: {{$resposta}}</td>
        </tr>
        @endforeach
      </tbody>
  </table>
  <form class="m-3" name="confirmaResposta" action="/">
    <select class="form-select" style="width: 50%;" id="respostas" name="respostas">
      @foreach($respostas as $resposta)
      <option value="{{$resposta}}">{{$resposta}}</option>
      @endforeach
      </select>
    <button type="submit" class="btn btn-danger btn-outline-success btn-lg" id="submeter">CONFIRMAR</button>
  </form>
</div>
<div class="container">
  <div class="row center">
    <div id="tempo" style="display: none;">{{$contador}}</div>
    <div id="timer" class="p-4 m-4 center font-weight-bold"></div>
  </div>
</div>
@endif

@if($contador <= 0) <div>
  <h3 id="aguarde">Aguarde</h3>
  <p>O tempo desta etapa já acabou, aguarde o início da próxima.</p>
  </div>
  @endif

  @else
  <div class="text-center row center">
    <p>
    <h3 id="aguarde">Aguarde</h3>
    <h3> o início da próxima etapa!</h3>
    </p>
  </div>
  @endif

  <script>
    $("#submeter").click(function() {
      event.preventDefault();
      $.post("/resposta/respondendo", {
          _token: $('#csrf-token').attr('content'),
          idEtapa: $('#EtapaAtual').attr('content'),
          userID: $('#userid').attr('content'),
          respostas: $('#respostas').val(),
          provaID: $('#provaid').attr('content'),
        },
        function(data) {
          alert("Resultado: " + data);
        });
      $('#submeter').prop("disabled", true)
      $('#respostas').prop("disabled", true)
      $('#submeter').text('Resposta Cadastrada!');
      document.location.reload(1);
    });

    if ($('#aguarde').text() == 'Aguarde') {
      setTimeout(function() {
        document.location.reload(1);
      }, 1000)
    }
  </script>