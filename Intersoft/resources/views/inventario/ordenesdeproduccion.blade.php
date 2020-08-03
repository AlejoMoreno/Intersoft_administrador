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
    <h4 class="title">Ordenes de producción</h4>
</div>

<div class="row top-11-w" style="padding:2%;">

    <div class="panel panel-default col-md-5" >
        <!-- Default panel contents -->
        <div class="panel-heading row"><h5>Vista de ordenes de producción</h5></div>
        <div class="panel-body" >
            <p style="font-size: 10pt;">A contiuación se describe la lista de ordenes.
            </p>
            <div style="overflow-x: scroll">
                <table class="table" id="tabla"> 
                    <thead>
                        <th>ficha tecnica</th>
                        <th>sucursal</th>
                        <th>cliente</th>
                        <th>turno</th>
                        <th>orden_produccion</th>
                        <th>fecha</th>
                        <th>operario</th>
                        <th>id_referencia</th>
                        <th>lote</th>
                        <th>etapa</th>
                        <th>unidades</th>
                        <th>Eliminar</th>
                    </thead>
                    <tbody>
                        <?php  
                        if($produccioningresos[0]['id']!=null){
                        ?>
                            @foreach($produccioningresos as $obj)
                            <tr>
                                <td>{{ $obj['id_ficha_tecnica']['nombre'] }}</td>
                                <td>{{ $obj['id_sucursal']['nombre'] }}</td>
                                <td>{{ $obj['id_cliente']['razon_social'] }}</td>
                                <td>Turno#{{ $obj['id_turno'] }}</td>
                                <td>Orden#{{ $obj['orden_produccion'] }}</td>
                                <td>{{ $obj['fecha'] }}</td>
                                <td>{{ $obj['operario']['ncedula'] }}</td>
                                <td>{{ $obj['id_referencia']['codigo_linea'] }}{{ $obj['id_referencia']['codigo_letras'] }}{{ $obj['id_referencia']['codigo_consecutivo'] }}</td>
                                <td>{{ $obj['lote'] }}</td>
                                <td>Etapa#{{ $obj['etapa'] }}</td>
                                <td>{{ $obj['unidades'] }}</td>
                                <td>
                                    <form action="/inventario/ordenesdeproduccion" method="POST">
                                    <input type="hidden" name="id" id="id" value="{{ $obj['id'] }}">
                                    <input type="submit" class="btn btn-danger" name="eliminar" onclick="ordenes.eliminate({{$obj}})" value="x">
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        <?php
                        }
                        ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-7 row">
        <div class="panel panel-warning col-md-12" >
            <!-- Default panel contents -->
            <form action="/inventario/ordenesdeproduccion" method="POST">
                <div class="panel-heading row" >
                    <h5 class="col-md-8">Crear Ordenes de Producción # {{ $produccioningresos[0]['orden_produccion'] + 1 }}</h5>
                    <div class="col-md-4 row">
                        <input type="submit" id="btnguardar" class="btn btn-success col-md-3 btn-guardar" name="Guardar" value="Guardar">
                        <div class="col-md-3"><a href="/inventario/ordenesdeproduccion" class="btn btn-danger" style="background:white;"><i class="fas fa-plus-circle"></i> </a></div>
                    </div>           
                </div>
                <div class="panel-body" >
                    <p style="font-size: 10pt;">Diligencie cada uno de los datos relacionados con la orden de producción.
                    </p>
                    
                    <div class="content row">
                        <p class="col-md-12">Encabezado </p><hr>
                        <div class="col-md-4"><label>Fecha vencimiento</label><input type="date" class="form-control" name="fecha" id="fecha" value="{{ $produccioningresos[0]['fecha'] }}"></div>
                        <div class="col-md-4">
                            <label>Sucursal</label>
                            <select name="id_sucursal" class="form-control" id="id_sucursal">
                                <option value="">Seleccionar sucursal</option>
                                @foreach($sucursal as $obj)
                                <option value="{{ $obj->id }}" >{{ $obj->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" class="form-control" value="{{ Session::get('id_empresa') }}" name="id_empresa" id="id_empresa">
                        <input type="hidden" class="form-control" placeholder="orden de producción" name="orden_produccion" id="orden_produccion"  value="0">
                        <div class="col-md-4">
                            <label>Jefe producción</label>
                            <select name="operario" class="form-control" id="operario">
                                <option value="">Seleccionar jefe producción</option>
                                @foreach($operario as $obj)
                                <option value="{{ $obj->id }}" >{{ $obj->ncedula }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="content row">
                        <p class="col-md-12"><br>Seleccione los productos</p>
                        <hr>
                        <div class="col-md-6">
                            <label>Ficha técnica</label>
                            <select name="id_ficha_tecnica" class="form-control" id="id_ficha_tecnica">
                                <option value="">Seleccionar ficha tecnica</option>
                                @foreach($ficha_tecnica as $obj)
                                <option value="{{ $obj->nombre }}" >{{ $obj->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Turno inicial</label>
                            <select name="id_turno" class="form-control" id="id_turno">
                                <option value="">Seleccionar turno</option>
                                <option value="1">Turno 1</option>
                                <option value="2">Turno 2</option>
                                <option value="3">Turno 3</option>
                                <option value="4">Turno 4</option>
                                <option value="5">Turno 5</option>
                                <option value="6">Turno 6</option>
                                <option value="7">Turno 7</option>
                                <option value="8">Turno 8</option>
                                <option value="9">Turno 9</option>
                                <option value="10">Turno 10</option>
                                <option value="11">Turno 11</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Etapa</label>
                            <select name="etapa" class="form-control" id="etapa">
                                <option value="">Seleccionar etapa</option>
                                <option value="1">Inicial</option>
                                <option value="2">Etapa 2</option>
                                <option value="3">Etapa 3</option>
                                <option value="4">Etapa 4</option>
                                <option value="5">Etapa 5</option>
                                <option value="6">Etapa 6</option>
                                <option value="7">Etapa 7</option>
                                <option value="8">Etapa 8</option>
                                <option value="9">Etapa 9</option>
                                <option value="10">Etapa 10</option>
                                <option value="11">Final</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Referencia a crear</label>
                            <select name="id_referencia" class="form-control" id="id_referencia">
                                <option value="">Seleccionar referencia</option>
                                @foreach($referencia as $obj)
                                <option value="{{ $obj->id }}" >{{ $obj->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6"><label>Lote</label><input type="text" class="form-control" placeholder="Lote" name="lote" id="lote"></div>
                        <div class="col-md-6">
                            <label>Cliente en especifico</label>
                            <select name="id_cliente" class="form-control" id="id_cliente">
                                <option value="">Seleccionar cliente</option>
                                @foreach( $clientes as $cliente)
                                <option value="{{ $cliente->id }}">{{ $cliente->nit }} / {{ $cliente->razon_social }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6"><label>Unidades a crear</label><input type="number" placeholder="cantidad" class="form-control" name="unidades" id="unidades"></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


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