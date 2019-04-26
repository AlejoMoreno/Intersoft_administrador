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
                    <h4>Crear Directorio</h4>
                    <form action='/administrador/directorios/create' method="POST">
                        <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="col-md-12">
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
                        <div class="col-md-2">
                            <label>nit </label><button type="button" class="boton_invisible" data-toggle="modal" data-target="#myModal"><img onclick="directorios.buscar();" style="width: 30px;padding-left: 10px;" src="https://image.flaticon.com/icons/svg/751/751381.svg" title="Buscar en la base de datos"></button>
                            <input type="text" name="nit" class="form-control" onkeyup="config.UperCase('nit');" id="nit" placeholder="Ej.(1030570356)" required="">
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
                            <label>razon_social / nombre completo</label><button type="button" class="boton_invisible"  data-toggle="modal" data-target="#myModal"><img onclick="directorios.buscar();" style="width: 30px;padding-left: 10px;" src="https://image.flaticon.com/icons/svg/751/751381.svg" title="Buscar en la base de datos"></button>
                            <input type="text" name="razon_social" class="form-control"  onkeyup="config.UperCase('razon_social');" id="razon_social" placeholder="Ej.(EMPRESA S.A.S)" required="">
                        </div>

                        <div class="col-md-4">
                            <label>dirección comercial</label>
                            <input type="text" name="direccion" class="form-control"  onkeyup="config.UperCase('direccion');" id="direccion" placeholder="Ej.(CALLE 38 A 50 A 89 sur)">
                        </div>
                        <div class="col-md-4">
                            <label>dirección correo</label><button type="button" class="boton_invisible" data-toggle="modal" data-target="#myModal"><img onclick="directorios.buscar();" style="width: 30px;padding-left: 10px;" src="https://image.flaticon.com/icons/svg/751/751381.svg" title="Buscar en la base de datos"></button>
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
                            <label>directorio tipo</label>
                            <select name="id_directorio_tipo" class="form-control"  onkeyup="config.UperCase('id_directorio_tipo');" id="id_directorio_tipo">
                                <option value="">SELECCIONE TIPO TERCERO</option>
                                @foreach ( $directorio_tipos as $value)
                                <option value="{{ $value['id'] }}">{{ $value['nombre'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 text-center">
                            <br>
                            <input type="submit" name="guardarbtn" class="btn btn-success" value="Guardar">
                            <div id="btnactualizar" class="btn btn-warning" onclick="directorios.sendUpdate();">Actualizar</div>
                            <div id="btneliminar" class="btn btn-danger" onclick="directorios.eliminar();">Eliminar</div>
                        
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

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Productos Encontrados</h4>
        </div>
        <div class="modal-body">
          <p>Estos son los clientes encontrados.</p>
          <div id="clientes_encontrados" style="overflow: scroll" ></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" id="butonmodal" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  

@endsection()