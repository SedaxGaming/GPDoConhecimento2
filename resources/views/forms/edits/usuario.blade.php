@extends('includes/requireLogin')
@extends('includes/master')
@extends('includes/footer')

<form method="POST" name="form" action="{{route('usuarios.editar', $usuario)}}">
    @csrf
    @method('put')
  <div class="form-group">
    <label for="exampleFormControlInput1">Nome</label>
    <input type="name" class="form-control" id="name" name="name" value="{{$usuario->nome}}">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Email</label>
    <input type="email" class="form-control" id="email" name="email" value="{{$usuario->email}}">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Senha</label>
    <input type="password" class="form-control" id="password" name="senha" placeholder="Insira uma nova senha">
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Status</label>
    <select class="form-control" id="exampleFormControlSelect1" name="ativo">
      <option value="1">Ativo</option>
      <option value="0">Inativo</option>
    </select>
  </div>
  <button type="submit" class="btn btn-info">Salvar</button>
</form>
@if (session('error'))
    <div class="alert alert-error">
        {{ session('error') }}
    </div>
@endif