@extends('includes/requireLogin')

<?php

use App\Models\Etapa;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

$etapaAtual = DB::table('etapas')->where('etapaAtual', 1)->first();
$arrayEtapasatual = DB::table('etapas')->where('etapaAtual', 1)->get();
if(isset($etapaAtual)){
  $pergunta = DB::table('perguntas')->where('id', $etapaAtual->idpergunta)->first();
  $jogadores = [];
  $dataInicio = explode(' ',$etapaAtual->dataIncio);
  $dataFim = explode(' ', $etapaAtual->dataFim);
  $contador = (strtotime($etapaAtual->dataFim) - strtotime(Carbon::now('America/Sao_Paulo')));
  foreach ($arrayEtapasatual as $arrayAtual) {
    array_push($jogadores, $arrayAtual->idusuarios);
}
$usuarios = DB::table('usuarios')->whereIn('id', $jogadores)->get();
}
$prova = DB::table('provas')->where('provaAtual', 1)->get();

$arrayIdEtapa = [];

foreach ($prova as $id) {
  array_push($arrayIdEtapa, $id->idetapas);
}

$etapas_prova = Etapa::all()->where('etapaAtual', 0)
->whereIn('id', $arrayIdEtapa)->whereNull('dataFIM')->unique('nome');

?>

<link rel="stylesheet" href="../../js/datatables/dataTables.bootstrap4.min.css">
<script src="../../js/Jquery.js"></script>
<script src="../../js/datatables/jquery.dataTables.min.js"></script>
<script src="../../js/datatables/dataTables.bootstrap4.min.js"></script>
<script src="../../js/datatables/datatables-demo.js"></script>
<script src="../../js/cronometro.js"></script>

<header class="text-center h4 pb-5 mt-3">
  @if (!is_null($etapaAtual))
  ETAPA ATUAL:
</header>
<div class="table-responsive">
  <table class="table table-bordered" id="" width="100%" cellspacing="0">
    <thead>
      <tr class="text-center">
        <th>Nome da etapa: {{$etapaAtual->nome}}</th>
        <th>Pontuação da etapa: {{$etapaAtual->pontuacao}}</th>
        <th>Data de início {{$dataInicio[1]}}</th>
        <th>Data do fim {{$dataFim[1]}}</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th class="text-center" colspan="5">PERGUNTA:</th>
      </tr>
      <tr>
        <td class="text-center" colspan="4">{{$pergunta->pergunta}}</td>
      </tr>
      <th class="text-center" colspan="5">JOGADORES PARTICIPANTES:</th>
      @foreach ($usuarios as $usuario)
      <tr>
        <th class="text-center" colspan="6">{{$usuario->nome}}</th>
      </tr>
      @endforeach
    </tbody>
  </table>

  <div class="row m-4">Tempo restante no cronômetro: 
    <div id="timer"></div>
    <div id="tempo" style="display: none;">{{$contador}}</div>

  </div>
  <form  method="POST" name="FinalizaEtapa" action="{{route('etapas.finalizar')}}">
  @csrf
  @method('put')
    <button type="submit" class="btn btn-danger"> ENCERRAR ETAPA</button>
  </form>


</div>
@elseif (!isset($arrayIdEtapa[0]))
<h3>No MOMENTO nenhuma etapa encontra-se ATIVA!</h3>
<p>Ao iniciar uma prova, a primeira etapa é iniciada automaticamente.</p>
<a href="#" onclick="carregarProvaAtual()"> Você pode clicar aqui para direcionar-se as provas</a>

@else
<h3>A Prova {{$prova[0]->nome}} foi iniciada!</h3>
<p>Escolha a etapa logo abaixo para iniciar à seguir:</p>

<div>
    <form class="m-3" method="POST" name="IniciaEtapa" action="{{route('etapas.iniciar')}}">
      @csrf
      @method('put')
      <div class="form-group">
        <label for="exampleFormControlInput1">Escolha a etapa</label>
        <select id="EtapaIniciar" name="EtapaIniciar">
          @foreach($etapas_prova as $etapa)
          <option value="{{$etapa->numero}}">{{$etapa->nome}}</option>
          @endforeach
          
          <option value="">Todas as etapas desta prova já foram concluidas!</option>
        
        </select>
        <div>
          <label>Insira o tempo limite desta etapa (em minutos)</label>
          <input type="number" name="minutos" id="minutos">
        </div>
        <button type="submit">Iniciar Etapa</button>
      </div>
    </form>
  </div>

@endif