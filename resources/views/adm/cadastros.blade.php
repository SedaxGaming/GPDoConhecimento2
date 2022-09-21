<?php

use App\Models\Administradore;
use App\Models\Pergunta;
use App\Models\Usuario;

$usuarios = Usuario::all();
$administradores = Administradore::all();
$perguntas = Pergunta::all();

?>

@extends('includes/requireLogin')
@extends('includes/master')

<link rel="stylesheet" href="/css/cadastros.css">
<script src="/js/Jquery.js"></script>
<script src="/js/cadastros.js"></script>

@if (session('error'))
    <div class="alert alert-error">
        {{ session('error') }}
    </div>
@endif

<nav class="navbar navbar-expand-custom navbar-mainbg">
    <a class="navbar-brand navbar-logo" href="../"><img src="/imagens/logoIdeauPequeno.png" alt="Logo"></a>
    <button class="navbar-toggler" type="button" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"></button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <div class="hori-selector">
                <div class="left"></div>
                <div class="right"></div>
            </div>
            <li class="nav-item active">
                <a class="nav-link" onclick="carregarUsuarios()" href="javascript:void(0);">Usuarios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" onclick="carregarPerguntas()" href="javascript:void(0);">Perguntas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" onclick="carregarAdministradores()" href="javascript:void(0);">Administradores</a>
            </li>
        </ul>
    </div>
</nav>

<div class="card shadow mb-4">

<div id="tabela" class="card-body"></div>

@extends('includes/footer')

<script>
  $("#tabela").load("/painel/cadastros/usuarios");
  function carregarUsuarios(){
        $("#tabela").load('/painel/cadastros/usuarios');
    }
  function carregarPerguntas(){
        $("#tabela").load('/painel/cadastros/perguntas');
    }
  function carregarAdministradores(){
        $("#tabela").load('/painel/cadastros/administradores');
    }
</script>