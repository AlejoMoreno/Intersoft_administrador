@extends('layout')

@section('content')

<div class="enc-article">
    <h4 class="title">Vista de lotes</h4>
</div>

<div class="row top-5-w">
<p style="font-size:10pt;font-family:Poppins;margin-left:2%">Observa los lotes con su ubicación y fecha de vencimiento por cada uno de los productos que se 
    encuentran en el sistema.</p>
    <div class="col-md-11" style="margin-left:2%">
        <table class="table table-hover table-striped" id="datos">
            <thead>
                <tr>
                    <th>ID</th> 
                    <th>Producto</th>
                    <th>Número Lote</th> 
                    <th>Fecha vencimiento</th>
                    <th>Ubicación</th>
                    <th>Serie</th>
                    <th>Cantidad</th>
                    <th>Sucursal</th>
                    <th></th> 
                </tr>
            </thead>
            <tbody>
                @foreach ($lotes as $obj)
                    <tr id="row{{ $obj['id'] }}">
                        <td>{{ $obj['id'] }}</td> 
                        <td>{{ $obj['id_referencia']['descripcion'] }}</td>
                        <td>{{ $obj['numero_lote'] }}</td> 
                        <td>{{ $obj['fecha_vence_lote'] }}</td>
                        <td>{{ $obj['ubicacion'] }}</td>
                        <td>{{ $obj['serie'] }}</td>
                        <td>{{ $obj['cantidad'] }}</td>
                        <td>{{ $obj['id_sucursal']['nombre'] }}</td>
                        <td></td>
                        <!--td><a href="javascript:;" onclick="lotes.update('{{ $obj }}');"><button class="btn btn-warning">></button></a></td--!>
                        <!--td><a onclick="config.delete_get('/inventario/lotes/delete/', '{{ $obj }}',  '/inventario/lotes');" href="#"><button class="btn btn-danger">x</button></a></td-->
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <h2 style="margin: 2%;padding-top:2%;">Total cantidades: <?php echo $number ?></h2>
    
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
</script>



<script type="text/javascript">
    lotes.initial();
</script>

@endsection()