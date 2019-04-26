@extends('layout')

@section('content')


<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Referencias</h4>
                    <p class="category">Diferentes referencias</p><br>
                </div>
                <div class="content">
                    <div style="overflow-x:scroll;overflow-y:scroll;height:300px;">
                        <table class="table table-hover table-striped" id="datos">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>codigo_linea</th>
                                    <th>codigo_letras</th>
                                    <th>codigo_consecutivo</th>
                                    <th>descripcion</th>
                                    <th>codigo_barras</th>
                                    <th>codigo_interno</th>
                                    <th>codigo_alterno</th>
                                    <th>id_presentacion</th>
                                    <th>id_marca</th>
                                    <th>factor_rendimiento</th>
                                    <th>stok_minimo</th>
                                    <th>stok_maximo</th>
                                    <th>iva</th>
                                    <th>impo_consumo</th>
                                    <th>sobre_tasa</th>
                                    <th>serie</th>
                                    <th>descuento</th>
                                    <th>id_clasificacion</th>
                                    <th>peso</th>
                                    <th>precio1</th>
                                    <th>precio2</th>
                                    <th>precio3</th>
                                    <th>precio4</th>
                                    <th>estado</th>
                                    <th>hommologo</th>
                                    <th>costo</th>
                                    <th>costo_promedio</th>
                                    <th>saldo</th>
                                    <th>usuario_creador</th>
                                    <th></th> 
                                    <th></th> 
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($referencias as $obj)
                                    <tr id="row{{ $obj['id'] }}">
                                        <td>{{ $obj['id'] }}</td>
                                        <td>{{ $obj['codigo_linea'][0]['codigo_interno'] }}</td>
                                        <td>{{ $obj['codigo_letras'] }}</td>
                                        <td>{{ $obj['codigo_consecutivo'] }}</td>
                                        <td>{{ $obj['descripcion'] }}</td>
                                        <td>{{ $obj['codigo_barras'] }}</td>
                                        <td>{{ $obj['codigo_interno'] }}</td>
                                        <td>{{ $obj['codigo_alterno'] }}</td>
                                        <td>{{ $obj['id_presentacion'][0]['nombre'] }}</td>
                                        <td>{{ $obj['id_marca'][0]['nombre'] }}</td>
                                        <td>{{ $obj['factor_rendimiento'] }}</td>
                                        <td>{{ $obj['stok_minimo'] }}</td>
                                        <td>{{ $obj['stok_maximo'] }}</td>
                                        <td>{{ $obj['iva'] }}</td>
                                        <td>{{ $obj['impo_consumo'] }}</td>
                                        <td>{{ $obj['sobre_tasa'] }}</td>
                                        <td>{{ $obj['serie'] }}</td>
                                        <td>{{ $obj['descuento'] }}</td>
                                        <td>{{ $obj['id_clasificacion'][0]['nombre'] }}</td>
                                        <td>{{ $obj['peso'] }}</td>
                                        <td>{{ $obj['precio1'] }}</td>
                                        <td>{{ $obj['precio2'] }}</td>
                                        <td>{{ $obj['precio3'] }}</td>
                                        <td>{{ $obj['precio4'] }}</td>
                                        <td>{{ $obj['estado'] }}</td>
                                        <td>{{ $obj['hommologo'] }}</td>
                                        <td>{{ $obj['costo'] }}</td>
                                        <td>{{ $obj['costo_promedio'] }}</td>
                                        <td>{{ $obj['saldo'] }}</td>
                                        <td>{{ $obj['usuario_creador'][0]['nombre'] }}</td>
                                        <td><a href="javascript:;" onclick="referencias.update('{{ $obj }}');"><button class="btn btn-warning">></button></a></td>
                                        <td><a onclick="config.delete_get('/inventario/referencias/delete/', '{{ $obj }}',  '/inventario/referencias');" href="#"><button class="btn btn-danger">x</button></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <h4>Crear Referencias</h4>
                    
                        <form action='/inventario/referencias/create' method="POST" name="formulario" id="formulario">
                            <input type="hidden" name="id" id="id">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>codigo_linea</label><br>
                                    <select class="form-control" name="codigo_linea" id="codigo_linea">
                                        <option value="">SELECCIONE LINEA</option>
                                    @foreach ($lineas as $obj)
                                        <option value="{{ $obj['id'] }}">{{ $obj['id']}} {{ $obj['nombre']}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label>codigo_letras</label><br>
                                    <input type="text" class="form-control" name="codigo_letras" id="codigo_letras" placeholder="Escribe el codigo_letras" required="" maxlength="3" onkeyup="config.UperCase('codigo_letras');">
                                </div>
                                <div class="col-md-2">
                                    <label>codigo_consecutivo</label><br>
                                    <input type="number" class="form-control" name="codigo_consecutivo" id="codigo_consecutivo" placeholder="Escribe el codigo_consecutivo" maxlength="3" required="" onkeyup="config.UperCase('codigo_consecutivo');">
                                </div>
                                <div class="col-md-5">
                                    <label>descripcion</label><br>
                                    <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Escribe el descripcion" required="" onkeyup="config.UperCase('descripcion');">
                                </div>
                                <div class="col-md-12">
                                    <label>codigo_barras</label><br>
                                    <input type="text" class="form-control" name="codigo_barras" id="codigo_barras" placeholder="Escribe el codigo_barras" required="" onkeyup="config.UperCase('codigo_barras');">
                                </div>
                                <div class="col-md-3">
                                    <label>codigo_interno</label><br>
                                    <input type="text" class="form-control" name="codigo_interno" id="codigo_interno" placeholder="Escribe el codigo_interno" required="" onkeyup="config.UperCase('codigo_interno');">
                                </div>
                                <div class="col-md-3">
                                    <label>codigo_alterno</label><br>
                                    <input type="text" class="form-control" name="codigo_alterno" id="codigo_alterno" placeholder="Escribe el codigo_alterno" required="" onkeyup="config.UperCase('codigo_alterno');">
                                </div>
                                <div class="col-md-12"></div>
                                <div class="col-md-3">
                                    <label>id_presentacion</label><br>
                                    <select class="form-control" name="id_presentacion" id="id_presentacion">
                                        <option value="">SELECCIONE PRESENTACIÓN</option>
                                    @foreach ($presentaciones as $obj)
                                        <option value="{{ $obj['id'] }}">{{ $obj['nombre']}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>id_marca</label><br>
                                    <select class="form-control" name="id_marca" id="id_marca">
                                        <option value="">SELECCIONE MARCA</option>
                                    @foreach ($marcas as $obj)
                                        <option value="{{ $obj['id'] }}">{{ $obj['nombre']}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>factor_rendimiento (%)</label><br>
                                    <input type="number" class="form-control" name="factor_rendimiento" id="factor_rendimiento" maxlength="2" placeholder="Escribe el factor_rendimiento" value="0" required="" onkeyup="config.UperCase('factor_rendimiento');">
                                </div>
                                <div class="col-md-12"></div>
                                <div class="col-md-3">
                                    <label>stok_minimo</label><br>
                                    <input type="number"  class="form-control" name="stok_minimo" id="stok_minimo" value="0" placeholder="Escribe el stok_minimo" required="" onkeyup="config.UperCase('stok_minimo');">
                                </div>
                                <div class="col-md-3">
                                    <label>stok_maximo</label><br>
                                    <input type="number" class="form-control" name="stok_maximo" id="stok_maximo" value="1" placeholder="Escribe el stok_maximo" required="" onkeyup="config.UperCase('stok_maximo');">
                                </div>
                                <div class="col-md-12"></div>
                                <div class="col-md-3">
                                    <label>iva (%)</label><br>
                                    <input type="number" value="0" maxlength="2" class="form-control" name="iva" id="iva" placeholder="Escribe el iva" required="" onkeyup="config.UperCase('iva');">
                                </div>
                                <div class="col-md-3">
                                    <label>impo_consumo (%)</label><br>
                                    <input type="number" value="0" maxlength="2" class="form-control" name="impo_consumo" id="impo_consumo" placeholder="Escribe el impo_consumo" required="" onkeyup="config.UperCase('impo_consumo');">
                                </div>
                                <div class="col-md-3">
                                    <label>sobre_tasa (%)</label><br>
                                    <input type="number" maxlength="2" value="0" class="form-control" name="sobre_tasa" id="sobre_tasa" placeholder="Escribe el sobre_tasa" required="" onkeyup="config.UperCase('sobre_tasa');">
                                </div>
                                <div class="col-md-12">
                                    <label>serie</label><br>
                                    <input type="text" value="NA" class="form-control" name="serie" id="serie" placeholder="Escribe el serie" required="" onkeyup="config.UperCase('serie');">
                                </div>
                                <div class="col-md-3">
                                    <label>descuento (%)</label><br>
                                    <input type="number" maxlength="2" value="0" class="form-control" name="descuento" id="descuento" placeholder="Escribe el descuento" required="" onkeyup="config.UperCase('descuento');">
                                </div>
                                <div class="col-md-3">
                                    <label>id_clasificacion</label><br>
                                    <select class="form-control" name="id_clasificacion" id="id_clasificacion">
                                        <option value="">SELECCIONE CLASIFICACIÓN</option>
                                    @foreach ($clasificaciones as $obj)
                                        <option value="{{ $obj['id'] }}">{{ $obj['nombre']}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>peso</label><br>
                                    <input type="number" class="form-control" value="0" name="peso" id="peso" placeholder="Escribe el peso" required="" onkeyup="config.UperCase('peso');">
                                </div>
                                <div class="col-md-12"></div>
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
                                <div class="col-md-3">
                                    <label>estado</label><br>
                                   <select class="form-control" name="estado" id="estado">
                                        <option value="">SELECCIONE ESTADO</option>
                                        <option value="ACTIVO">ACTIVO</option>
                                        <option value="INACTIVO">INACTIVO</option>
                                        <option value="SUSPENDIDO">SUSPENDIDO</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>hommologo</label><br>
                                    <input type="text" class="form-control" name="hommologo" id="hommologo" placeholder="Escribe el hommologo" value="NA" required="" onkeyup="config.UperCase('hommologo');">
                                </div>
                                <div class="col-md-12"></div>
                                <div class="col-md-3">
                                    <label>costo</label><br>
                                    <input type="number" class="form-control" value="0" name="costo" id="costo" placeholder="Escribe el costo" required="" onkeyup="config.UperCase('costo');">
                                </div>
                                <div class="col-md-3">
                                    <label>costo_promedio</label><br>
                                    <input type="number" class="form-control" value="0" name="costo_promedio" id="costo_promedio" placeholder="Escribe el costo_promedio" required="" onkeyup="config.UperCase('costo_promedio');">
                                </div>
                                <div class="col-md-3">
                                    <label>saldo</label><br>
                                    <input type="number" class="form-control" value="0" name="saldo" id="saldo" placeholder="Escribe el saldo" required="" onkeyup="config.UperCase('saldo');">
                                </div>
                                <div class="col-md-3">
                                    <label>usuario_creador</label><br>
                                    <select class="form-control" name="usuario_creador" id="usuario_creador">
                                        <option value="">SELECCIONE USUARIO CREADOR</option>
                                    @foreach ($usuarios as $obj)
                                        <option value="{{ $obj['id'] }}">{{ $obj['nombre']}}</option>
                                    @endforeach
                                    </select>
                                </div>

                            </div>


                        <input type="submit" value="Guardar" id="btnguardar" class="btn btn-success form-control">
                        <div id="actualizar" onclick="config.send_post('#formulario', '/inventario/referencias/update', '/inventario/referencias');" class="btn btn-warning form-control">Actualizar</div>
                        </form>
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

@endsection()