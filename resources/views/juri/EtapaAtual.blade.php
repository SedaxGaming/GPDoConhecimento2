@extends('includes/requireLogin')

<?php

use Illuminate\Support\Facades\DB;

$etapa = DB::table('etapas')->where('etapaAtual', 1)->first();

?>

<link rel="stylesheet" href="../../js/datatables/dataTables.bootstrap4.min.css">
<script src="../../js/Jquery.js"></script>
<script src="../../js/datatables/jquery.dataTables.min.js"></script>
<script src="../../js/datatables/dataTables.bootstrap4.min.js"></script>
<script src="../../js/datatables/datatables-demo.js"></script>

<header class="text-center h4 pb-5 mt-3">
@if (!is_null($etapa))
    ETAPA ATUAL: 
@else No MOMENTO nenhuma etapa encontra-se ATIVA! @endif
</header>

@if (!is_null($etapa))
<div class="table-responsive">
  <table class="table table-bordered" id="" width="100%" cellspacing="0">
    <thead>
      <tr class="text-center">
        <th>Nome da etapa: {{$etapa->nome}}</th>
        <th>Pontuação da etapa: {{$etapa->pontuacao}}</th>
        <th>Data de início {{$etapa->dataIncio}}</th>
        <th>Data do fim {{$etapa->dataFim}}</th>
      </tr>
        <tr>
            <th class="text-center" colspan="5">PERGUNTA:</th>
        </tr>
    </thead>
    <tbody>
       <tr>
            <td class="text-center" colspan="4">pergunta</td>
       </tr>
            <th class="text-center" colspan="5">JOGADORES PARTICIPANTES:</th>
       <tr>
       <td class="text-center" colspan="4">Resposta</td>
       </tr>
    </tbody>
  </table>

  <div> Tempo restante no cronômetro:</div>

  <button class="btn btn-danger"> ENCERRAR ETAPA</button>
  @endif

</div>