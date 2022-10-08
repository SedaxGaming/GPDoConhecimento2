@extends('includes/requireLogin')
@extends('includes/master')
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
</head>

<script src="../js/Jquery.js"></script>

<body>
    <div class="d-flex" id="wrapper">
        <div class="border-end bg-white" id="sidebar-wrapper">
            <div class="list-group list-group-flush">
                <div class="pl-3" >Etapas:</div>
                <a onclick="carregarEtapaAtual()" class="list-group-item list-group-item-action list-group-item-light p-3" >Etapa Atual</a>
                <a onclick="carregarEtapaAnterior()" class="list-group-item list-group-item-action list-group-item-light p-3" >Etapas anteriores</a>
                <a onclick="carregarCriarEtapa()" class="list-group-item list-group-item-action list-group-item-light p-3" >Criar/Editar etapa</a>
                <div>Provas:</div>
                <a onclick="carregarProvaAtual()" class="list-group-item list-group-item-action list-group-item-light p-3" >Prova Atual</a>
                <a onclick="carregarProvaAnterior()" class="list-group-item list-group-item-action list-group-item-light p-3" >Provas anteriores</a>
                <a onclick="carregarCriarProva()" class="list-group-item list-group-item-action list-group-item-light p-3" >Criar/Editar Prova</a>
            </div>
        </div>
            <div class="container-fluid">
                <div id="conteudo">
                    
                </div>
            </div>
    </div>
</body>

</html>

<script>
    $("#conteudo").load("/painel/juri/EtapaAtual");
    function carregarEtapaAtual(){
        $("#conteudo").load('/painel/juri/EtapaAtual');
    }
  function carregarEtapaAnterior(){
        $("#conteudo").load('/painel/juri/EtapasAnteriores');
    }
  function carregarCriarEtapa(){
        $("#conteudo").load('/painel/juri/CriarEtapa');
    }
    function carregarProvaAtual(){
        $("#conteudo").load('/painel/juri/ProvaAtual');
    }
  function carregarProvaAnterior(){
        $("#conteudo").load('/painel/juri/ProvasAnteriores');
    }
  function carregarCriarProva(){
        $("#conteudo").load('/painel/juri/CriarProva');
    }

</script>

<style>
    #conteudo{
        position: relative;
        height: 100%;
    }

</style>


@extends('includes/footer')