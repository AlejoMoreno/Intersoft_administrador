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
    <h4 class="title">Tablero</h4>
</div>

<div class="row top-5-w">
    <div class="col-md-5" style="overflow-x:scroll;margin-left:2%">
        <p style="font-size:10pt;font-family:Poppins">Rutas asignadas</p>
        <table class="table table-sm  table-striped" id="datos">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Cliente</th>
                    <th>Direccion</th>
                    <th>Zona</th>
                    <th>Telefono</th>
                </tr>
            </thead>
            <tbody>
                @if($zona!=null)
                    @foreach($zona as $obj)
                    <tr>
                        <td>{{ $obj['id_usuario']['ncedula'] }} - {{ $obj['id_usuario']['correo'] }}</td>
                        <td>{{ $obj['id_tercero']['nit'] }} - {{ $obj['id_tercero']['razon_social'] }}</td>
                        <td>{{ $obj['id_tercero']['direccion'] }}</td>
                        <td>{{ $obj['zona'] }}</td>
                        <td>{{ $obj['id_tercero']['telefono'] }} - {{ $obj['id_tercero']['telefono1'] }} - {{ $obj['id_tercero']['telefono2'] }}</td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <div class="col-md-6" style="overflow-x:scroll;margin-left:2%">
        <p style="font-size:10pt;font-family:Poppins">Cuentas por cobrar</p>
        <table class="table table-sm  table-striped" id="facturas">
            <thead>
                <tr>
                    <th>Documento</th>
                    <th>Cliente</th>
                    <th>Fecha</th>
                    <th>Vencimiento</th>
                    <th>Saldo</th>
                </tr>
            </thead>
            <tbody>
                @if($facturas!=null)
                    @foreach($facturas as $obj)
                    <tr>
                        <td>{{ $obj['numero'] }} - {{ $obj['prefijo'] }}</td>
                        <td>{{ $obj['id_cliente'] }} </td>
                        <td>{{ $obj['fecha'] }}</td>
                        <td>{{ $obj['fecha_vencimiento'] }}</td>
                        <td>{{ $obj['saldo'] }}</td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
<div class="row"> 
    <div class="col-md-12" style="overflow-x:scroll;margin-top:2%">
        <p style="font-size:10pt;font-family:Poppins">Referencias de la empresa</p>
        <table class="table table-sm  table-striped" id="referencias">
        <thead>
            <tr>
                <th>Código</th>
                <th>descripcion</th>
                <th>Código Barras</th>
                <th>precio 1</th>
                <th>precio 2</th>
                <th>precio 3</th>
                <th>estado</th>
                <th>Ultimo costo</th>
                <th>costo promedio</th>
                <th>saldo</th>
            </tr>
        </thead>
        <tbody>
             @if($referencias!=null)
                @foreach($referencias as $obj)
                <tr>
                    <td>{{ $obj['codigo_linea'] }}{{ $obj['codigo_letras'] }}{{ $obj['codigo_consecutivo'] }}</td>
                    <td>{{ $obj['descripcion'] }}</td>
                    <td>{{ $obj['codigo_barras'] }}</td>
                    <td>{{ $obj['precio1'] }}</td>
                    <td>{{ $obj['precio2'] }}</td>
                    <td>{{ $obj['precio3'] }}</td>
                    <td>{{ $obj['estado'] }}</td>
                    <td>{{ $obj['costo'] }}</td>
                    <td>{{ $obj['saldo'] }}</td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </div>
</div>


<script>
$(document).ready( function () {
    zona = {!! json_encode($zona) !!};
    $('#datos').DataTable({});
    $('#facturas').DataTable({});
    $('#referencias').DataTable({});    
} );
</script>


@endsection()