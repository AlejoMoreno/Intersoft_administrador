@extends('layout')

@section('content')


<div class="container-fluid">
    <div class="row">
        
        <div class="col-md-4">
            <div class="card">
                <div class="header">
                    <h4 class="title">Usuarios</h4>
                    <p class="category">Elige el usuario a consultar</p>
                </div>
                <div class="content">
                    <div class="row">
                        
                        @foreach($usuarios as $obj)
                        <div class="col-md-12">
                            <div class="btn-success" style="padding:3%;color:white;" onclick="verUsuarioZonas({{ $obj['id'] }})">
                                {{ $obj['ncedula'] }} / {{ $obj['correo'] }}
                            </div>
                        </div>
                        @endforeach
                        
                    </div>
                    <div class="footer">
                        <div class="legend">
                            <i class="fa fa-circle text-info"></i> 
                            <i class="fa fa-circle text-danger"></i> 
                            <i class="fa fa-circle text-warning"></i>
                        </div>
                        <hr>
                        <div class="stats">
                            <i class="pe-7s-angle-left-circle"></i> <a href="#" onclick="config.Redirect('/submenu/facturacion');"> ir atras.</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-8">
            <div class="card">
                <div class="header">
                    <h4 class="title">Zonas</h4>
                    <p class="category">Elige la zona para usuario {{ $id }}</p>
                </div>
                <div class="content">
                    <div style="overflow-x:scroll;overflow-y:scroll;height:300px;">
                        <table class="table table-hover table-striped" id="datos">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Usuario</th>
                                    <th>Cliente</th>
                                    <th>Direccion</th>
                                    <th>Zona</th>
                                    <th>Telefono</th>
                                    <th>Documentos</th>
                                    <th>Desasingar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($zona!=null)
                                    @foreach($zona as $obj)
                                    <tr>
                                        <td>{{ $obj['id'] }}</td>
                                        <td>{{ $obj['id_usuario']['ncedula'] }} - {{ $obj['id_usuario']['correo'] }}</td>
                                        <td>{{ $obj['id_tercero']['nit'] }} - {{ $obj['id_tercero']['razon_social'] }}</td>
                                        <td>{{ $obj['id_tercero']['direccion'] }}</td>
                                        <td>{{ $obj['zona'] }}</td>
                                        <td>{{ $obj['id_tercero']['telefono'] }} - {{ $obj['id_tercero']['telefono1'] }} - {{ $obj['id_tercero']['telefono2'] }}</td>
                                        <td>{{ $obj['id_tercero']['id'] }}</td>
                                        <td><a href="/facturacion/zonadelete/{{ $obj['id'] }}" class="btn btn-danger">x</a></td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="row"><br><br></div>
                    <div class="row">

                        <form action="/facturacion/zonacreate" method="post">

                            <div class="col-md-4">
                                <input type="hidden" id="id_usuario" name="id_usuario" value="{{ $id }}">
                                <select id="id_tercero" class="form-control" name="id_tercero">
                                    <option value="">Seleccione Cliente</option>
                                    @foreach($directorios as $obj)
                                        <option value="{{ $obj['id'] }}">{{ $obj['nit'] }} - {{ $obj['razon_social'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select id="zona" class="form-control" name="zona">
                                    <option value="">Seleccione Zona</option>
                                    @foreach($directorios as $obj)
                                        <option value="{{ $obj['zona_venta'] }}">{{ $obj['contador'] }} - {{ $obj['zona_venta'] }}</option>
                                    @endforeach
                                </select> 
                            </div>
                            <div class="col-md-4">
                                <input type="submit" id="boton_asignar" class="btn btn-success form-control" value="Asignar">
                            </div>

                        </form>
                        
                    </div>
                    <div class="footer">
                        <div class="legend">
                            <i class="fa fa-circle text-info"></i> 
                            <i class="fa fa-circle text-danger"></i> 
                            <i class="fa fa-circle text-warning"></i>
                        </div>
                        <hr>
                        <div class="stats">
                            <i class="pe-7s-angle-left-circle"></i> <a href="#" onclick="config.Redirect('/submenu/facturacion');"> ir atras.</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>

</script>

@endsection()

