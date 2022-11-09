@extends('includes/requireLogin')

<?php

use App\Models\Prova;

$provas = Prova::all()->whereNull('ganhador')->where('provaAtual', '=', 0)->unique('nome');
?>

<a href="/painel/juri/prova/criar">
  <button type="button" class="btn btn-success mb-4">Novo registro</button>
</a>

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
        <th>Código</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      @foreach($provas as $prova)
      <tr>
        <td>{{$prova->nome}}</td>
        <td>{{$prova->numero}}</td>
        <td>
          <a href="{{route('provas.edit',$prova->id)}}"><button type="button" class="btn btn-outline-success btn-info">Visualizar e Editar</button></a>
        </td>
      </tr>
    </tbody>
    @endforeach
  </table>
</div>