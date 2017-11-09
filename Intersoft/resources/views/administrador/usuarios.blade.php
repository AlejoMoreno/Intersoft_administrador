@extends('layout')

@section('content')


<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="header">
                    <h4 class="title">Administrador</h4>
                    <p class="category">Nota: Las imagenes que se muestran a continuación representan un link a donde podrás viajar por intersoft.</p>
                </div>
                <div class="content">
                    

                    <div class="footer">
                        <div class="legend">
                            <i class="fa fa-circle text-info"></i> 
                            <i class="fa fa-circle text-danger"></i> 
                            <i class="fa fa-circle text-warning"></i> 
                        </div>
                        <hr>
                        <div class="stats">
                            <i class="fa fa-clock-o"></i> Ir a la sección del manual
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="header">
                    <h4 class="title">Usuarios</h4>
                    <p class="category">Diferentes Usuarios de la aplicación</p>
                </div>
                <div class="content">
                    <div style="width:100%;overflow-x:scroll;">
                    <table class="table table-hover table-striped" id="tableusuarios">
                        <thead>
                            <tr>
                                <th>ID</th> 
                                <th>ncedula</th>
                                <th>nombre</th>                                 
                                <th>apellido</th> 
                                <th>cargo</th> 
                                <th>telefono</th> 
                                <th>password</th> 
                                <th>correo</th> 
                                <th>estado</th> 
                                <th>token</th> 
                                <th>arl</th> 
                                <th>eps</th> 
                                <th>cesantias</th> 
                                <th>pension</th> 
                                <th>caja_compensacion</th> 
                                <th>id_contrato</th>
                                <th>referencia_personal</th>
                                <th>telefono_referencia</th> 
                                <th></th> 
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
                                    <td>{{ $usuario['password'] }}</td>
                                    <td>{{ $usuario['correo'] }}</td>
                                    <td>{{ $usuario['estado'] }}</td>
                                    <td>{{ $usuario['token'] }}</td>
                                    <td>{{ $usuario['arl'] }}</td>
                                    <td>{{ $usuario['eps'] }}</td>
                                    <td>{{ $usuario['cesantias'] }}</td>
                                    <td>{{ $usuario['pension'] }}</td>
                                    <td>{{ $usuario['caja_compensacion'] }}</td>
                                    <td>Contrato No.{{ $usuario['id_contrato']['id'] }}</td>
                                    <td>{{ $usuario['referencia_personal'] }}</td>
                                    <td>{{ $usuario['telefono_referencia'] }}</td>
                                    <td><a href="/administrador/usuarios/update/{{  $usuario['id'] }}"><button class="btn btn-warning">></button></a></td>
                                    <td><a href="/administrador/usuarios/delete/{{  $usuario['id'] }}"><button class="btn btn-danger">x</button></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                    <div class="header">
                        <h4 class="title">Creacion  Usuarios</h4>
                        <p class="category">Formulario para creacion de usuarios</p><br><br>
                    </div>
                    <div style="width:100%;overflow-x:scroll;">
                    <table class="table table-hover table-striped" id="tableusuarios">
                    <form action='/administrador/usuarios/create' method="POST">
                        <thead>
                            <tr>
                                <th>ncedula</th>
                                <th>nombre</th>                                 
                                <th>apellido</th> 
                                <th>cargo</th> 
                            </tr>
                            <tr>
                                <td><input style="width:200px;" type="text" class="form-control" name="ncedula" id="ncedula"></td>
                                <td><input style="width:200px;" type="text" class="form-control" name="nombre" id="nombre"></td>
                                <td><input style="width:200px;" type="text" class="form-control" name="apellido" id="apellido"></td>
                                <td><input style="width:200px;" type="text" class="form-control" name="cargo" id="cargo"></td>
                            </tr>
                            <tr>
                                <th>telefono</th> 
                                <th>password</th> 
                                <th>correo</th> 
                                <th>estado</th> 
                            </tr>
                            <tr>
                                <td><input type="text" class="form-control" name="telefono" id="telefono"></td>
                                <td><input type="text" class="form-control" name="password" id="password"></td>
                                <td><input type="text" class="form-control" name="correo" id="correo"></td>
                                <td><select class="form-control" name="estado" id="estado">
                                    <option value="">SELECCIONE ESTADO</option>
                                    <option value="ACTIVO">ACTIVO</option>
                                    <option value="INACTIVO">INACTIVO</option>
                                    <option value="SUSPENDIDO">SUSPENDIDO</option>
                                </select></td>
                            </tr>
                            <tr>
                                <th>token</th> 
                                <th>arl</th> 
                                <th>eps</th> 
                                <th>cesantias</th> 
                            </tr>
                            <tr>
                                <td><input type="text" class="form-control" name="token" id="token"></td>
                                <td><input type="text" class="form-control" name="arl" id="arl"></td>
                                <td><input type="text" class="form-control" name="eps" id="eps"></td>
                                <td><input type="text" class="form-control" name="cesantias" id="cesantias"></td>
                            </tr>
                            <tr>
                                <th>pension</th> 
                                <th>caja_compensacion</th> 
                                <th>id_contrato</th> 
                            </tr>
                            <tr>
                                <td><input type="text" class="form-control" name="pension" id="pension"></td>
                                <td><input type="text" class="form-control" name="caja_compensacion" id="caja_compensacion"></td>
                                <td><select class="form-control" name="id_contrato" id="id_contrato">
                                    <option value="">SELECCIONE CONTRATO</option>
                                @foreach ($contratos as $contrato)
                                    <option value="{{ $contrato['id'] }}">Contrato No {{ $contrato['id']}}</option>
                                @endforeach
                                </select></td>
                            </tr>
                            <tr>
                                <th>referencia_personal</th> 
                                <th>telefono_referencia</th> 
                                <th>boton</th> 
                                <th>boton</th>     
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="text" class="form-control" name="referencia_personal" id="referencia_personal"></td>
                                <td><input type="text" class="form-control" name="telefono_referencia" id="telefono_referencia"></td>
                                <td><input type="submit" value="Guardar" id="btnguardar" class="btn btn-success form-control"></td>
                                <td><button id="actualizar" onclick="sucursal.sendUpdate();" class="btn btn-warning form-control">Actualizar</button></td>
                            </tr>                            
                        </tbody>
                    </form>
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
    </div>
</div>


@endsection()