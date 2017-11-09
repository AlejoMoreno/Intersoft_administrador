@extends('layout')

@section('content')


<div class="container-fluid">
    <div class="row">
        

        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Directorio</h4>
                    <p class="category">Diferentes Directorio</p>
                </div>
                <div class="content">
                    <div style="width:100;overflow-x:scroll;">
                    <table class="table table-hover table-striped" id="tableregimenes">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>nit</th>
                                <th>digito</th>
                                <th>razon_social</th>
                                <th>direccion</th>
                                <th>correo</th>
                                <th>telefono</th>
                                <th>telefono1</th>
                                <th>telefono2</th>
                                <th>financiacion</th>
                                <th>descuento</th>
                                <th>cupo_financiero</th>
                                <th>rete_ica</th>
                                <th>porcentaje_rete_iva</th>
                                <th>actividad_economica</th>
                                <th>calificacion</th>
                                <th>nivel</th>
                                <th>zona_venta</th>
                                <th>transporte</th>
                                <th>estado</th>
                                <th>id_retefuente</th>
                                <th>id_ciudad</th>
                                <th>id_regimen</th>
                                <th>id_usuario</th>
                                <th>id_directorio_tipo</th>
                                <th>id_directorio_clase</th>
                                <th>id_directorio_tipo_tercero</th> 
                                <th></th> 
                                <th></th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($directorios as $directorio)
                                <tr>
                                    <td>{{ $directorio['id'] }}</td>
                                    <td>{{ $directorio['nit'] }}</td>
                                    <td>{{ $directorio['digito'] }}</td>
                                    <td>{{ $directorio['razon_social'] }}</td>
                                    <td>{{ $directorio['direccion'] }}</td>
                                    <td>{{ $directorio['correo'] }}</td>
                                    <td>{{ $directorio['telefono'] }}</td>
                                    <td>{{ $directorio['telefono1'] }}</td>
                                    <td>{{ $directorio['telefono2'] }}</td>
                                    <td>{{ $directorio['financiacion'] }}</td>
                                    <td>{{ $directorio['descuento'] }}</td>
                                    <td>{{ $directorio['cupo_financiero'] }}</td>
                                    <td>{{ $directorio['rete_ica'] }}</td>
                                    <td>{{ $directorio['porcentaje_rete_iva'] }}</td>
                                    <td>{{ $directorio['actividad_economica'] }}</td>
                                    <td>{{ $directorio['calificacion'] }}</td>
                                    <td>{{ $directorio['nivel'] }}</td>
                                    <td>{{ $directorio['zona_venta'] }}</td>
                                    <td>{{ $directorio['transporte'] }}</td>
                                    <td>{{ $directorio['estado'] }}</td>
                                    <td>{{ $directorio['id_retefuente']['nombre'] }}</td>
                                    <td>{{ $directorio['id_ciudad']['nombre'] }}</td>
                                    <td>{{ $directorio['id_regimen']['nombre'] }}</td>
                                    <td>{{ $directorio['id_usuario']['nombre'] }}</td>
                                    <td>{{ $directorio['id_directorio_tipo']['nombre'] }}</td>
                                    <td>{{ $directorio['id_directorio_clase']['nombre'] }}</td>
                                    <td>{{ $directorio['id_directorio_tipo_tercero']['nombre'] }}</td>
                                    <td><a href="/administrador/directorios/update/{{  $directorio['id'] }}"><button class="btn btn-warning">></button></a></td>
                                    <td><a href="/administrador/directorios/delete/{{  $directorio['id'] }}"><button class="btn btn-danger">x</button></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                    <h4>Crear Directorio</h4>
                    <form action='/administrador/directorios/create' method="POST">
                    <div class="row">
                        <div class="col-md-12">
                        </div>
                        <div class="col-md-4">
                            <label>directorio tipo</label>
                            <select name="id_directorio_tipo" class="form-control"  onkeyup="config.UperCase('id_directorio_tipo');" id="id_directorio_tipo">
                                <option value="">SELECCIONE TIPO TERCERO</option>
                                @foreach ( $directorio_tipos as $value)
                                <option value="{{ $value['id'] }}">{{ $value['nombre'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label>nit</label>
                            <input type="text" name="nit" class="form-control"  onkeyup="config.UperCase('nit');" id="nit" placeholder="Ej.(1030570356)">
                        </div>
                        <div class="col-md-1">
                            <label>digito</label>
                            <input type="text" name="digito" class="form-control"  onkeyup="config.UperCase('digito');" id="digito" placeholder="Ej.(1)">
                        </div>
                        <div class="col-md-5">
                            <label>directorio clase</label>
                            <select name="id_directorio_clase" class="form-control"  onkeyup="config.UperCase('id_directorio_clase');" id="id_directorio_clase">
                                <option value="">SELECCIONE CLASE TERCERO</option>
                                @foreach ( $directorio_clases as $value)
                                <option value="{{ $value['id'] }}">{{ $value['nombre'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label>razon_social / nombre completo</label>
                            <input type="text" name="razon_social" class="form-control"  onkeyup="config.UperCase('razon_social');" id="razon_social" placeholder="Ej.(EMPRESA S.A.S)">
                        </div>

                        <div class="col-md-4">
                            <label>dirección comercial</label>
                            <input type="text" name="direccion" class="form-control"  onkeyup="config.UperCase('direccion');" id="direccion" placeholder="Ej.(CALLE 38 A 50 A 89 sur)">
                        </div>
                        <div class="col-md-4">
                            <label>dirección correo</label>
                            <input type="text" name="correo" class="form-control"  onkeyup="config.UperCase('correo');" id="correo" placeholder="Ej.(ADMINISTRACION@GMAIL.COM)">
                        </div>
                        <div class="col-md-4">
                            <label>ciudad</label>
                            <select name="id_ciudad" class="form-control"  onkeyup="config.UperCase('id_ciudad');" id="id_ciudad">
                                <option value="">SELECCIONE CIUDAD</option>
                                @foreach ( $ciudades as $ciudad)
                                <option value="{{ $ciudad['id'] }}">{{ $ciudad['nombre'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>telefono fijo</label>
                            <input type="text" name="telefono" class="form-control"  onkeyup="config.UperCase('telefono');" id="telefono" placeholder="Ej.(7744552)">
                        </div>
                        <div class="col-md-4">
                            <label>telefono/fax</label>
                            <input type="text" name="telefono1" class="form-control"  onkeyup="config.UperCase('telefono1');" id="telefono1" placeholder="Ej.(3219045297)">
                        </div>

                        <div class="col-md-4">
                            <label>celular</label>
                            <input type="text" name="telefono2" class="form-control"  onkeyup="config.UperCase('telefono2');" id="telefono2" placeholder="Ej.(3219045297)">
                        </div>
                        <div class="col-md-3">
                            <label>financiacion (%)</label>
                            <input type="number" name="financiacion" class="form-control"  onkeyup="config.UperCase('financiacion');" id="financiacion" placeholder="Ej.(10)">
                        </div>
                        <div class="col-md-3">
                            <label>descuento (%)</label>
                            <input type="number" name="descuento" class="form-control"  onkeyup="config.UperCase('descuento');" id="descuento" placeholder="Ej.(30)">
                        </div>
                        <div class="col-md-3">
                            <label>rete_ica (%)</label>
                            <input type="text" name="rete_ica" class="form-control"  onkeyup="config.UperCase('rete_ica');" id="rete_ica" placeholder="Ej.(8)">
                        </div>
                        <div class="col-md-3">
                            <label>porcentaje_rete_iva (%)</label>
                            <input type="text" name="porcentaje_rete_iva" class="form-control"  onkeyup="config.UperCase('porcentaje_rete_iva');" id="porcentaje_rete_iva" placeholder="Ej.(8)">
                        </div>
                        <div class="col-md-4">
                            <label>cupo_financiero ($)</label>
                            <input type="number" name="cupo_financiero" class="form-control"  onkeyup="config.UperCase('cupo_financiero');" id="cupo_financiero" placeholder="Ej.(200000000)">
                        </div>                        
                        <div class="col-md-4">
                            <label>actividad_economica</label>
                            <input type="text" name="actividad_economica" class="form-control"  onkeyup="config.UperCase('actividad_economica');" id="actividad_economica" placeholder="Ej.(1002)">
                        </div>
                        <div class="col-md-4">
                            <label>calificacion</label>
                            <select name="calificacion" class="form-control"  onkeyup="config.UperCase('calificacion');" id="calificacion">
                                <option value="">SELECCIONE CALIFICACIÓN</option>
                                <option value="2">2 (BUENO)</option>
                                <option value="1">1 (REGULAR)</option>
                                <option value="0">0 (MALO)</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label>nivel</label>
                            <select name="nivel" class="form-control"  onkeyup="config.UperCase('nivel');" id="nivel" placeholder="Ej.()">
                                <option value="">SELECCIONE NIVEL</option>
                                <option value="NACIONAL">NACIONAL</option>
                                <option value="INTERNACIONAL">INTERNACIONAL</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>zona_venta</label>
                            <input type="text" name="zona_venta" class="form-control"  onkeyup="config.UperCase('zona_venta');" id="zona_venta" placeholder="EJ.(BOGOTA)">
                        </div>
                        <div class="col-md-4">
                            <label>transporte</label>
                            <select name="transporte" class="form-control"  onkeyup="config.UperCase('transporte');" id="transporte">
                                <option value="">SELECCIONE SI TIENE O NO TRANSPORTE</option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>estado</label>
                            <select name="estado" class="form-control"  onkeyup="config.UperCase('estado');" id="estado">
                                <option value="ACTIVO">ACTIVO</option>
                                <option value="INACTIVO">INACTIVO</option>
                            </select>
                        </div>
                        
                        <div class="col-md-4">
                            <label>retefuente</label>
                            <select name="id_retefuente" class="form-control"  onkeyup="config.UperCase('id_retefuente');" id="id_retefuente">
                                <option value="">SELECCIONE RETEFUENTE A APLICAR</option>
                                @foreach ( $retefuentes as $retefuente)
                                <option value="{{ $retefuente['id'] }}">{{ $retefuente['nombre'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>regimen</label>
                            <select name="id_regimen" class="form-control"  onkeyup="config.UperCase('id_regimen');" id="id_regimen">
                                <option value="">SELECCIONE REGIMEN</option>
                                @foreach ( $regimenes as $regimen)
                                <option value="{{ $regimen['id'] }}">{{ $regimen['nombre'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>usuario</label>
                            <select name="id_usuario" class="form-control"  onkeyup="config.UperCase('id_usuario');" id="id_usuario">
                                <option value="">SELECCIONE USUARIO RESPONsABLE</option>
                                @foreach ( $usuarios as $usuario)
                                <option value="{{ $usuario['id'] }}">{{ $usuario['nombre'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>directorio tipo tercero</label>
                            <select name="id_directorio_tipo_tercero" class="form-control"  onkeyup="config.UperCase('id_directorio_tipo_tercero');" id="id_directorio_tipo_tercero">
                                <option value="">SELECCIONE OPCION</option>
                                @foreach ( $directorio_tipo_terceros as $value)
                                <option value="{{ $value['id'] }}">{{ $value['nombre'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 text-center">
                            <label>Boton</label>
                            <input type="submit" name="enviar" value="Guardar" class="btn btn-success form-control" id="enviar">
                        
                        </div>
                    </div>
                    
                    </form>
                    <div class="footer">
                        <div class="legend">
                            <i class="fa fa-circle text-info"></i> 
                            <i class="fa fa-circle text-danger"></i> 
                            <i class="fa fa-circle text-warning"></i>
                        </div>
                        <hr>
                        <div class="stats">
                            <i class="pe-7s-angle-left-circle"></i> <a href="#" onclick="config.Redirect('/administrador/index');"> ir atras.</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection()