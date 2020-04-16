@extends('layout')

@section('content')


<div class="container-fluid">
    <div class="row">

        

        <form action='/administrador/directorios/create' method="POST">
            <input type="hidden" name="id" id="id">
            <div class="col-md-12">
                <div class="card">
                    <div class="header row">
                        <div class="col-md-6">
                            <h4 class="title">Crear Directorio</h4>
                            <p class="category">Diferentes Directorio</p>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-3">
                                <p>Observar</p>
                                <div onclick="directorios.buscar()" style="width: 100%;background: white;" class="btn btn-info" data-toggle="modal" data-target="#myModal">(*)</div>    
                            </div>
                            <div class="col-md-9">
                                <p>Descargar</p>
                                <div onclick="directorios.envioExcel()" style="width: 45%;background: white;" class="btn btn-success">(EXCEL)</div>
                                <div onclick="directorios.envioPDF()" style="width: 45%;background: white;" class="btn btn-danger">(PDF)</div>
                            </div>
                            <div class="col-md-12"><br></div>
                        </div>
                    </div>
                    
                    <div class="content">
                        
                        <div class="row">
                            
                            <div class="col-md-4" >
                                <div class="card" style="box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);">
                                    <div class="header">
                                        <h6 class="title">Datos 1</h6>
                                    </div>
                                    <div class="content">

                                        <label>directorio tipo tercero</label>
                                        <select name="id_directorio_tipo_tercero" class="form-control"  onkeyup="config.UperCase('id_directorio_tipo_tercero');" id="id_directorio_tipo_tercero">
                                            @foreach ( $directorio_tipo_terceros as $value)
                                            <option value="{{ $value['id'] }}">{{ $value['nombre'] }}</option>
                                            @endforeach
                                        </select>
                                    
                                        <div class="col-md-10">
                                            <label>nit </label><button type="button" class="boton_invisible" data-toggle="modal" data-target="#myModal"><img onclick="directorios.buscar();" style="width: 30px;padding-left: 10px;" src="/assets/751381.svg" title="Buscar en la base de datos"></button>
                                            <input type="text" name="nit" class="form-control" onkeyup="config.UperCase('nit');" id="nit" placeholder="Ej.(1030570356)" required="">
                                        </div>
                                        <div class="col-md-2">
                                            <label>digito</label>
                                            <input type="text" name="digito" class="form-control"  onkeyup="config.UperCase('digito');" id="digito" placeholder="Ej.(1)">
                                        </div>
                                        <label>directorio clase</label>
                                        <select name="id_directorio_clase" class="form-control"  onkeyup="config.UperCase('id_directorio_clase');" id="id_directorio_clase">
                                            @foreach ( $directorio_clases as $value)
                                            <option value="{{ $value['id'] }}">{{ $value['nombre'] }}</option>
                                            @endforeach
                                        </select>
                                        <label>razon_social / nombre completo</label><button type="button" class="boton_invisible"  data-toggle="modal" data-target="#myModal"><img onclick="directorios.buscar();" style="width: 30px;padding-left: 10px;" src="/assets/751381.svg" title="Buscar en la base de datos"></button>
                                        <input type="text" name="razon_social" class="form-control"  onkeyup="config.UperCase('razon_social');" id="razon_social" placeholder="Ej.(EMPRESA S.A.S)" required="">                                    

                                        <label>dirección comercial</label>
                                        <input type="text" name="direccion" class="form-control"  onkeyup="config.UperCase('direccion');" id="direccion" placeholder="Ej.(CALLE 38 A 50 A 89 sur)">
                                        <label>dirección correo</label><button type="button" class="boton_invisible" data-toggle="modal" data-target="#myModal"><img onclick="directorios.buscar();" style="width: 30px;padding-left: 10px;" src="/assets/751381.svg" title="Buscar en la base de datos"></button>
                                        <input type="text" name="correo" class="form-control"  onkeyup="config.UperCase('correo');" id="correo" placeholder="Ej.(ADMINISTRACION@GMAIL.COM)">
                                        <label>ciudad</label>
                                        <select name="id_ciudad" class="form-control"  onkeyup="config.UperCase('id_ciudad');" id="id_ciudad">
                                            @foreach ( $ciudades as $ciudad)
                                            <option value="{{ $ciudad['id'] }}">{{ $ciudad['codigo'] }} - {{ $ciudad['nombre'] }}</option>
                                            @endforeach
                                        </select>
                                        <label>telefono fijo</label>
                                        <input type="text" name="telefono" value="0" class="form-control"  onkeyup="config.UperCase('telefono');" id="telefono" placeholder="Ej.(7744552)">
                                        <label>telefono/fax</label>
                                        <input type="text" name="telefono1" value="0" class="form-control"  onkeyup="config.UperCase('telefono1');" id="telefono1" placeholder="Ej.(3219045297)">
                                        <label>celular</label>
                                        <input type="text" name="telefono2" value="0" class="form-control"  onkeyup="config.UperCase('telefono2');" id="telefono2" placeholder="Ej.(3219045297)">
                                
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4" >
                                <div class="card" style="box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);">
                                    <div class="header">
                                        <h6 class="title">Datos 2</h6>
                                    </div>
                                    <div class="content">
                                        
                                        <label>financiacion (%)</label>
                                        <input type="number" name="financiacion" value="0" class="form-control"  onkeyup="config.UperCase('financiacion');" id="financiacion" placeholder="Ej.(10)">
                                        <label>descuento (%)</label>
                                        <input type="number" name="descuento" value="0" class="form-control"  onkeyup="config.UperCase('descuento');" id="descuento" placeholder="Ej.(30)">
                                        <input type="hidden" name="rete_ica" value="0" class="form-control"  onkeyup="config.UperCase('rete_ica');" id="rete_ica" value="0" placeholder="Ej.(8)">
                                        <input type="hidden" name="porcentaje_rete_iva" value="0" class="form-control"  onkeyup="config.UperCase('porcentaje_rete_iva');" value="0" id="porcentaje_rete_iva" placeholder="Ej.(8)">
                                        <label>cupo_financiero ($)</label>
                                        <input type="number" name="cupo_financiero" value="0" class="form-control"  onkeyup="config.UperCase('cupo_financiero');" id="cupo_financiero" placeholder="Ej.(200000000)">
                                        <label>actividad_economica</label>
                                        <input type="text" name="actividad_economica" value="0000" class="form-control"  onkeyup="config.UperCase('actividad_economica');" id="actividad_economica" placeholder="Ej.(1002)">
                                        <label>calificacion</label>
                                        <select name="calificacion" class="form-control"  onkeyup="config.UperCase('calificacion');" id="calificacion">
                                            <option value="2">2 (BUENO)</option>
                                            <option value="1">1 (REGULAR)</option>
                                            <option value="0">0 (MALO)</option>
                                        </select>
                                        <label>nivel</label>
                                        <select name="nivel" class="form-control"  onkeyup="config.UperCase('nivel');" id="nivel" placeholder="Ej.()">
                                            <option value="NACIONAL">NACIONAL</option>
                                            <option value="INTERNACIONAL">INTERNACIONAL</option>
                                        </select>
                                        <label>zona_venta</label>
                                        <input type="text" name="zona_venta" value="NA" class="form-control"  onkeyup="config.UperCase('zona_venta');" id="zona_venta" placeholder="EJ.(BOGOTA)">
                                        <label>SELECCIONE SI TIENE O NO TRANSPORTE</label>
                                        <select name="transporte" class="form-control"  onkeyup="config.UperCase('transporte');" id="transporte">
                                            <option value="NO">NO</option>
                                            <option value="SI">SI</option>
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
                                        
                                        <label>estado</label>
                                        <select name="estado" class="form-control"  onkeyup="config.UperCase('estado');" id="estado">
                                            <option value="ACTIVO">ACTIVO</option>
                                            <option value="INACTIVO">INACTIVO</option>
                                        </select>
                                        <label>retefuente</label>
                                        <select name="id_retefuente" class="form-control"  onkeyup="config.UperCase('id_retefuente');" id="id_retefuente">
                                            @foreach ( $retefuentes as $retefuente)
                                            <option value="{{ $retefuente['id'] }}">{{ $retefuente['nombre'] }}</option>
                                            @endforeach
                                        </select>
                                        <label>regimen</label>
                                        <select name="id_regimen" class="form-control"  onkeyup="config.UperCase('id_regimen');" id="id_regimen">
                                            @foreach ( $regimenes as $regimen)
                                            <option value="{{ $regimen['id'] }}">{{ $regimen['nombre'] }}</option>
                                            @endforeach
                                        </select>
                                        <label>usuario</label>
                                        <select name="id_usuario" class="form-control"  onkeyup="config.UperCase('id_usuario');" id="id_usuario">
                                            @foreach ( $usuarios as $usuario)
                                            <option value="{{ $usuario['id'] }}">{{ $usuario['nombre'] }}</option>
                                            @endforeach
                                        </select>
                                        <label>directorio tipo</label>
                                        <select name="id_directorio_tipo" class="form-control"  onkeyup="config.UperCase('id_directorio_tipo');" id="id_directorio_tipo">   
                                            @foreach ( $directorio_tipos as $value)
                                            <option value="{{ $value['id'] }}">{{ $value['nombre'] }}</option>
                                            @endforeach
                                        </select>
                                        <br>
                                        <input type="submit" name="guardarbtn" class="btn btn-success" value="Guardar">
                                        <div id="btnactualizar" class="btn btn-warning" onclick="directorios.sendUpdate();">Actualizar</div>
                                        <!--div id="btneliminar" class="btn btn-danger" onclick="directorios.eliminar();">Eliminar</div-->
                                    
                                    
                                    </div>
                                </div>
                            </div>

                        </div>


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
        </form>
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