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
    <h4 class="title">Liquidación de comisión</h4>
</div>

<div class="row top-11-w" style="padding:2%;">

    <div class="panel panel-default col-md-5" >
        <!-- Default panel contents -->
        <div class="panel-heading row"><h5>Filtros de búsqueda</h5></div>
        <div class="panel-body" >
            <p style="font-size: 10pt;">
                Utilice los filtros de búsqueda necesarios para realizar la liquidación.
            </p>
            <div class="row">
                <div class="col-md-6">
                    <input type="number" id="valor" value="{{ $valor }}" name="valor" placeholder="porcentaje (%) comisión" class="form-control"><br>
                </div>   
                <div class="col-md-6">
                    <select id="estado" class="form-control">
                        <option value="FACTURADO">FACTURADO</option>
                        <option value="ACTIVO">ACTIVO</option>
                        <option value="DEVUELTO">DEVUELTO</option>
                    </select>
                </div>
                <br>  
                <hr>
                <p>Seleccione el vendedor: </p>
                <br>
                @foreach($usuarios as $obj)
                <div class="col-md-12" style="margin:2%;">
                    <div class="btn-success" style="padding:3%;color:white;" onclick="verUsuarioVentas({{ $obj['id'] }})">
                        {{ $obj['ncedula'] }} / {{ $obj['correo'] }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-md-7 row">
        <div class="panel panel-warning col-md-12" >
            <!-- Default panel contents -->
            <div class="panel-heading row" >
                <h5 class="col-md-4">Resultado de Facturas</h5>
            </div>
            <div class="panel-body" style="overflow-x:scroll;">
                <p style="font-size: 10pt;">
                    Resultado de la busqueda
                </p>
                <?php  $total = 0; ?>
                <table class="table table-hover table-striped"  id="tabla">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Tercero</th>
                        <th>Fecha ___Emisión___</th>
                        <th>Fecha Vencimiento</th>
                        <th>subtotal</th>
                        <th>iva</th>
                        <th>impoconsumo</th>
                        <th>impuesto 1</th>
                        <th>impuesto 2</th>
                        <th>descuento</th>
                        <th>fletes</th>
                        <th>retefuente</th>
                        <th>total</th>
                        <th>Saldo Cartera</th>
                        <th>Estado</th>
                        <th>Fecha creado</th>
                        <th>Fecha Actualizado</th>
                    </tr></thead>
                    <tbody>
                    
                        @if($facturas!=null)
                            @foreach($facturas as $obj)
                            <?php $total = $total + ( ($obj['subtotal']*$valor)/100 );  ?>
                            <tr>
                                <td><a href="javascript:envioUrl('/documentos/imprimir/{{ $obj['id'] }}')" class="btn btn-success">{{ $obj['numero'] }}</a></td>
                                <td>{{ $obj['id_tercero'] }}</td>
                                <td>{{ $obj['fecha'] }}</td>
                                <td>{{ $obj['fecha_vencimiento'] }}</td>
                                <td>{{ number_format($obj['subtotal']) }}</td>
                                <td>{{ number_format($obj['iva']) }}</td>
                                <td>{{ number_format($obj['impoconsumo']) }}</td>
                                <td>{{ number_format($obj['otro_impuesto']) }}</td>
                                <td>{{ number_format($obj['otro_impuesto_1']) }}</td>
                                <td>{{ number_format($obj['descuento']) }}</td>
                                <td>{{ number_format($obj['fletes']) }}</td>
                                <td>{{ number_format($obj['retefuente']) }}</td>
                                <td>{{ number_format($obj['total']) }}</td>
                                <td>{{ number_format($obj['saldo']) }}</td>
                                <td>{{ $obj['estado'] }}</td>
                                <td>{{ $obj['created_at'] }}</td>
                                <td>{{ $obj['updated_at'] }}</td>
                            </tr>
                            @endforeach         
                        @endif                       
                    </tbody>
                </table>
            </div>
            @if($total!=0)
                <h2>Calculo total de comisión con valor {{ $valor }}(%) es: {{ $total }} </h2>
            @endif
        </div>
    </div>

</div>




<script>
function verUsuarioVentas(id){
    valor = $('#valor').val();
    estado = $('#estado').val();
    config.Redirect('/facturacion/liquidacionventas/'+id+'/'+valor+'?estado='+estado);
}
function envioUrl(url){
    window.open(url, "imprimir documento", "width=800, height=700")
}


</script>

<script>
    $(document).ready(function() {
        var table = $('#tabla').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        } );
    });
    </script>

@endsection()

