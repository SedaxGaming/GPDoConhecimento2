@extends('includes/master') 
@section('title')
GP do Conhecimento 2.0 - Faculdades IDEAU - Programado por Sedax.?/DavesHK
@endsection
@section('body')

<source src="{{asset('resources/js/*')}}" type="stylesheet">

<body>
    <table><h1>GP do Conhecimento</h1></table>
    
<div class="ml-50 my-50">
    <form action="login" method="post" name="formulario">
        @csrf
        <div>
        <label class="form-label">Usuário</label>
        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email"> 
        <div id="emailHelp" class="form-text">Use o seu email para fazer login</div>
        </div>
    <div class="mb-3">
        <label class="form-label">Senha</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
        <button type="submit" class="btn btn-primary">Logar</button>
</form>
</div>

<div id="footer" class="footer">
	<div class="container">
		<div id='horaAtual' class="footer-left"></div>
		<div id="logos" class="footer-right">
			&nbsp;
			<img src="imagens/logoIdeauPequeno.png" />
			&nbsp;
			<img src="imagens/logoCerebrandoPequeno.png" />
			&nbsp;
		</div>
	</div>
</div>
@endsection
</body>
