@extends('layout')

@section('content')

<form action="/invitados/create" method="POST">
    <input type="email" class="form-control" name="correo" id="correo" placeholder="Correo">
    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre">
    <input type="hidden" class="form-control" value="{{ $calendario['id'] }}" name="id_calendario" id="id_calendario" >
    <input type="hidden" class="form-control" value="1" name="id_directorio" id="id_directorio">
    <input type="submit" value="Enviar" class="btn">
</form>



@endsection()