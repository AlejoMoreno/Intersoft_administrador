@extends('layout')

@section('content')


<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="header">
                    <h4 class="title">Administrador</h4>
                    <p class="category">Nota: si deseas subir un csv con la información de la ciudad, debes tener la misma estructura (ID,ID_DEPARTAMENTO,NOMBRE,CODIGO). aquí! <form><input type="file" name="" class="form-control"><br><input type="submit" name="guardar" value="Subir" class="btn btn-success" ></form></p>
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
                    <h4 class="title">Departamentos</h4>
                    <p class="category">Diferentes departamentos de Colombia</p>
                </div>
                <div class="content">
                    <table class="table table-hover table-striped" id="tabledepartamentos">
                        <thead>
                            <tr>
                                <th>ID</th> 
                                <th>Nombre</th> 
                                <th>Código</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($departamentos as $departamento)
                                <tr>
                                    <td>{{ $departamento['id'] }}</td>
                                    <td>{{ $departamento['nombre'] }}</td>
                                    <td>{{ $departamento['codigo'] }}</td>
                                    <!--td><a onclick="config.delete_get('/administrador/departamentos/delete/', '{{  $departamento }}',  '/administrador/departamentos');" href="#"><button class="btn btn-danger">x</button></a></td-->
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $departamentos->links() }}
                    <h4>Crear Departamento</h4>
                    <table class="table table-hover table-striped" id="tabledepartamentos">
                        <thead>
                            <tr>
                                <th>Nombre</th> 
                                <th>Código</th> 
                                <th></th> 
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <form action='/administrador/departamentos/create' method="POST">
                                <td><input type="text" name="nombre" class="form-control"  onkeyup="config.UperCase('nombre');" id="nombre" placeholder="Nombre"></td>
                                <td><input type="number" name="codigo" class="form-control"  onkeyup="config.UperCase('codigo');" id="codigo" placeholder="Código"></td>
                                <td><input type="submit" value="Guardar" id="btnguardar" class="btn btn-success form-control"></td>
                                </form>
                            </tr>
                        </tbody>
                    </table>
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