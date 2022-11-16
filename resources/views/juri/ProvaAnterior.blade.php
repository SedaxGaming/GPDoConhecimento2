@extends('includes/requireLogin')

<?php

use App\Models\Prova;
use App\Models\Usuario;

$provas = Prova::all()->where('provaAtual', 0)->whereNotNull('ganhador')->unique('nome');

if(isset($provas)){
  $ganhadores = '';
}

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
        <th>Nome da Prova</th>
        <th>Ganhador</th>
        <th>Código</th>
        <th>Parabenizar</th>
      </tr>
    </thead>
    <tbody>
      @foreach($provas as $prova)
      <tr>
        <td>{{$prova->nome}}</td>
        <?php $ganhadores = Usuario::where('id', $prova->ganhador)->first(); ?>
        <td>{{$ganhadores->nome}}</td>
        <td>{{$prova->numero}}</td>
        <td>
          <a href="{{route('ganhador.show',$prova->numero)}}"><button type="button" class="btn btn-outline-success btn-info">Parabenizar</button></a>
        </td>
      </tr>
    </tbody>
    @endforeach
  </table>
</div>