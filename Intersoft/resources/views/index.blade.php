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
        <p style="font-size:10pt;font-family:Poppins">Rutas asignadas Día ({{ $day }})</p>
        <table class="table table-sm  table-striped" id="datos">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Zona</th>
                    <th>Nit</th>
                    <th>Razon social</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                </tr>
            </thead>
            <tbody>
                @if($zona!=null)
                    @foreach($zona as $obj)
                    <tr>
                        <td>{{ $obj['ncedula'] }}-{{ $obj['nombre'] }}</td>
                        <td>{{ $obj['zona'] }}</td>
                        <td><a href="/facturacion/venta/37?nit={{ $obj['nit'] }}">{{ $obj['nit'] }}</a></td>
                        <td>{{ $obj['razon_social'] }}</td>
                        <td>{{ $obj['direccion'] }}</td>
                        <td>{{ $obj['telefono'] }}</td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <div class="col-md-6" style="overflow-x:scroll;margin-left:2%">
        <p style="font-size:10pt;font-family:Poppins">Facturas realizadas</p>
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
        </table>
    </div>
</div>

<div class="row"> 
    <div class="col-md-12" style="overflow-x:scroll;margin-top:2%">
        <p style="font-size:10pt;font-family:Poppins">Referencias a punto de vencer (corte: <small><?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 2 month")); ?></small>)</p>
        <table class="table table-sm  table-striped" id="lotes">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>descripcion</th>
                    <th>Fecha vencimiento</th>
                    <th>Lote</th>
                    <th>Sucursal</th>
                </tr>
            </thead>
            <tbody>
                @if($lotes!=null)
                    @foreach($lotes as $obj)
                    <tr>
                        <td>{{ $obj['codigo_linea'] }}{{ $obj['codigo_letras'] }}{{ $obj['codigo_consecutivo'] }}</td>
                        <td>{{ $obj['descripcion'] }}</td>
                        <td>{{ $obj['fecha_vence_lote'] }}</td>
                        <td>{{ $obj['numero_lote'] }}</td>
                        <td>{{ $obj['nombre'] }}</td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>




<script>
$(document).ready( function () {
    zona = {!! json_encode($zona) !!};
    $('#datos').DataTable({ 
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ] });
    $('#facturas').DataTable({ 
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ] });
    $('#lotes').DataTable({ 
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ] });
    $('#referencias').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        'rowCallback': function(row, data, index){
            if(data[8] <= 0){
                $(row).find('td:eq(8)').css('color', 'red');
                $(row).find('td:eq(8)').attr('data-toggle', 'tooltip');
                $(row).find('td:eq(8)').attr('title', 'No cuenta con saldo');
            }
            if(data[3] >= data[7] || data[4] >= data[7] || data[5] >= data[7] ){
                $(row).find('td:eq(7)').css('color', 'red');
                $(row).find('td:eq(8)').attr('data-toggle', 'tooltip');
                $(row).find('td:eq(8)').attr('title', 'El costo es mayor o igual al precio');
            }
        }
    });    
} );
</script>


@endsection()