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
                    <h4 class="title">Directorio tipos</h4>
                    <p class="category">Diferentes Directorio tipos</p>
                </div>
                <div class="content">
                    <table class="table table-hover table-striped" id="tableregimenes">
                        <thead>
                            <tr>
                                <th>ID</th> 
                                <th>Nombre</th> 
                                <th>descripción</th> 
                                <th></th> 
                                <th></th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($directorio_tipos as $directorio_tipo)
                                <tr>
                                    <td>{{ $directorio_tipo['id'] }}</td>
                                    <td>{{ $directorio_tipo['nombre'] }}</td>
                                    <td>{{ $directorio_tipo['descripcion'] }}</td>
                                    <td><a href="/administrador/directorio_tipos/update/{{  $directorio_tipo['id'] }}"><button class="btn btn-warning">></button></a></td>
                                    <td><a href="/administrador/directorio_tipos/delete/{{  $directorio_tipo['id'] }}"><button class="btn btn-danger">x</button></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <h4>Crear Directorio tipos</h4>
                    <table class="table table-hover table-striped" id="tabledirectorio_tipos">
                        <thead>
                            <tr>
                                <th>Nombre</th> 
                                <th>descripción</th> 
                                <th></th> 
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <form action='/administrador/directorio_tipos/create' method="POST">
                                <td><input type="text" name="nombre" class="form-control"  onkeyup="config.UperCase('nombre');" id="nombre" placeholder="Nombre"></td>
                                <td><input type="text" name="descripcion" class="form-control"  onkeyup="config.UperCase('descripcion');" id="descripcion" placeholder="Descripción"></td>
                                <td><input type="image" width="30" src="https://image.flaticon.com/icons/svg/148/148764.svg"></td>
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