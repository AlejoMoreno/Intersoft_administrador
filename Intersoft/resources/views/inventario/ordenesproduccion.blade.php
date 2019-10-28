@extends('layout')

@section('content')


<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Ordenes de Producción</h4>
                    <p class="category">Crea fichas técnicas de producción <a href="ordenesproduccion" class="btn btn-success" style="background:white;">Nueva</a></p>
                </div>
                <div class="content">
                    <table class="table table-hover table-striped" id="tableregimenes">
                        <thead>
                            <tr>
                                <th>Código orden</th>
                                <th>Nombre</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ficha as $obj)
                                <tr>
                                    <td>{{ $obj->orden }}</td>
                                    <td>{{ $obj->nombre }}</td>
                                    <?php $url = "?orden=".$obj->orden;  ?>
                                    <td><a href="{{ $url }}" class="btn btn-warning">Actualizar</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <form action='' method="GET" >
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-md-4">Creación orden </div>
                                    <div class="col-md-4">
                                        @if(sizeOf($fichatecnicas) > 0)
                                        <input type="text" name="orden" id="orden" class="col-md-6 form-control" value="{{$fichatecnicas[0]->orden}}" placeholder="# codigo" required >
                                        @endif
                                        @if(sizeOf($fichatecnicas) <= 0)
                                        <input type="text" name="orden" id="orden" class="col-md-6 form-control" value="0" placeholder="# codigo" required disabled>
                                        @endif
                                        
                                    </div>
                                    <div class="col-md-4">
                                        @if(sizeOf($fichatecnicas) > 0)
                                        <input type="text" name="nombre" id="nombre" class="col-md-6 form-control" value="{{$fichatecnicas[0]->nombre}}" placeholder="nombre" required >
                                        @endif
                                        @if(sizeOf($fichatecnicas) <= 0)
                                        <input type="text" name="nombre" id="nombre" class="col-md-6 form-control" value="" placeholder="Nombre" required >
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Referencia</th> 
                                            <th>Cantidad</th>
                                            <th>Estado</th> 
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($fichatecnicas as $obj)
                                        <tr>
                                            <td>{{ $obj->id_referencia->descripcion }}</td>
                                            <td>{{ $obj->cantidad }}</td>
                                            <td>{{ $obj->estado }}</td>
                                            <?php $url = "?id=".$obj->id."&orden=".$obj->orden;  ?>
                                            <td><a href="{{ $url }}" class="btn btn-danger">Eliminar</a></td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td>
                                                <select name="id_referencia" id="id_referencia" class="form-control">
                                                @foreach( $referencias as $ref )
                                                <option value="{{ $ref->id }}">{{ $ref->descripcion }}</option>
                                                @endforeach
                                                </select>    
                                            </td>
                                            <td><input type="number" class="form-control" id="cantidad" name="cantidad" ></td>
                                            <td>
                                                <select name="estado" id="estado" class="form-control">
                                                    <option value="ACTIVO">ACTIVO</option>
                                                    <option value="INACTIVO">INACTIVO</option>
                                                </select>
                                            </td>
                                            <td><input type="submit" class="btn btn-success" name="agregar" id="agregar" value="Agregar"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
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