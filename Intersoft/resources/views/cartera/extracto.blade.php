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
    <h4 class="title">Extracto clientes / proveedores</h4>
</div>

<br><br>
<div class="row top-11-w">
    
    <div class="panel panel-primary " style="margin-left:5%;margin-right:5%;">
        <!-- Default panel contents -->
        <div class="panel-heading">Extracto clientes</div>
        <div class="panel-body" >
            <p style="font-size: 10pt;">A continuación se describe el extracto de los clientes, en el cual se detalla
                el saldo diferente de 0 (cero) de cada uno de las facturas emitidas con corte
                al presente día. <br> <strong style="font-size: 20pt;">TOTAL : $ <span style="font-size: 20pt;" id="total_cliente"></span></strong>
            </p>
        </div>

        <!-- Table -->
        <div style="overflow-x:scroll;">
            <table class="table table-hover" id="tabla_cliente">
                <thead>
                    <tr>
                        <th>NIT</th>
                        <th>RAZÓN SOCIAL</th>
                        <th>TELÉFONO</th>
                        <th>ZONA VENTA</th>
                        <th>FECHA FACTURA</th>
                        <th>FECHA VENCIMIENTO</th>
                        <th>NUMERO</th>
                        <th>PREFIJO</th>
                        <th>VENDEDOR</th>
                        <th>SALDO</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carteracliente as $obj)
                    <tr>
                        <td>{{ number_format($obj->nit, 0, ",", ".") }}</td>
                        <td>{{ $obj->razon_social }}</td>
                        <td>{{ $obj->telefono }}</td>
                        <td>{{ $obj->zona_venta }}</td>
                        <td>{{ $obj->fecha }}</td>
                        <td>{{ $obj->fecha_vencimiento }}</td>
                        <td>{{ $obj->numero }}</td>
                        <td>{{ $obj->prefijo }}</td>
                        <td>{{ number_format($obj->ncedula, 0, ",", ".") }}</td>
                        <td>{{ $obj->saldo }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <div class="panel panel-warning " style="margin-left:5%;margin-right:5%;">
        <!-- Default panel contents -->
        <div class="panel-heading">Extracto proveedores</div>
        <div class="panel-body" >
            <p style="font-size: 10pt;">A continuación se describe el extracto de los proveedores, en el cual se detalla
                el saldo diferente de 0 (cero) de cada uno de las facturas emitidas con corte
                al presente día. <br> <strong style="font-size: 20pt;">TOTAL : $ <span style="font-size: 20pt;" id="total_proveedor"></span></strong>
            </p>
        </div>

        <!-- Table -->
        <div style="overflow-x:scroll;">
            <table class="table table-hover" id="tabla_proveedor">
                <thead>
                    <tr>
                        <th>NIT</th>
                        <th>RAZÓN SOCIAL</th>
                        <th>TELÉFONO</th>
                        <th>ZONA VENTA</th>
                        <th>FECHA COMPRA</th>
                        <th>FECHA VENCIMIENTO</th>
                        <th>NUMERO</th>
                        <th>PREFIJO</th>
                        <th>SALDO</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carteraproveedor as $obj)
                    <tr>
                        <td>{{ number_format($obj->nit, 0, ",", ".") }}</td>
                        <td>{{ $obj->razon_social }}</td>
                        <td>{{ $obj->telefono }}</td>
                        <td>{{ $obj->zona_venta }}</td>
                        <td>{{ $obj->fecha }}</td>
                        <td>{{ $obj->fecha_vencimiento }}</td>
                        <td>{{ $obj->numero }}</td>
                        <td>{{ $obj->prefijo }}</td>
                        <td>{{ $obj->saldo }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>





<script>
$(document).ready(function() {
    var table = $('#tabla_cliente').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
    var table2 = $('#tabla_proveedor').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );

    totalclientes(table);
    totalproveedor(table2);

    $('input[aria-controls=tabla_cliente]').keypress(function(){
        totalclientes(table);
    });
    
    $('input[aria-controls=tabla_proveedor]').keypress(function(){
        totalproveedor(table2);
    });

} );


function totalclientes(table){
    var total = 0;
    var data = table.rows().data();
    data.each(function (value, index){
        total = total + parseInt(value[9]);
    });
    $('#total_cliente').text(total);
}

function totalproveedor(table){
    var total = 0;
    var data = table.rows().data();
    data.each(function (value, index){
        total = total + value[9];
    });
    $('#total_proveedor').text(total);
}

</script>


@endsection()