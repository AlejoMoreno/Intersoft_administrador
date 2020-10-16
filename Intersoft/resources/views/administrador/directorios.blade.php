@extends('layout')

@section('content')


<div class="enc-article">
    <h4 class="title">Directorio</h4>
</div>

<div class="row top-11-w" style="padding:2%;">

    <div class="panel panel-default col-md-5" >
        <!-- Default panel contents -->
        <div class="panel-heading row"><h5>Vista de Directorio</h5></div>
        <div class="panel-body" >
            <p style="font-size: 10pt;">A continuación se detallan los resultados de la busqueda del cliente, proveedor o tercero.
            </p>
        </div>

        <!-- Table -->
        <div style="overflow-x:scroll;">
            <div id="clientes_encontrados" style="overflow: scroll" ></div>
        </div>
    </div>

    <div class="col-md-7 row">
        <div class="panel panel-warning col-md-12" >
            <!-- Default panel contents -->
            <form action='/administrador/directorios/create' method="POST">
                <input type="hidden" name="id" id="id">
                <div class="panel-heading row" >
                    <h5 class="col-md-4">Creación directorio </h5>
                    <div class="col-md-8 row">
                        <button type="submit" id="btnguardar" class="btn btn-success col-md-2 btn-guardar"><i class="fas fa-save"></i> </button>
                        <div id="actualizar" onclick="directorios.sendUpdate();" class="btn btn-warning col-md-2 btn-actualizar"><i class="fas fa-pen-square"></i> </div>
                        <div onclick="config.Redirect('/administrador/directorios');" class="btn btn-danger col-md-2 btn-nuevo"><i class="fas fa-plus-circle"></i> </div>
                        <div onclick="directorios.buscar()" class="btn btn-info col-md-2 btn-buscar" ><i class="fas fa-search"></i> </div>    
                    </div>                
                </div>
                <div class="panel-body" >
                    <p style="font-size: 10pt;">Diligencie cada uno de los datos relacionados con el cliente, proveedor o tercero a crear.
                    </p>
                </div>

                <div class="row">
                                
                    <div class="col-md-12" >
                        <div class="row">
                            <div class="col-md-4">
                                <label>Directorio tipo tercero</label>
                                <select name="id_directorio_tipo_tercero" class="form-control"  onkeyup="config.UperCase('id_directorio_tipo_tercero');" id="id_directorio_tipo_tercero">
                                    @foreach ( $directorio_tipo_terceros as $value)
                                    <option value="{{ $value['id'] }}">{{ $value['nombre'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Nit </label>
                                <input type="text" name="nit" class="form-control" onkeyup="config.UperCase('nit');" id="nit" placeholder="Ej.(1030570356)" required="">
                                <div style="position: absolute;top:22px;right:18px;">
                                    <button type="button" class="btn btn-info btn-buscar" onclick="directorios.buscar();"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label>Digito</label>
                                <input type="text" name="digito" class="form-control"  onkeyup="config.UperCase('digito');" id="digito" placeholder="Ej.(1)">
                            </div>
                            <div class="col-md-2">
                                <label>Clase</label>
                                <select name="id_directorio_clase" class="form-control"  onkeyup="config.UperCase('id_directorio_clase');" id="id_directorio_clase">
                                    @foreach ( $directorio_clases as $value)
                                    <option value="{{ $value['id'] }}">{{ $value['nombre'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <label>razon_social / nombre completo</label>
                                <input type="text" name="razon_social" class="form-control"  onkeyup="config.UperCase('razon_social');" id="razon_social" placeholder="Ej.(EMPRESA S.A.S)" required="">
                                <div style="position: absolute;top:22px;right:18px;">
                                    <button type="button" class="btn btn-info btn-buscar" onclick="directorios.buscar();"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <label>dirección comercial</label>
                                <input type="text" name="direccion" class="form-control"  onkeyup="config.UperCase('direccion');" id="direccion" placeholder="Ej.(CALLE 38 A 50 A 89 sur)">
                                <div style="position: absolute;top:22px;right:18px;">
                                    <a href="/gps/directoriomaps" target="_blank" style="background:white;" class="btn btn-warning"><i class="fas fa-map-signs"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <label>Dirección correo</label>
                                <input type="text" name="correo" class="form-control"  onkeyup="config.UperCase('correo');" id="correo" placeholder="Ej.(ADMINISTRACION@GMAIL.COM)">                        
                            </div>
                            <div class="col-md-2">
                                <label>Ciudad</label>
                                <select name="id_ciudad" class="form-control"  onkeyup="config.UperCase('id_ciudad');" id="id_ciudad">
                                    @foreach ( $ciudades as $ciudad)
                                    <option value="{{ $ciudad['id'] }}">{{ $ciudad['nombre'] }} - {{ $ciudad['codigo'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label>Telefono fijo</label>
                                <input type="text" name="telefono" value="0" class="form-control"  onkeyup="config.UperCase('telefono');" id="telefono" placeholder="Ej.(7744552)">                                
                            </div>
                            <div class="col-md-2">
                                <label>Telefono/fax</label>
                                <input type="text" name="telefono1" value="0" class="form-control"  onkeyup="config.UperCase('telefono1');" id="telefono1" placeholder="Ej.(3219045297)">                                
                            </div>
                            <div class="col-md-2">
                                <label>Celular</label>
                                <input type="text" name="telefono2" value="0" class="form-control"  onkeyup="config.UperCase('telefono2');" id="telefono2" placeholder="Ej.(3219045297)">                        
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-3">
                                <label>Financiacion (%)</label>
                                <input type="number" name="financiacion" value="0" class="form-control"  onkeyup="config.UperCase('financiacion');" id="financiacion" placeholder="Ej.(10)">                            
                            </div>
                            <div class="col-md-3">
                                <label>Descuento (%)</label>
                                <input type="number" name="descuento" value="0" class="form-control"  onkeyup="config.UperCase('descuento');" id="descuento" placeholder="Ej.(30)">                            
                            </div>
                            <div class="col-md-3">
                                <input type="hidden" name="rete_ica" value="0" class="form-control"  onkeyup="config.UperCase('rete_ica');" id="rete_ica" value="0" placeholder="Ej.(8)">
                                <input type="hidden" name="porcentaje_rete_iva" value="0" class="form-control"  onkeyup="config.UperCase('porcentaje_rete_iva');" value="0" id="porcentaje_rete_iva" placeholder="Ej.(8)">
                                <label>Cupo financiero ($)</label>                            
                                <input type="number" name="cupo_financiero" value="0" class="form-control"  onkeyup="config.UperCase('cupo_financiero');" id="cupo_financiero" placeholder="Ej.(200000000)">
                            </div>
                            <div class="col-md-3">
                                <label>Actividad_economica</label>
                                <input type="text" name="actividad_economica" value="0000" class="form-control"  onkeyup="config.UperCase('actividad_economica');" id="actividad_economica" placeholder="Ej.(1002)">                        
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <label>Calificacion</label>
                                <select name="calificacion" class="form-control"  onkeyup="config.UperCase('calificacion');" id="calificacion">
                                    <option value="2">2 (BUENO)</option>
                                    <option value="1">1 (REGULAR)</option>
                                    <option value="0">0 (MALO)</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Nivel</label>
                                <select name="nivel" class="form-control"  onkeyup="config.UperCase('nivel');" id="nivel" placeholder="Ej.()">
                                    <option value="NACIONAL">NACIONAL</option>
                                    <option value="INTERNACIONAL">INTERNACIONAL</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Transporte</label>
                                <select name="transporte" class="form-control"  onkeyup="config.UperCase('transporte');" id="transporte">
                                    <option value="NO">NO</option>
                                    <option value="SI">SI</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Zona venta</label>
                                <input type="text" name="zona_venta" value="NA" class="form-control"  onkeyup="config.UperCase('zona_venta');" id="zona_venta" placeholder="EJ.(BOGOTA)">
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-4">
                                <label>estado</label>
                                <select name="estado" class="form-control"  onkeyup="config.UperCase('estado');" id="estado">
                                    <option value="ACTIVO">ACTIVO</option>
                                    <option value="INACTIVO">INACTIVO</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label>retefuente</label>
                                <select name="id_retefuente" class="form-control"  onkeyup="config.UperCase('id_retefuente');" id="id_retefuente">
                                    @foreach ( $retefuentes as $retefuente)
                                    <option value="{{ $retefuente['id'] }}">{{ $retefuente['nombre'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label>regimen</label>
                                <select name="id_regimen" class="form-control"  onkeyup="config.UperCase('id_regimen');" id="id_regimen">
                                    @foreach ( $regimenes as $regimen)
                                    <option value="{{ $regimen['id'] }}">{{ $regimen['nombre'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label>usuario</label>
                                <select name="id_usuario" class="form-control"  onkeyup="config.UperCase('id_usuario');" id="id_usuario">
                                    @foreach ( $usuarios as $usuario)
                                    <option value="{{ $usuario['id'] }}">{{ $usuario['nombre'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label>directorio tipo</label>
                                <select name="id_directorio_tipo" class="form-control"  onkeyup="config.UperCase('id_directorio_tipo');" id="id_directorio_tipo">   
                                    @foreach ( $directorio_tipos as $value)
                                    <option value="{{ $value['id'] }}">{{ $value['nombre'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <br><br>

    
                    </div>

                    
                    
                </div>

            </form>    
        </div>
    </div>


</div>


@endsection()