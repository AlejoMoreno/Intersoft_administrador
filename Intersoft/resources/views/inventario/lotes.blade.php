@extends('layout')

@section('content')

<?php 


?>

<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Lotes</h4>
                    <p class="category">Diferentes Lotes</p><br>
                </div>
                <div class="content">
                    <div style="overflow-x:scroll;overflow-y:scroll;height:500px;">
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
                                        <!--td><a href="javascript:;" onclick="lotes.update('{{ $obj }}');"><button class="btn btn-warning">></button></a></td--!>
                                        <!--td><a onclick="config.delete_get('/inventario/lotes/delete/', '{{ $obj }}',  '/inventario/lotes');" href="#"><button class="btn btn-danger">x</button></a></td-->
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th> 
                                    <th></th>
                                    <th></th> 
                                    <th></th>
                                    <th></th>
                                    <th>Total</th>
                                    <th><?php echo $number ?></th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                        {{ $lotes->links() }}
                    </div>

                    

                    <div id="resultado"></div>
                    <div class="footer">
                        <div class="legend">
                            <i class="fa fa-circle text-info"></i> 
                            <i class="fa fa-circle text-danger"></i> 
                            <i class="fa fa-circle text-warning"></i>
                        </div>
                        <hr>
                        <div class="stats">
                            <i class="pe-7s-angle-left-circle"></i> <a href="#" onclick="config.Redirect('/inventario/index');"> ir atras.</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    lotes.initial();
</script>

@endsection()