@extends('layout')

@section('content')


<div class="container-fluid">
    <div class="row">

        <div class="col-md-6">
            <div class="card">
                <div class="header">
                    <h4 class="title">Marcas</h4>
                    <p class="category">Diferentes marcas</p><br>
                </div>
                <div class="content">
                    <div style="overflow-x:scroll;overflow-y:scroll;height:500px;">
                        <table class="table table-bordered table-striped" id="datos">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Logo</th>
                                    <th>Código interno</th>
                                    <th>Código alterno</th>
                                    <th></th> 
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($marcas as $obj)
                                    <tr id="row{{ $obj['id'] }}">
                                        <td>{{ $obj['id'] }}</td>
                                        <td>{{ $obj['nombre'] }}</td>
                                        <td>{{ $obj['descripcion'] }}</td>
                                        <td>{{ $obj['logo'] }}</td>
                                        <td>{{ $obj['codigo_interno'] }}</td>
                                        <td>{{ $obj['codigo_alterno'] }}</td>
                                        <td><a href="javascript:;" onclick="marcas.update('{{ $obj }}');"><button class="btn btn-warning">></button></a></td>
                                        <!--td><a onclick="config.delete_get('/inventario/marcas/delete/', '{{ $obj }}',  '/inventario/marcas');" href="#"><button class="btn btn-danger">x</button></a></td-->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                        
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

        <div class="col-md-6">
            <div class="card">
                <div class="header">
                    <h4>crear Marca</h4>
                </div>
                <div class="content">
                    <form action='/inventario/marcas/create' method="POST" name="formulario" id="formulario">
                            <input type="hidden" name="id" id="id">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Nombre</label><br>
                                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Escribe el nombre" required="" onkeyup="config.UperCase('nombre');"  required>
                                </div>
                                <div class="col-md-6">
                                    <label>Descripción</label><br>
                                    <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Escribe el descripcion" onkeyup="config.UperCase('descripcion');" >
                                </div>
                                <div class="col-md-6">
                                    <label>Link logo</label><br>
                                    <input type="text" class="form-control" name="logo" id="logo" placeholder="Escribe el link del logo "  onkeyup="config.UperCase('logo');">
                                </div>
                                <div class="col-md-6">
                                    <label>Código interno</label><br>
                                    <input type="text" class="form-control" name="codigo_interno" id="codigo_interno" placeholder="Escribe el codigo_interno "  onkeyup="config.UperCase('codigo_interno');">
                                </div>
                                <div class="col-md-6">
                                    <label>Código alterno</label><br>
                                    <input type="text" class="form-control" name="codigo_alterno" id="codigo_alterno" placeholder="Escribe el codigo_alterno " onkeyup="config.UperCase('codigo_alterno');">
                                </div>
                                <div class="col-md-6">
                                    <input type="submit" value="Guardar" id="btnguardar" class="btn btn-success form-control">
                                    <div id="actualizar" onclick="config.send_post('#formulario', '/inventario/marcas/update', '/inventario/marcas');" class="btn btn-warning form-control">Actualizar</div>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>

</style>

@endsection()