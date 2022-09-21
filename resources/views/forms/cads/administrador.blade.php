@extends('includes/requireLogin')
@extends('includes/master')
@extends('includes/footer')

<form method="POST" name="form">
    @csrf
  <div class="form-group">
    <label for="exampleFormControlInput1">Nome</label>
    <input type="name" class="form-control" id="name" name="name" placeholder="Insira um nome...">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Email</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Insira um email">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Senha</label>
    <input type="password" class="form-control" id="password" name="senha" placeholder="******">
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Status</label>
    <select class="form-control" id="exampleFormControlSelect1" name="ativo">
      <option value="1">Ativo</option>
      <option value="0">Inativo</option>
    </select>
    <label for="exampleFormControlSelect1">Permissão</label>
    <select class="form-control" id="exampleFormControlSelect1" name="permissao">
      <option value="0">Apenas placar</option>
      <option value="11">Placar e Cronômetro</option>
      <option value="22">Placar / Cronômetro / Juri</option>
      <option value="33">Todos os acessos</option>
    </select>
  </div>
  <button type="submit" class="btn btn-info">Cadastrar</button>
</form>
@if (session('error'))
    <div class="alert alert-error">
        {{ session('error') }}
    </div>
@endif