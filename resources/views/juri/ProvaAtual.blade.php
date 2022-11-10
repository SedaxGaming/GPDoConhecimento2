@extends('includes/requireLogin')

<?php

use App\Models\Prova;


$prova = Prova::where('provaAtual', '=', 1)->first();
$provaIniciar = Prova::all()->where('provaAtual', 0)->where('ganhador', NULL)->unique('nome');

?>

<link rel="stylesheet" href="../../js/datatables/dataTables.bootstrap4.min.css">
<script src="../../js/Jquery.js"></script>
<script src="../../js/datatables/jquery.dataTables.min.js"></script>
<script src="../../js/datatables/dataTables.bootstrap4.min.js"></script>
<script src="../../js/datatables/datatables-demo.js"></script>

<header class="text-center h4 pb-5 mt-3">
  @if (!is_null($prova))
  Prova ATUAL:
 
<div class="table-responsive">
  <table class="table table-bordered" id="" width="100%" cellspacing="0">
    <thead>
      <tr class="text-center">
        <th>Nome da prova: {{$prova->nome}}</th>
        <th>Código da prova: {{$prova->numero}}</th>
      </tr>
    </thead>
  </table>

  @else
  <h3>No MOMENTO nenhuma prova encontra-se ATIVA!</h3>
  <p>Você pode inicializar uma prova logo abaixo:</p>

  <div>
    <form class="m-3" method="POST" name="IniciaProva" action="{{route('provas.iniciar')}}">
      @csrf
      @method('put')
      <div class="form-group">
        <label for="exampleFormControlInput1">Escolha a prova</label>
        <select id="ProvaIniciar" name="provaIniciar">
          @foreach($provaIniciar as $prova)
          <option value="{{$prova->numero}}">{{$prova->nome}}</option>
          @endforeach
        </select>
        <button type="submit">Iniciar Prova</button>
      </div>
    </form>
  </div>

  @endif
</header>

</div>