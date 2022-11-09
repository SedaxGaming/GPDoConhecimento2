@extends('includes/requireLogin')
@extends('includes/master')
@extends('includes/footer')

<form method="POST" name="form" enctype="multipart/form-data">
  @csrf
  <div class="form-group">
    <label for="exampleFormControlInput1">Pergunta</label>
    <input type="text" class="form-control" id="pergunta" name="pergunta" placeholder="Insira uma pergunta...">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Resposta correta</label>
    <input type="text" class="form-control" id="Correta" name="respostaCorreta" placeholder="Insira a resposta correta">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Resposta errada 1</label>
    <input type="text" class="form-control" id="resposta1" name="resposta1" placeholder="Insira a resposta errada">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Resposta errada 2</label>
    <input type="text" class="form-control" id="resposta2" name="resposta2" placeholder="Insira a resposta incorreta">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Resposta errada 3</label>
    <input type="text" class="form-control" id="resposta3" name="resposta3" placeholder="Insira a resposta com erros">
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Status</label>
    <select class="form-control" id="exampleFormControlSelect1" name="ativo">
      <option value="1">Ativo</option>
      <option value="0">Inativo</option>
    </select>
    <br>
    <div class="form-group">
      <label for="image">Imagem da questão:</label>
      <input type="file" class="form-control-file" id="image" name="image">
    </div>
    <button type="submit" class="btn btn-info">Cadastrar</button>
</form>
@if (session('error'))
<div class="alert alert-error">
  {{ session('error') }}
</div>
@endif