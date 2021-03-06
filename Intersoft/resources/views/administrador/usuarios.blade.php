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
    <h4 class="title">Usuarios</h4>
</div>

<div class="row top-11-w" style="padding:2%;">

    <div class="panel panel-default col-md-5" >
        <!-- Default panel contents -->
        <div class="panel-heading row"><h5>Vista de usuarios</h5></div>
        <div class="panel-body" >
            <p style="font-size: 10pt;">A contiuación se describe la lista de usuarios, aqui usted puede realizar la actualización de cada uno de los usuarios con el boton <a href="javascript:;" ><button class="btn btn-warning">></button></a>.<br>
                Además podrá adicionar un usuario en el formulario que continua con la lista de usuarios.
            </p>
        </div>

        <!-- Table -->
        <div style="overflow-x:scroll;">
            <table class="table table-hover" id="tabla">
                <thead>
                    <tr>
                        <th>ID</th> 
                        <th>ncedula</th>
                        <th>nombre</th>                                 
                        <th>apellido</th> 
                        <th>cargo</th>
                        <th>Lista Precio</th> 
                        <th>telefono</th> 
                        <th>correo</th> 
                        <th>estado</th> 
                        <th>Contrato</th>
                        <th></th> 
                    </tr>
                </thead>
                <tbody>
                    @if($usuarios!=null)
                        @foreach ($usuarios as $usuario)
                            <tr onclick="usuarios.update('{{ $usuario }}');">
                                <td>{{ $usuario['id'] }}</td>
                                <td>{{ $usuario['ncedula'] }}</td>
                                <td>{{ $usuario['nombre'] }}</td>                                    
                                <td>{{ $usuario['apellido'] }}</td>
                                <td>{{ $usuario['cargo'] }}</td>
                                <td>{{ $usuario['pension'] }}</td>
                                <td>{{ $usuario['telefono'] }}</td>
                                <td>{{ $usuario['correo'] }}</td>
                                <td>{{ $usuario['estado'] }}</td>
                                <td>Contrato No.{{ $usuario['id_contrato']['id'] }}</td>
                                <td><a href="javascript:;" onclick="usuarios.update('{{ $usuario }}');"><button class="btn btn-warning">></button></a></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>


    <div class="col-md-7 row">
        <div class="panel panel-warning col-md-12" >
            <!-- Default panel contents -->
            <form action='/administrador/usuarios/create' method="POST" name="formulario" id="formulario">
                <div class="panel-heading row" >
                    <h5 class="col-md-4">Creación usuarios </h5>
                    <div class="col-md-8 row">
                        <button type="submit" id="btnguardar" class="btn btn-success col-md-3 btn-guardar"><i class="fas fa-save"></i> Guardar</button>
                        <div id="actualizar" onclick="config.send_post('#formulario', '/administrador/usuarios/update', '/administrador/usuarios');" class="btn btn-warning col-md-3 btn-actualizar"><i class="fas fa-pen-square"></i> Actualizar</div>
                        <div onclick="config.Redirect('/administrador/usuarios');" class="btn btn-danger col-md-3 btn-nuevo"><i class="fas fa-plus-circle"></i> Nuevo</div>
                    </div>                
                </div>
                <div class="panel-body" >
                    <p style="font-size: 10pt;">Diligencie cada uno de los datos relacionados con el usuario a crear.
                    </p>
                </div>
                <input type="hidden" name="id" id="id">
                <div class="row" style="margin-left:1%;">
                    <div class="col-md-3">
                        <label>ncedula</label><input placeholder="ej.(1030570356)" type="text" class="form-control" name="ncedula" id="ncedula" required>
                    </div>
                    <div class="col-md-3">
                        <label>nombres</label><input placeholder="ej.(Alejandro)" type="text" class="form-control" name="nombre" id="nombre" required>
                    </div>
                    <div class="col-md-3">
                        <label>apellidos</label><input placeholder="ej.(Moreno)" type="text" class="form-control" name="apellido" id="apellido" required>
                    </div>
                    <div class="col-md-3">
                        <label>cargo</label><select class="form-control" name="cargo" id="cargo">
                            <option value="Administrador">Administrador</option>
                            <option value="Ventas">Ventas</option>
                            <option value="Inventario">Inventario</option>
                            <option value="Recursos Humanos">Recursos Humanos</option>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="row" style="margin-left:1%;">
                    <div class="col-md-3">
                        <label>teléfono</label><input placeholder="ej.(3219045297)" type="text" class="form-control" name="telefono" id="telefono" required>
                    </div>
                    <div class="col-md-3">
                        <label>contraseña</label><input placeholder="ej.(adminsitracion1234)" type="text" class="form-control" name="password" id="password" required>
                    </div>
                    <div class="col-md-3">
                        <label>correo</label><input type="text" placeholder="ej.(admin@admin.com)" class="form-control" name="correo" id="correo" required>
                    </div>
                    <div class="col-md-3">
                        <label>estado</label><select class="form-control" name="estado" id="estado">
                            <option value="ACTIVO">ACTIVO</option>
                            <option value="INACTIVO">INACTIVO</option>
                            <option value="SUSPENDIDO">SUSPENDIDO</option>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="row" style="margin-left:1%;">
                    <div class="col-md-12">
                        <label>Token</label><input type="text" class="form-control" value="NA" name="token" id="token" required></td>
                    </div>
                </div>
                <hr>
                <div class="row" style="margin-left:1%;">
                    <div class="col-md-3">
                        <label>arl</label><input placeholder="ej.(ARL)" type="text" class="form-control" name="arl" id="arl" required></td>
                    </div>
                    <div class="col-md-3">
                        <label>eps</label><input placeholder="ej.(EPS)" type="text" class="form-control" name="eps" id="eps" required></td>
                    </div>
                    <div class="col-md-3">
                        <label>Cesantias</label><input placeholder="ej.(CESANTIAS)" type="text" class="form-control" name="cesantias" id="cesantias" required></td>
                    </div>
                    <div class="col-md-3">
                        <label>Lista de Precios</label>
                        <select id="pension" name="pension[]" class="form-control" multiple="multiple" >
                            <option value="1">Precios # 1</option>
                            <option value="2">Precios # 2</option>
                            <option value="3">Precios # 3</option>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="row" style="margin-left:1%;">
                    <div class="col-md-3">
                        <label>Caja compensación</label><input placeholder="ej.(Caja compensación)" type="text" class="form-control" name="caja_compensacion" id="caja_compensacion" required>
                    </div>
                    <div class="col-md-3">
                        <label>Contrato</label><select class="form-control" name="id_contrato" id="id_contrato">
                            @foreach ($contratos as $contrato)
                                <option value="{{ $contrato['id'] }}">Contrato No {{ $contrato['id']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <LABEL>teléfono referencia</LABEL><input type="text" class="form-control" name="telefono_referencia" id="telefono_referencia" required>
                    </div>
                    <div class="col-md-3">
                        <label>Nombre referencia</label><input type="text" class="form-control" name="referencia_personal" id="referencia_personal" required>
                    </div>
                </div>
                <hr>
                <div class="row" style="margin-left:1%;padding-bottom:5%;">
                    <div class="col-md-12 content">
                        <br>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
</div>

<script>
$(document).ready(function() {
    usuarios.initial();
    var table = $('#tabla').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
});
</script>


@endsection()