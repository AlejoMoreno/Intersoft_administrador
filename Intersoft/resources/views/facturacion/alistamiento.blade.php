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
.red{
    background: #ff4a55;
    color: white;
}
</style>

<div class="enc-article">
    <h4 class="title">Alistamiento de mercancia</h4>
</div>

<div class="row top-5-w">
<p style="font-size:10pt;font-family:Poppins;margin-left:2%">Aliste sus productos de forma rápida y efectíva para el <label>DIA: </label></p>
    <div style="margin-left: 49%;width: 40%;">
        <form method="get" action="" class="row">
            <div class="col-md-5 ">
                <input type="date" class="form-control" value="{{ (isset($_GET['date']))? $_GET['date'] : date('Y-m-d') }}" name="date" id="date">
            </div>
            <div class="col-md-2 ">
                <input type="submit" value="Consultar" class="btn btn-success">
            </div>
            <div class="col-md-5 ">
                <br>
            </div>
        </form>
    </div>
    <div class="col-md-11" style="overflow-x:scroll;margin-left:2%">
        <table class="table table-sm  table-striped" id="datos1">
            <thead>
                <tr>
                    <th>Referencia</th>
                    <th>Descripción</th>
                    <th>Unidades para alistar</th>
                    <th>Saldo en bodega</th>
                </tr>
            </thead>
            <tbody>
                @if($kardex1!=null)
                    @foreach($kardex1 as $obj)
                    <?php $color = (($obj['total'] - $obj['id_referencia']['saldo'] ) > 0)? "red":""; ?>
                    <tr>
                        <td>{{ $obj['id_referencia']['codigo_interno'] }}</td>
                        <td>{{ $obj['id_referencia']['descripcion'] }}</td>
                        <td>{{ $obj['total'] }}</td>
                        <td class="{{ $color }}">{{ $obj['id_referencia']['saldo']  }}</td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        <br>
        <hr>
        <br>
        <p style="font-size:10pt;font-family:Poppins;margin-left:2%">En esta sección usted podrá ver los pedidos creados el día {{ (isset($_GET['date']))? $_GET['date'] : date('Y-m-d') }}, con el fin
            de poderlos alistar. Se detalla tambien el número de documento para poder reimprimir el pedido.</p>
        <table class="table table-sm  table-striped" id="datos">
            <thead>
                <tr>
                    <th>Referencia</th>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                    <th>Documento</th>
                    <th>Cliente</th>
                    <th>Dirección</th>
                    <th>Vendedor</th>
                </tr>
            </thead>
            <tbody>
                @if($kardex!=null)
                    @foreach($kardex as $obj)
                    <tr>
                        <td>{{ $obj['id_referencia']['codigo_interno'] }}</td>
                        <td>{{ $obj['id_referencia']['descripcion'] }}</td>
                        <td style="background:#aaa;text-align:center;">{{ $obj['cantidad'] }}</td>
                        <td><a href="javascript:envioUrl('/documentos/imprimir/{{ $obj['id_factura']['id'] }}')" > {{ $obj['id_factura']['prefijo'] }} # {{ $obj['id_factura']['numero'] }} </a></td>
                        <td>{{ $obj['nit'] }} {{ $obj['razon_social'] }}</td>
                        <td>{{ $obj['direccion'] }} Tel.{{ $obj['telefono'] }}</td>
                        <td>{{ $obj['ncedula'] }} {{ $obj['nombre'] }}</td>
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
    $('#datos1').DataTable({
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
<script language=javascript>
    function envioUrl (url){
    window.open(url, "imprimir documento", "width=800, height=700")
    }
    </script>

@endsection()

