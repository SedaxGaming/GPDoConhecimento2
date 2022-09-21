@extends('includes/requireLogin')

<?php

use App\Models\Usuario;

$usuarios = Usuario::all();
?>
<a href="/painel/cadastros/usuarios/novo">
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
      @foreach($usuarios as $user)
      <tr>
        <td>{{$user->nome}}</td>
        <td>{{$user->email}}</td>
        <td>@if($user->ativo == 1) Ativo @else Inativo @endif</td>
        <td>
          <a href="{{route('usuarios.edit',$user->id)}}"><button type="button" class="btn btn-outline-success btn-info">Visualizar e Editar</button></a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>