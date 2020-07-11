@extends('layout')

@section('content')



<?php 

$lista = null;
if(Session::get('cargo') == "Administrador" || Session::get('cargo') == "admin" || Session::get('cargo') == "Admin"){
    $lista = 'admin';
}
if(Session::get('cargo') == "Ventas" || Session::get('cargo') == "venta" || Session::get('cargo') == "Vendedor"){
    $lista = 'venta';
}
if(Session::get('cargo') == "Obrero" || Session::get('cargo') == "obrero" || Session::get('cargo') == "Obrero"){
    $lista = 'obrero';
}

?>

<style>
.title{
    margin-left: 2%;
    font-weight: bold;
    font-family: Poppins;
}
.top-5-w{
    margin-top:5%;
}
.table > thead th {
    -webkit-animation: pantallain 100s infinite; /* Safari 4.0 - 8.0 */
    -webkit-animation-direction: alternate; /* Safari 4.0 - 8.0 */
    animation: pantallain 100s infinite;
    animation-direction: alternate;
}
</style>

<div class="enc-article">
    <h4 class="title">Cambio Contraseña</h4>
</div>

<div class="row"> 
    <div class="col-md-4"></div>
    <div class="col-md-4" style="overflow-x:scroll;margin-top:2%">
        <p style="font-size:10pt;font-family:Poppins">Cambio contraseña</p>
        <form action="/contrasena" method="post">
            <label>Nueva Contraseña</label>
            <input type="password" class="form-control" name="password">
            <input type="submit" value="Cambiar Contraseña" class="btn btn-success">
        </form>
    </div>
    <div class="col-md-4"></div>
</div>

@endsection()