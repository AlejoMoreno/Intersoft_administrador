@extends('layout')

@section('content')


<div class="container-fluid">
    <div class="row">

        <div class="col-md-12" id="tabla">
            <div class="card">
                <div class="header">
                    <div class="row">
                        <div class="col-md-10">
                            <h4 class="title">Referencias</h4>
                            <p class="category">Diferentes referencias</p>
                        </div>
                        <div class="col-md-2">
                            <div class="btn btn-success" style="background: white;" onclick="referencias.crear()">+ Nueva Referencia</div>
                        </div>
                    </div>
                </div>
                <div class="content">
                    
                    <div style="overflow-x:scroll;overflow-y:scroll;height:300px;">
                        <table class="table table-bordered table-striped" id="datos">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Código</th>
                                    <th>descripcion</th>
                                    <th>Código Barras</th>
                                    <th>Presentación</th>
                                    <th>Marca</th>
                                    <th>peso</th>
                                    <th>precio 1</th>
                                    <th>precio 2</th>
                                    <th>precio 3</th>
                                    <th>precio 4</th>
                                    <th>estado</th>
                                    <th>costo</th>
                                    <th>costo promedio</th>
                                    <th>saldo</th>
                                    <th></th> 
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($referencias as $obj)
                                    <tr id="row{{ $obj['id'] }}">
                                        <td>{{ $obj['id'] }}</td>
                                        <td>{{ $obj['codigo_linea'][0]['codigo_interno'].$obj['codigo_letras'].$obj['codigo_consecutivo'] }}</td>
                                        <td>{{ $obj['descripcion'] }}</td>
                                        <td><small style="font-size: 9px;">{{ $obj['codigo_barras'] }}</small></td>
                                        <td>{{ $obj['id_presentacion'][0]['nombre'] }}</td>
                                        <td>{{ $obj['id_marca'][0]['nombre'] }}</td>
                                        <td>{{ $obj['peso'] }}</td>
                                        <td>{{ number_format($obj['precio1'], 0, ",", ".") }}</td>
                                        <td>{{ number_format($obj['precio2'], 0, ",", ".") }}</td>
                                        <td>{{ number_format($obj['precio3'], 0, ",", ".") }}</td>
                                        <td>{{ number_format($obj['precio4'], 0, ",", ".") }}</td>
                                        <td>{{ $obj['estado'] }}</td>
                                        <td>{{ number_format($obj['costo'], 0, ",", ".") }}</td>
                                        <td>{{ number_format($obj['costo_promedio'], 0, ",", ".") }}</td>
                                        <td>{{ number_format($obj['saldo'], 0, ",", ".") }}</td>
                                        <td><a href="javascript:;" onclick="referencias.update('{{ $obj }}');"><button class="btn btn-warning">></button></a></td>
                                        <!--td><a onclick="referencias.delete_get('/inventario/referencias/delete/', '{{ $obj }}',  '/inventario/referencias');" href="#"><button class="btn btn-danger">x</button></a></td-->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
                            <a href="javascript:history.back(1)"> ir atras.</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12" id="crear">
            <div class="card">
                <div class="header">
                    <div class="row">
                        <div class="col-md-7">
                            <h4 class="title">Crear Referencias</h4>
                            <p class="category">Diferentes referencias</p>
                        </div>
                        <div class="col-md-5" >
                            <div class="card" style="box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);background: white;">
                                <div class="content">
                                    <div class="btn btn-success" onclick="referencias.initial()">Regresar</div>
                                    <div id="actualizar" onclick="config.send_post('#formulario', '/inventario/referencias/update', '/inventario/referencias');" class="btn btn-warning">Actualizar</div>
                                    <div class="btn btn-danger" onclick="config.printDiv('crear');">Imprimir Ficha</div>
                                    <div class="btn btn-default">Subir Imagen</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="content">
                    <form action='/inventario/referencias/create' method="POST" name="formulario" id="formulario">
                        <input type="hidden" name="id" id="id">
                        <div class="row">

                            <div class="col-md-4" >
                                <div class="card" style="box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);">
                                    <div class="header">
                                        <h6 class="title">Datos 1</h6>
                                    </div>
                                    <div class="content">
                                        
                                        <label>código linea</label>
                                        <select class="form-control" name="codigo_linea" id="codigo_linea" >
                                        @foreach ($lineas as $obj)
                                            <option value="{{ $obj['id'] }}">{{ $obj['id']}} {{ $obj['nombre']}}</option>
                                        @endforeach
                                        </select>

                                        <input type="hidden" class="form-control" name="codigo_letras" id="codigo_letras" placeholder="Escribe el codigo_letras" required="" maxlength="3" value="NAA" onkeyup="config.UperCase('codigo_letras');">

                                        <input type="hidden" class="form-control" name="codigo_consecutivo" id="codigo_consecutivo" placeholder="Escribe el codigo_consecutivo" maxlength="3" required="" value="1" onkeyup="config.UperCase('codigo_consecutivo');">

                                        <label>descripción</label><br>
                                        <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Escribe el descripcion" required="" onkeyup="config.UperCase('descripcion');">

                                        <label>código barras</label><br>
                                        <input type="text" class="form-control" name="codigo_barras" id="codigo_barras" placeholder="Escribe el codigo_barras" required="" onkeyup="config.UperCase('codigo_barras');">

                                        <div class="col-md-6">
                                            <label>código interno</label><br>
                                            <input type="text" class="form-control" name="codigo_interno" id="codigo_interno" placeholder="Escribe el codigo_interno" value="NA" onkeyup="config.UperCase('codigo_interno');">
                                        </div>
                                        <div class="col-md-6">
                                            <label>código alterno</label><br>
                                            <input type="text" class="form-control" name="codigo_alterno" id="codigo_alterno" placeholder="Escribe el codigo_alterno" value="NA" onkeyup="config.UperCase('codigo_alterno');">
                                        </div>

                                        <div class="col-md-6">
                                            <label>presentación</label><br>
                                            <select class="form-control" name="id_presentacion" id="id_presentacion"> 
                                            @foreach ($presentaciones as $obj)
                                                <option value="{{ $obj['id'] }}">{{ $obj['nombre']}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>peso</label><br>
                                            <input type="number" class="form-control" value="0" name="peso" id="peso" placeholder="Escribe el peso" required="" onkeyup="config.UperCase('peso');">
                                        </div>

                                        <label>Marca</label><br>
                                        <select class="form-control" name="id_marca" id="id_marca">
                                        @foreach ($marcas as $obj)
                                            <option value="{{ $obj['id'] }}">{{ $obj['nombre']}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4" >
                                <div class="card" style="box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);">
                                    <div class="header">
                                        <h6 class="title">Datos 2</h6>
                                    </div>
                                    <div class="content">
                                        <label>factor_rendimiento (%)</label><br>
                                        <input type="number" class="form-control" name="factor_rendimiento" id="factor_rendimiento" maxlength="2" placeholder="Escribe el factor_rendimiento" value="0" required="" onkeyup="config.UperCase('factor_rendimiento');">
                                        
                                        <div class="col-md-6">
                                            <label>stok mínimo</label><br>
                                            <input type="number"  class="form-control" name="stok_minimo" id="stok_minimo" value="0" placeholder="Escribe el stok_minimo" required="" onkeyup="config.UperCase('stok_minimo');">
                                        </div>
                                        <div class="col-md-6">
                                            <label>stok máximo</label><br>
                                            <input type="number" class="form-control" name="stok_maximo" id="stok_maximo" value="1" placeholder="Escribe el stok_maximo" required="" onkeyup="config.UperCase('stok_maximo');">
                                        </div>

                                        <div class="col-md-6">
                                            <label>iva (%)</label><br>
                                            <input type="number" value="0" maxlength="2" class="form-control" name="iva" id="iva" placeholder="Escribe el iva" required="" onkeyup="config.UperCase('iva');">
                                        </div>
                                        <div class="col-md-6">
                                            <label>impo consumo (%)</label><br>
                                            <input type="number" value="0" maxlength="2" class="form-control" name="impo_consumo" id="impo_consumo" placeholder="Escribe el impo_consumo" required="" onkeyup="config.UperCase('impo_consumo');">
                                        </div>

                                        <div class="col-md-6">
                                            <label>sobre tasa (%)</label><br>
                                            <input type="number" maxlength="2" value="0" class="form-control" name="sobre_tasa" id="sobre_tasa" placeholder="Escribe el sobre_tasa" required="" onkeyup="config.UperCase('sobre_tasa');">
                                        </div>
                                        <div class="col-md-6">
                                            <label>descuento (%)</label><br>
                                            <input type="number" maxlength="2" value="0" class="form-control" name="descuento" id="descuento" placeholder="Escribe el descuento" required="" onkeyup="config.UperCase('descuento');">
                                        </div>

                                        <label>serie</label><br>
                                        <input type="text" value="NA" class="form-control" name="serie" id="serie" placeholder="Escribe el serie" required="" onkeyup="config.UperCase('serie');">

                                        <label>clasificacion</label><br>
                                        <select class="form-control" name="id_clasificacion" id="id_clasificacion">
                                        @foreach ($clasificaciones as $obj)
                                            <option value="{{ $obj['id'] }}">{{ $obj['nombre']}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4" >
                                <div class="card" style="box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);">
                                    <div class="header">
                                        <h6 class="title">Datos 3</h6>
                                    </div>
                                    <div class="content">
                                        
                                        <div class="col-md-3">
                                            <label>precio1</label><br>
                                            <input type="number" class="form-control" value="0" name="precio1" id="precio1" placeholder="Escribe el precio1" required="" onkeyup="config.UperCase('precio1');">
                                        </div>
                                        <div class="col-md-3">
                                            <label>precio2</label><br>
                                            <input type="number" class="form-control" value="0" name="precio2" id="precio2" placeholder="Escribe el precio2" required="" onkeyup="config.UperCase('precio2');">
                                        </div>
                                        <div class="col-md-3">
                                            <label>precio3</label><br>
                                            <input type="number" class="form-control" value="0" name="precio3" id="precio3" placeholder="Escribe el precio3" required="" onkeyup="config.UperCase('precio3');">
                                        </div>
                                        <div class="col-md-3">
                                            <label>precio4</label><br>
                                            <input type="number" class="form-control" value="0" name="precio4" id="precio4" placeholder="Escribe el precio4" required="" onkeyup="config.UperCase('precio4');">
                                        </div>

                                        <label>estado</label><br>
                                        <select class="form-control" name="estado" id="estado">
                                            <option value="ACTIVO">ACTIVO</option>
                                            <option value="INACTIVO">INACTIVO</option>
                                            <option value="SUSPENDIDO">SUSPENDIDO</option>
                                        </select>

                                        <label>hommologo</label><br>
                                        <input type="text" class="form-control" name="hommologo" id="hommologo" placeholder="Escribe el hommologo" value="NA" required="" onkeyup="config.UperCase('hommologo');">

                                        <div class="col-md-4">
                                            <label>costo</label><br>
                                            <input type="number" class="form-control" value="0" name="costo" id="costo" placeholder="Escribe el costo" required="" onkeyup="config.UperCase('costo');" disabled="">
                                        </div>
                                        <div class="col-md-4">
                                            <label>costo promedio</label><br>
                                            <input type="number" class="form-control" value="0" name="costo_promedio" id="costo_promedio" placeholder="Escribe el costo_promedio" required="" onkeyup="config.UperCase('costo_promedio');" disabled="">
                                        </div>
                                        <div class="col-md-4">
                                            <label>saldo</label><br>
                                            <input type="number" class="form-control" value="0" name="saldo" id="saldo" placeholder="Escribe el saldo" required="" onkeyup="config.UperCase('saldo');" disabled="">
                                        </div>

                                        <label>usuario creador</label><br>
                                        <select class="form-control" name="usuario_creador" id="usuario_creador">
                                        @foreach ($usuarios as $obj)
                                            <option value="{{ $obj['id'] }}">{{ $obj['nombre']}}</option>
                                        @endforeach
                                        </select>

                                        <input  class="form-control" name="cuentaDB" id="cuentaDB" value="0" type="hidden">
                                        
                                        <input class="form-control" name="cuentaCR" id="cuentaCR" value="0" type="hidden"><br>

                                        <input type="submit" value="Guardar" id="btnguardar" class="btn btn-success">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>referencias.initial();</script>

<style>
a img{
    
}
</style>

@endsection()