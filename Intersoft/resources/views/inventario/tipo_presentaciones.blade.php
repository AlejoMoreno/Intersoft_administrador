@extends('layout')

@section('content')


<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Presentaciones de productos</h4>
                    <p class="category">Diferentes clasificaciones</p><br>
                </div>
                <div class="content">
                    <div style="overflow-x:scroll;overflow-y:scroll;height:500px;">
                        <table class="table table-hover table-striped" id="datos">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre
                                    <th>Descripcion</th>
                                    <th></th> 
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tipo_presentaciones as $obj)
                                    <tr id="row{{ $obj['id'] }}">
                                        <td>{{ $obj['id'] }}</td>
                                        <td>{{ $obj['nombre'] }}</td>
                                        <td>{{ $obj['descripcion'] }}</td>
                                        <td>{{ $obj['id_empresa'] }}</td>
                                        <td><a href="javascript:;" onclick="tipo_presentacion.update('{{ $obj }}');"><button class="btn btn-warning">></button></a></td>
                                        <!--td><a onclick="config.delete_get('/inventario/tipo_presentaciones/delete/', '{{ $obj }}',  '/inventario/tipo_presentaciones');" href="#"><button class="btn btn-danger">x</button></a></td-->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <h4>Crear Presentación</h4>
                    
                        <form action='/inventario/tipo_presentaciones/create' method="POST" name="formulario" id="formulario">
                            <input type="hidden" name="id" id="id">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Nombre</label><br>
                                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Escribe el nombre" required="" onkeyup="config.UperCase('nombre');">
                                </div>
                                <div class="col-md-4">
                                    <label>Descripción</label><br>
                                    <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Escribe la descrioción de esta clasificación" required="" onkeyup="config.UperCase('descripcion');">
                                </div>
                            </div>


                        <input type="submit" value="Guardar" id="btnguardar" class="btn btn-success form-control">
                        <div id="actualizar" onclick="config.send_post('#formulario', '/inventario/tipo_presentaciones/update', '/inventario/tipo_presentaciones');" class="btn btn-warning form-control">Actualizar</div>
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