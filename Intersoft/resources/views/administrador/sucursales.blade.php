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
                    <h4 class="title">Sucursales</h4>
                    <p class="category">Diferentes Sucursales</p><br>
                    <a href="/download/excel/sucursales"><img width="50" src="https://image.flaticon.com/icons/svg/179/179383.svg" alt="Descargar Todo" title="Descargar todo"></a>
                    <a href="/download/excel/sucursales"><img width="50" src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/86/Microsoft_Excel_2013_logo.svg/2000px-Microsoft_Excel_2013_logo.svg.png" alt="Descargar parcial xls" title="Descargar parcial xls"></a>
                    <a href="/download/pdf/sucursales"><img width="50" src="https://image.flaticon.com/icons/svg/337/337946.svg" alt="Descargar parcial pdf" title="Descargar parcial pdf"></a>
                </div>
                <div class="content">
                    <div style="overflow-x:scroll;overflow-y:scroll;height:500px;">
                        <table class="table table-hover table-striped" id="datos">
                            <thead>
                                <tr>
                                    <th>ID</th> 
                                    <th>Nombre</th> 
                                    <th>Código</th>
                                    <th>dirección</th>
                                    <th>encargado</th>
                                    <th>telefono</th>
                                    <th>correo</th>
                                    <th>ciudad</th> 
                                    <th></th> 
                                    <th></th> 
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sucursales as $sucursal)
                                    <tr id="row{{ $sucursal['id'] }}">
                                        <td>{{ $sucursal['id'] }}</td>
                                        <td>{{ $sucursal['nombre'] }}</td>
                                        <td>{{ $sucursal['codigo'] }}</td>
                                        <td>{{ $sucursal['direccion'] }}</td>
                                        <td>{{ $sucursal['encargado'] }}</td>
                                        <td>{{ $sucursal['telefono'] }}</td>
                                        <td>{{ $sucursal['correo'] }}</td>
                                        <td>{{ $sucursal['ciudad']['nombre'] }}</td>
                                        <td><a href="javascript:;" onclick="sucursal.update('{{ $sucursal }}');"><button class="btn btn-warning">></button></a></td>
                                        <td><a href="/administrador/sucursales/delete/{{  $sucursal['id'] }}"><button class="btn btn-danger">x</button></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <h4>Crear sucursales clases</h4>
                    <table class="table table-hover table-striped" id="tabledirectorio_clases">
                        <thead>
                            <tr>
                                <th>Nombre</th> 
                                <th>Código</th>
                                <th>dirección</th>
                                <th>encargado</th>
                                <th>telefono</th>
                                <th>correo</th>
                                <th>ciudad</th> 
                                <th></th> 
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <form action='/administrador/sucursales/create' method="POST">
                                <td><input type="text" name="nombre" class="form-control"  onkeyup="config.UperCase('nombre');" id="nombre" placeholder="Nombre" required></td>
                                <td><input type="text" name="codigo" class="form-control"  onkeyup="config.UperCase('codigo');" id="codigo" placeholder="Código" required></td>
                                <td><input type="text" name="direccion" class="form-control"  onkeyup="config.UperCase('direccion');" id="direccion" placeholder="Dirección" required></td>
                                <td><input type="text" name="encargado" class="form-control"  onkeyup="config.UperCase('encargado');" id="encargado" placeholder="Encargado" required></td>
                                <td><input type="number" name="telefono" class="form-control"  onkeyup="config.UperCase('telefono');" id="telefono" placeholder="Teléfono" required></td>
                                <td><input type="email" name="correo" class="form-control"  onkeyup="config.UperCase('correo');" id="correo" placeholder="Correo" required></td>
                                <td><select name="ciudad" class="form-control"  onkeyup="config.UperCase('ciudad');" id="ciudad" placeholder="Ciudad" required>
                                    <option value="">SELECCIONE CIUDAD</option>
                                    @foreach( $ciudades as $ciudad )
                                    <option value="{{ $ciudad['id'] }}">{{ $ciudad['nombre'] }}</option>
                                    @endforeach
                                </select></td>
                                <td><input type="hidden" name="id_empresa" class="form-control" value="{{ $empresas['id'] }}"  onkeyup="config.UperCase('id_empresa');" id="id_empresa" placeholder="id_empresa"></td>
                                <td><input type="submit" value="Guardar" id="btnguardar" class="btn btn-success form-control"></td>
                                <td><button id="actualizar" onclick="sucursal.sendUpdate();" class="btn btn-warning form-control">Actualizar</button></td>
                                </form>
                            </tr>
                        </tbody>
                    </table>
                    <div id="resultado"></div>
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

<style>
a img{
    margin:20px;
}
</style>

@endsection()