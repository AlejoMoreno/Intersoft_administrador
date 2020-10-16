@extends('layout')

@section('content')



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
    <h4 class="title">Devoluciones</h4>
</div>

<div class="row top-11-w">
    <p style="font-size:10pt;font-family:Poppins;margin-left:2%">Seleccione la factura</p>
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
                @if($facturas!=null)
                    @foreach($facturas as $obj)
                    <tr>
                        <td><a href="/facturacion/devoluciones/{{$obj['id']}}" style="color:red">Devolver</a> <a href="javascript:;" onclick="actualizardocumento({{$obj['id']}})">Aceptar</a></td>
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
    $('#datos').DataTable({ 
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ] 
    });
} );


function actualizardocumento(id_documento){
    var parametros = {
        "estado":"FACTURADO",
        "id_documento":id_documento
    };
    $.ajax({
        data:  parametros,
        url:   '/facturacion/pedidosUpdate',
        type:  'post',
        success:  function (response) {
            console.log(response);
            config.Redirect('/facturacion/devoluciones');
        }
    });
}

</script>


@endsection()