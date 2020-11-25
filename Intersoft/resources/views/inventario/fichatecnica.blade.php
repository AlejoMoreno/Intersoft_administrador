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
    <h4 class="title">Ficha técnica / Conformar producto Terminado</h4>
</div>

<div class="row top-5-w" style="padding:2%;">
    <p>Crear fichas técnicas o recetas para la formulación de algun nuevo producto creado en la empresa, un ejemplo basico de este 
        es crear una ficha tecnica correspondiente a una canasta familiar, donde puedes poner productos como arroz, leche, entre otros, con el fin de conformar dicho producto nuevo.
        Otro ejemplo es si la empresa ensambla o fabrica mercancia, tipo productos químicos o textiles.
    </p>

    <div class="panel panel-default col-md-5" >
        <!-- Default panel contents -->
        <div class="panel-heading row"><h5>Vista de fichas</h5></div>
        <div class="panel-body" >
            <p style="font-size: 10pt;">A contiuación se describe la lista de fichas existentes en el sistema, aqui usted puede realizar la actualización de cada uno de las fichas con el boton <i style="font-size: 11px;" class="fas fa-pen-square"></i>.<br>
                Además podrá imprimir la ficha identificando cada uno de los productos que lo componen.
            </p>
            <table class="table table-hover table-striped" id="tableregimenes">
                <thead>
                    <tr>
                        <th>Código orden</th>
                        <th>Nombre</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ficha as $obj)
                        <tr>
                            <td>{{ $obj->orden }}</td>
                            <td>{{ $obj->nombre }}</td>
                            <?php $url = "?orden=".$obj->orden;  ?>
                            <?php $url2 = "/pdf/fichatecnica?orden=".$obj->orden;  ?>
                            <td><a href="{{ $url }}" class="btn btn-warning"><i class="fas fa-pen-square"></i></a></td>
                            <td><a href="{{ $url2 }}" class="btn btn-info"><i class="fas fa-print"></i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-md-7 row">
        <div class="panel panel-warning col-md-12" >
            <!-- Default panel contents -->
            <div class="panel-heading row" >
                <h5 class="col-md-8">Creación de ficha técnica </h5>
                <div class="col-md-4 row">
                    <div class="col-md-3"><a href="/inventario/fichatecnica" class="btn btn-danger" style="background:white;"><i class="fas fa-plus-circle"></i> Nuevo </a></div>
                </div>                
            </div>
            <div class="panel-body" >
                <p style="font-size: 10pt;">Diligencie cada uno de los datos relacionados con la ficha a crear, recuerde que el nombre de la ficha debe coincidir con el nombre del producto nuevo.
                </p>
                <form action='/inventario/fichatecnica'' method="POST" >
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-4">Creación ficha </div>
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
                                        <td><a href="{{ $url }}" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td>
                                            <select name="id_referencia" id="id_referencia" class="form-control">
                                            @foreach( $referencias as $ref )
                                            <option value="{{ $ref->id }}">{{ $ref->codigo_interno }} - {{ $ref->descripcion }}</option>
                                            @endforeach
                                            </select>    
                                        </td>
                                        <td><input class="form-control" id="cantidad" name="cantidad" ></td>
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