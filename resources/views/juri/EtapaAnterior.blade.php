@extends('includes/requireLogin')

<?php

use App\Models\Etapa;

$etapas = Etapa::all()->whereNotNull('dataFim')->unique('nome');;

?>

<link rel="stylesheet" href="../../js/datatables/dataTables.bootstrap4.min.css">
<script src="../../js/Jquery.js"></script>
<script src="../../js/datatables/jquery.dataTables.min.js"></script>
<script src="../../js/datatables/dataTables.bootstrap4.min.js"></script>
<script src="../../js/datatables/datatables-demo.js"></script>


<link rel="stylesheet" href="../../js/datatables/dataTables.bootstrap4.min.css">
<script src="../../js/Jquery.js"></script>
<script src="../../js/datatables/jquery.dataTables.min.js"></script>
<script src="../../js/datatables/dataTables.bootstrap4.min.js"></script>
<script src="../../js/datatables/datatables-demo.js"></script>

<div class="table-responsive">
  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
      <tr>
        <th>Nome</th>
        <th>Pontuação</th>
        <th>Código</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      @foreach($etapas as $etapa)
      <tr>
        <td>{{$etapa->nome}}</td>
        <td>{{$etapa->pontuacao}}</td>
        <td>{{$etapa->numero}}</td>
        <td>
          <a href="{{route('etapas.visualizar',$etapa->id)}}"><button type="button" class="btn btn-outline-success btn-info">Visualizar</button></a>
        </td>
      </tr>
    </tbody>
    @endforeach
  </table>
</div>