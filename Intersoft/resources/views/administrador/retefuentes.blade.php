@extends('layout')

@section('content')


<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="header">
                    <h4 class="title">Administrador</h4>
                    <p class="category">Nota: Esta opción solo la puede hacer con clave, puede ser asignada por Wakusoft al momento de realizar la instalación.</p>
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
                    <h4 class="title">Retefuentes</h4>
                    <p class="category">Diferentes retefuente de Colombia</p>
                </div>
                <div class="content">
                    <table class="table table-hover table-striped" id="tableretefuente">
                        <thead>
                            <tr>
                                <th>ID</th> 
                                <th>Nombre</th> 
                                <th>Valor</th> 
                                <th>descripción</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($retefuentes as $retefuente)
                                <tr>
                                    <td>{{ $retefuente['id'] }}</td>
                                    <td>{{ $retefuente['nombre'] }}</td>
                                    <td>{{ $retefuente['valor'] }}</td>
                                    <td>{{ $retefuente['descripcion'] }}</td>
                                    <!--td class="formulario_"><a href="/administrador/retefuentes/delete/{{  $retefuente['id'] }}"><button class="btn btn-danger">x</button></a></td-->
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <p style="color:red;">Ingrese clave de administrador para poder guardar otros registros</p>
                    <input type="password" name="clave_administrador" placeholder="Ingrese clave de administrador para poder guardar otros registros" class="form-control" id="clave" onkeyup="obj.value(this)" autocomplete="off">
                    <div class="formulario_">
                        <h4>Crear Retefuente</h4>
                        <table class="table table-hover table-striped" id="tableretefuente">
                            <thead>
                                <tr>
                                    <th>Nombre</th> 
                                    <th>Valor</th> 
                                    <th>descripción</th> 
                                    <th></th> 
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <form action='/administrador/retefuentes/create' method="POST">
                                    <td><input type="text" name="nombre" class="form-control"  onkeyup="config.UperCase('nombre');" id="nombre" placeholder="Nombre"></td>
                                    <td><input type="number" name="valor" class="form-control"  onkeyup="config.UperCase('valor');" id="valor" placeholder="Valor"></td>
                                    <td><input type="text" name="descripcion" class="form-control"  onkeyup="config.UperCase('descripcion');" id="descripcion" placeholder="Descripción"></td>
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
</div>
<script type="text/javascript">
var obj = new Obj();
obj.initial();
function Obj(){
    this.initial = function(){
        $('.formulario_').hide();
    };
    this.value = function(input){
        if(config.getClave() == input.value){
             console.log('correcto');
             $('.formulario_').show();
        }
    };
}
</script>

@endsection()