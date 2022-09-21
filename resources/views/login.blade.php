@extends('includes/master') 
@section('title')
GP do Conhecimento 2.0 - Faculdades IDEAU - Programado por Sedax.?/DavesHK
@endsection
@section('body')

<?php
session_start();
if (isset($_SESSION["logado"])) {
  header("location: mainmenu");
  exit;
}
?>

<link rel="stylesheet" href="/css/login.css">

<body>
    <table><h1 class="text-center mt-3" >GP do Conhecimento</h1></table>


@if (session('error'))
    <div class="alert alert-error">
        {{ session('error') }}
    </div>
@endif
<div class="container">
    <div class="card card-login mx-auto text-center bg-dark">
        <div class="card-header mx-auto bg-dark">
            <span> <img src="imagens/logoIdeauPequeno.png"/> </span><br/>
                        <span class="logo_title mt-5"> Painel de equipes </span>
        </div>
        <div class="card-body">
            <form action="" method="post" name="formulario">
                @csrf
                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text mb-4"><img src="/svgs/solid/user.svg" alt=""></span>
                    </div>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email">
                </div>

                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text mb-4"><img src="svgs/solid/lock.svg" alt=""></span>
                    </div>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Senha">
                </div>

                <div class="form-group">
                <button type="submit" class="btn btn-outline-danger float-right login_btn" data-toggle="modal"
                    data-target="#exampleModalCenter"> 
                    Login
                </button>
                </div>
            </form>
            <img class="ml-0 mr-10" src="imagens/logoCerebrandoPequeno.png" />
        </div>
    </div>
</div>
    @endsection
</body>
