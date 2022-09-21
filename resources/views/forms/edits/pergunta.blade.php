@extends('includes/requireLogin')
@extends('includes/master')
@extends('includes/footer')

<form method="POST" name="form" action="{{route('perguntas.editar', $pergunta)}}">
    @csrf
    @method('put')
  <div class="form-group">
    <label for="exampleFormControlInput1">Pergunta</label>
    <input type="text" class="form-control" id="pergunta" name="pergunta" value="{{$pergunta->pergunta}}">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Resposta correta</label>
    <input type="text" class="form-control" id="Correta" name="respostaCorreta"  value="{{$pergunta->respostaCorreta}}">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Resposta errada 1</label>
    <input type="text" class="form-control" id="resposta1" name="resposta1" value="{{$pergunta->resposta1}}">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Resposta errada 2</label>
    <input type="text" class="form-control" id="resposta2" name="resposta2" value="{{$pergunta->resposta2}}">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Resposta errada 3</label>
    <input type="text" class="form-control" id="resposta3" name="resposta3" value="{{$pergunta->resposta3}}">
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Status</label>
    <select class="form-control" id="exampleFormControlSelect1" name="ativo">
      <option value="1">Ativo</option>
      <option value="0">Inativo</option>
    </select>
  
  <button type="submit" class="btn btn-info">Salvar</button>
</form>
@if (session('error'))
    <div class="alert alert-error">
        {{ session('error') }}
    </div>
@endif