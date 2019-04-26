@extends('layout')

@section('content')

<?php 

$referencias = App\Referencias::all();

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
                                    <th></th>
                                    <th></th> 
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lotes as $obj)
                                    <tr id="row{{ $obj['id'] }}">
                                        <th>{{ $obj['id'] }}</th> 
                                        <th>{{ $obj['id_referencia'] }}</th>
                                        <th>{{ $obj['numero_lote'] }}</th> 
                                        <th>{{ $obj['fecha_vence_lote'] }}</th>
                                        <th>{{ $obj['ubicacion'] }}</th>
                                        <th>{{ $obj['serie'] }}</th>
                                        <th>{{ $obj['cantidad'] }}</th>
                                        <td><a href="javascript:;" onclick="lotes.update('{{ $obj }}');"><button class="btn btn-warning">></button></a></td>
                                        <td><a onclick="config.delete_get('/inventario/lotes/delete/', '{{ $obj }}',  '/inventario/lotes');" href="#"><button class="btn btn-danger">x</button></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <h4>Crear lotes clases</h4>
                    
                                <form action='/inventario/lotes/create' method="POST" name="formulario" id="formulario">
                                    <input type="hidden" name="id" id="id">
                                    <input type="text" name="id_referencia" list="id_referencia" class="form-control" placeholder="Codigo Producto">
                                    <datalist id="id_referencia">
                                        @foreach ($referencias as $obj)
                                        <option value="{{ $obj['id'] }}">{{ $obj['codigo_barras'] }} | {{ $obj['descripcion '] }}</option>
                                        @endforeach
                                    </datalist>
                                    <input type="text" class="form-control" name="numero_lote" id="numero_lote" placeholder="Numero Lote">
                                    <input type="date" class="form-control" name="fecha_vence_lote" id="fecha_vence_lote" placeholder="Fecha de vencimiento">
                                    <input type="text" class="form-control" name="ubicacion" id="ubicacion" placeholder="Ubicación">
                                    <input type="text" class="form-control" name="serie" id="serie" placeholder="serie">
                                    <input type="number" class="form-control" name="cantidad" id="cantidad" placeholder="cantidad"><br><br>

                                <input type="submit" value="Guardar" id="btnguardar" class="btn btn-success form-control">
                                <div id="actualizar" onclick="config.send_post('#formulario', '/inventario/lotes/update', '/inventario/lotes');" class="btn btn-warning form-control">Actualizar</div>
                                </form>
                            </tr>
                        </tbody>
                    </table>
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

<style>
a img{
    margin:20px;
}
</style>

<script type="text/javascript">
    lotes.initial();
</script>

@endsection()