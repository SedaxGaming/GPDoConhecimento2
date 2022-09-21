@extends('includes/requireLogin')

<?php

use App\Models\Administradore;

$administradore = Administradore::all();
?>
<a href="/painel/cadastros/administradores/novo">
  <button type="button" class="btn btn-success mb-4">Novo registro</button>
</a>

<div class="table-responsive">
  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
      <tr>
        <th>Nome</th>
        <th>Email</th>
        <th>Situação</th>
        <th>Ações</th>
      </tr>
    </thead>

    <tbody>
      @foreach($administradore as $adm)
      <tr>
        <td>{{$adm->nome}}</td>
        <td>{{$adm->email}}</td>
        <td>@if($adm->ativo == 1) Ativo @else Inativo @endif</td>
        <td>
          <a href="{{route('adm.edit',$adm->id)}}"><button type="button" class="btn btn-outline-success btn-info">Visualizar e Editar</button></a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>