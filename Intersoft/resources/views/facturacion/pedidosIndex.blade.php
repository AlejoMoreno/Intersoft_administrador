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
    <h4 class="title">Pedidos</h4>
</div>

<div class="row top-5-w">
    <form method="GET" class="row">
        <div class="col-md-2">
            <input type="text" name="nit" placeholder="Nit" value="{{ isset($_GET['nit'])?$_GET['nit']:'' }}" class="form-control">
        </div>
        <div class="col-md-4">
            <div class="col-md-12 row">
                <div class="col-md-8">
                    <input type="text" name="razonsocial" value="{{ isset($_GET['razonsocial'])?$_GET['razonsocial']:'' }}" placeholder="Razón social" class="form-control">
                </div>
                <div class="col-md-4">
                    <select class="form-control" name="vendedor" id="vendedor"> 
                        <option value="">Vendedor</option>
                        @foreach ($usuarios as $obj)
                        <option value="{{ $obj['id'] }}">{{ $obj['nombre'] }} {{ $obj['apellido'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 row">
            <div class="col-md-6">
                <input type="date" name="fechainicio" value="{{ isset($_GET['fechainicio'])?$_GET['fechainicio']:date('Y-m-d') }}" class="form-control">
            </div>
            <div class="col-md-6">
                <input type="date" name="fechafinal" value="{{ isset($_GET['fechafinal'])?$_GET['fechafinal']:date('Y-m-d') }}" class="form-control">
            </div>
        </div>
        <div class="col-md-2">
            <input type="submit" value="Consultar" class="btn btn-success">
        </div>
    </form><br><br>
    <p style="font-size:10pt;font-family:Poppins;margin-left:2%">Seleccione el pedido</p>
    <div class="col-md-11" style="overflow-x:scroll;margin-left:2%">
        <table class="table table-sm  table-striped" id="datos">
            <thead>
                <tr>
                    <th>Acción</th>
                    <th>Documento</th>
                    <th>Nit</th>
                    <th>Fecha</th>
                    <th>Subtotal</th>
                    <th>Total</th>
                    <th>Vendedor</th>
                </tr>
            </thead>
            <tbody>
                @if($pedidos!=null)
                    @foreach($pedidos as $obj)
                    <tr>
                        <td><a href="javascript:;" onclick="actualizardocumento('{{$obj}}')" style="color:red">Rechazar</a> <a href="/facturacion/pedidos/{{$obj['id_factura']}}">Pasar a Factura</a> </td>
                        <td>{{ $obj['documentos.nombre'] }} {{ $obj['prefijo'] }} {{ $obj['numero'] }}</td>
                        <td>{{ number_format($obj['nit'], 0, ",", ".") }} - {{ $obj['razon_social'] }}</td>
                        <td>{{ $obj['fecha'] }}</td>
                        <td>{{ number_format($obj['subtotal'], 0, ",", ".") }}</td>
                        <td>{{ number_format($obj['total'], 0, ",", ".") }}</td>
                        <td>{{ $obj['ncedula'] }} - {{ $obj['nombrevendedor'] }}</td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    
</div>




<script>
$(document).ready( function () {
    $('#datos').DataTable({});
} );


function actualizardocumento(id_documento){
    var data = JSON.parse(id_documento);
    console.log(data);
    var parametros = {
        "estado":"RECHAZADO",
        "id_documento":data.id_factura
    };
    $.ajax({
        data:  parametros,
        url:   '/facturacion/pedidosUpdate',
        type:  'post',
        success:  function (response) {
            console.log(response);
            swal({
                title: "Correcto",
                text: "El documento fue rechazado",
                icon: "success",
                button: "Aceptar",
            });
            config.Redirect('/facturacion/pedidos');
        }
    });
}

</script>


@endsection()