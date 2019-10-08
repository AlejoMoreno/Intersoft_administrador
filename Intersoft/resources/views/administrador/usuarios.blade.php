@extends('layout')

@section('content')


<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
            <div class="card" id="tabla">
                <div class="header">
                    <h4 class="title">Usuarios</h4>
                    <p class="category">Diferentes Usuarios de la aplicación</p>
                </div>
                <div class="content">
                    <div style="width:100%;overflow-x:scroll;">
                        <table class="table table-bordered table-striped" id="datos">
                            <thead>
                                <tr>
                                    <th>ID</th> 
                                    <th>ncedula</th>
                                    <th>nombre</th>                                 
                                    <th>apellido</th> 
                                    <th>cargo</th> 
                                    <th>telefono</th> 
                                    <th>correo</th> 
                                    <th>estado</th> 
                                    <th>Contrato</th>
                                    <th></th> 
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usuarios as $usuario)
                                    <tr>
                                        <td>{{ $usuario['id'] }}</td>
                                        <td>{{ $usuario['ncedula'] }}</td>
                                        <td>{{ $usuario['nombre'] }}</td>                                    
                                        <td>{{ $usuario['apellido'] }}</td>
                                        <td>{{ $usuario['cargo'] }}</td>
                                        <td>{{ $usuario['telefono'] }}</td>
                                        <td>{{ $usuario['correo'] }}</td>
                                        <td>{{ $usuario['estado'] }}</td>
                                        <td>Contrato No.{{ $usuario['id_contrato']['id'] }}</td>
                                        <td><a href="javascript:;" onclick="usuarios.update('{{ $usuario }}');"><button class="btn btn-warning">></button></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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

        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Crear usuarios</h4>
                    <p class="category">Formulario para creacion de usuarios</p>
                </div>
                <div class="content">
                    <form action='/administrador/usuarios/create' method="POST" name="formulario" id="formulario">
                        <input type="hidden" name="id" id="id">
                        <div class="row">
                            <div class="col-md-4" >
                                <div class="card" style="box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);">
                                    <div class="header">
                                        <h6 class="title">Datos 1</h6>
                                    </div>
                                    <div class="content">
                                        
                                        <label>ncedula</label><input type="text" class="form-control" name="ncedula" id="ncedula">
                                        <label>nombres</label><input type="text" class="form-control" name="nombre" id="nombre">
                                        <label>apellidos</label><input type="text" class="form-control" name="apellido" id="apellido">
                                        <label>cargo</label><input type="text" class="form-control" name="cargo" id="cargo">

                                        
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4" >
                                <div class="card" style="box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);">
                                    <div class="header">
                                        <h6 class="title">Datos 2</h6>
                                    </div>
                                    <div class="content">
                                        
                                        <label>teléfono</label><input type="text" class="form-control" name="telefono" id="telefono">
                                        <label>contraseña</label><input type="text" class="form-control" name="password" id="password">
                                        <label>correo</label><input type="text" class="form-control" name="correo" id="correo">
                                        <label>estado</label><select class="form-control" name="estado" id="estado">
                                            <option value="ACTIVO">ACTIVO</option>
                                            <option value="INACTIVO">INACTIVO</option>
                                            <option value="SUSPENDIDO">SUSPENDIDO</option>
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
                                        
                                        <label>Token</label><input type="text" class="form-control" value="NA" name="token" id="token"></td>
                                        <label>arl</label><input type="text" class="form-control" name="arl" id="arl"></td>
                                        <label>eps</label><input type="text" class="form-control" name="eps" id="eps"></td>
                                        <label>Cesantias</label><input type="text" class="form-control" name="cesantias" id="cesantias"></td>

                                        
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4" >
                                <div class="card" style="box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);">
                                    <div class="header">
                                        <h6 class="title">Datos 3</h6>
                                    </div>
                                    <div class="content">
                                        
                                        <label>Pensión</label><input type="text" class="form-control" name="pension" id="pension">
                                        <label>Caja compensación</label><input type="text" class="form-control" name="caja_compensacion" id="caja_compensacion">
                                        <label>Contrato</label><select class="form-control" name="id_contrato" id="id_contrato">
                                        @foreach ($contratos as $contrato)
                                            <option value="{{ $contrato['id'] }}">Contrato No {{ $contrato['id']}}</option>
                                        @endforeach
                                        </select>
                                        <LABEL>teléfono referencia</LABEL><input type="text" class="form-control" name="telefono_referencia" id="telefono_referencia">
                                        <label>Nombre referencia</label><input type="text" class="form-control" name="referencia_personal" id="referencia_personal">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6" >
                                <div class="card" style="box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);background: white;">
                                    <div class="header">
                                        <h6 class="title">Acciones/botónes</h6>
                                    </div>
                                    <div class="content">
                                        <input type="submit" value="Guardar" id="btnguardar" class="btn btn-success">
                                        <div id="actualizar" onclick="config.send_post('#formulario', '/administrador/usuarios/update', '/administrador/usuarios');" class="btn btn-warning">Actualizar</div>
                                        <div class="btn btn-danger" onclick="config.printDiv('tabla');">Imprimir usuarios</div>
                                        <div class="btn btn-default">Subir Imagen</div>
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


@endsection()