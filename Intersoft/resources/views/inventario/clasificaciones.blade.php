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
    .pregunta{
        background: black;
        color:white;
        font-size: 10px;
        padding:5px;
        border-radius: 100%;
        cursor: -webkit-grab; 
        cursor: grab;
    }
</style>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<div class="enc-article">
    <h4 class="title">Clasificaciones de los productos</h4>
</div>

<div class="row top-5-w" style="padding:2%;">

    <div class="panel panel-default col-md-5" >
        <!-- Default panel contents -->
        <div class="panel-heading row"><h5>Clasificaciones</h5></div>
        <div class="panel-body" >
            <p style="font-size: 10pt;">A contiuación se muestran en detalle cada una de las Clasificaciones creadas 
                para la empresa, junto con su respectiva parametrización contable.
            </p>
            <div style="overflow-x:scroll;">
                <table class="table table-hover table-striped" id="datos">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>cuenta_contable</th>
                            <th>cuenta_contrapartida</th>
                            <th></th> 
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clasificaciones as $obj)
                            <tr id="row{{ $obj['id'] }}">
                                <td>{{ $obj['id'] }}</td>
                                <td>{{ $obj['nombre'] }}</td>
                                <td>{{ $obj['descripcion'] }}</td>
                                <td>{{ $obj['cuenta_contable']['codigo'] }} - {{ $obj['cuenta_contable']['descripcion'] }}</td>
                                <td>{{ $obj['cuenta_contrapartida']['codigo'] }} - {{ $obj['cuenta_contable']['descripcion'] }}</td>
                                <td><a href="javascript:;" onclick="clasificaciones.update('{{ $obj }}');"><button class="btn btn-warning">></button></a></td>
                                <!--td><a onclick="config.delete_get('/inventario/clasificaciones/delete/', '{{ $obj }}',  '/inventario/clasificaciones');" href="#"><button class="btn btn-danger">x</button></a></td-->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-7 row">
        <div class="panel panel-warning col-md-12" >
            <!-- Default panel contents -->
            <div class="panel-heading row" >
                <h5 class="col-md-12">Formulario Clasificaciones </h5>    
                <p>Para cada una de las Clasificaciones se debe realizar la parametrización contable</p>     
            </div>
            <div class="panel-body" style="overflow-x: scroll">
                <form action='/inventario/clasificaciones/create' method="POST" name="formulario" id="formulario">
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Nombre</label><br>
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Escribe el nombre" required="" onkeyup="config.UperCase('nombre');">
                        </div>
                        <div class="col-md-4">
                            <label>Cuenta Contable Compra</label><br>
                            <select type="text" list="pucauxiliares" class="form-control" name="cuenta_contable" id="cuenta_contable" placeholder="Escribe el codigo interno" required="" onkeyup="config.UperCase('codigo_interno');">
                                @foreach($pucauxiliares as $obj)
                                <option value="{{ $obj->id }}">{{ $obj->codigo.'-'.$obj->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Cuenta Contable Venta</label><br>
                            <select type="text" list="cuenta_contrapartidas" class="form-control" name="cuenta_contrapartida" id="cuenta_contrapartida" placeholder="Escribe el codigo interno" required="" onkeyup="config.UperCase('codigo_interno');">
                                @foreach($pucauxiliares1 as $obj)
                                <option value="{{ $obj->id }}">{{ $obj->codigo.'-'.$obj->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label>Descripción</label><br>
                            <textarea type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Escribe la descrioción de esta clasificación" required="" onkeyup="config.UperCase('descripcion');">NA</textarea>
                        </div>
                    </div>
                    <br><br>

                <input type="submit" value="Guardar" id="btnguardar" class="btn btn-success form-control">
                <div id="actualizar" onclick="config.send_post('#formulario', '/inventario/clasificaciones/update', '/inventario/clasificaciones');" class="btn btn-warning form-control">Actualizar</div>
                </form>
            </div>
        </div>
    </div>

</div>




<script>
    $(document).ready( function () {
        $('#datos').DataTable( {
        } );
        
    } );
</script>


@endsection()