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

<div class="row top-11-w">
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
                        <td><a href="/documentos/documento?pasarafactura=<?php echo $obj['id']; ?>">Verificar</a>
                            <a href="javascript:;" onclick="actualizardocumento(<?php echo $obj['id']; ?>)" style="color:red;" >Rechazar</a></td>
                        <td>{{ $obj['id_documento']['nombre'] }} {{ $obj['prefijo'] }} {{ $obj['numero'] }}</td>
                        <td>{{ number_format($obj['id_cliente']['nit'], 0, ",", ".") }} - {{ $obj['id_cliente']['razon_social'] }}</td>
                        <td>{{ $obj['fecha'] }}</td>
                        <td>{{ number_format($obj['subtotal'], 0, ",", ".") }}</td>
                        <td>{{ number_format($obj['total'], 0, ",", ".") }}</td>
                        <td>{{ $obj['id_vendedor']['ncedula'] }} - {{ $obj['id_vendedor']['nombre'] }}</td>
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
        var parametros = {
            "estado":"RECHAZADO",
            "id_documento":id_documento
        };
        $.ajax({
            data:  parametros,
            url:   '/facturacion/pedidosUpdate',
            type:  'post',
           success:  function (response) {
                console.log(response);
                config.Redirect('/facturacion/pedidos');
            }
        });
    }

</script>


@endsection()