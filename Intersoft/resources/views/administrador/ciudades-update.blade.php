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
                    <h4 class="title">Ciudades</h4>
                    <p class="category">Diferentes Ciudades de Colombia</p>
                </div>
                <div class="content">
                    
                    <h4>Actualizar Ciudad</h4>
                    <table class="table table-hover table-striped" id="tableciudades">
                        <thead>
                            <tr>
                                <th>Departamento</th>
                                <th>Nombre</th>                                 
                                <th>Código</th> 
                                <th></th> 
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <form action='/administrador/ciudades/update' method="POST">
                                <input type="hidden" name="id" value="{{ $ciudad['id'] }}">
                                <td><select name="id_departamento" class="form-control"  value="{{ $ciudad['id_departamento'] }}" id="id_departamento"><option value="">Seleccione Departamento</option></select></td>
                                <td><input type="text" name="nombre" class="form-control" value="{{ $ciudad['nombre'] }}"  onkeyup="config.UperCase('nombre');" id="nombre" placeholder="Nombre"></td>                                
                                <td><input type="number" name="codigo" class="form-control" value="{{ $ciudad['codigo'] }}"  onkeyup="config.UperCase('codigo');" id="codigo" placeholder="Código"></td>
                                <td><input type="submit" class="btn btn-warning" value=">"></td>
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
                            <i class="pe-7s-angle-left-circle"></i> <a href="#" onclick="config.Redirect('/administrador/ciudades');"> ir atras.</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection()