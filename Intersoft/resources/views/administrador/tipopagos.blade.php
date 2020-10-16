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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<div class="enc-article">
    <h4 class="title">Tipo Pagos</h4>
</div>

<div class="row top-5-w" style="padding:2%;">

    <div class="panel panel-default col-md-5" >
        <!-- Default panel contents -->
        <div class="panel-heading row"><h5>Tipo pago</h5></div>
        <div class="panel-body" >
            <p style="font-size: 10pt;">A contiuación se muestran en detalle cada uno de los tipos de pagos creados.
            </p>
            <div style="overflow-x:scroll;">
                <table class="table table-hover table-striped" id="datos">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre
                            <th>Cuenta Venta</th>
                            <th>Cuenta Compra</th>
                            <th>Nit</th>
                            <th>Razon social</th>
                            <th></th> 
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tipopagos as $obj)
                            <tr id="row{{ $obj['id'] }}">
                                <td>{{ $obj['id'] }}</td>
                                <td>{{ $obj['nombre'] }}</td>
                                <td>{{ $obj['puc_cuenta']['codigo'] }} - {{ $obj['puc_cuenta']['descripcion'] }}</td>
                                <td>{{ $obj['puc_compra']['codigo'] }} - {{ $obj['puc_compra']['descripcion'] }}</td>
                                <td>{{ $obj['tercero']['nit'] }}</td>
                                <td>{{ $obj['tercero']['razon_social'] }}</td>
                                <td><a href="javascript:;" onclick="tipopagos.update('{{ $obj }}');"><button class="btn btn-warning">></button></a></td>
                                <!--td><a onclick="config.delete_get('/inventario/tipo_presentaciones/delete/', '{{ $obj }}',  '/inventario/tipo_presentaciones');" href="#"><button class="btn btn-danger">x</button></a></td-->
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
                <h5 class="col-md-12"> Creación de Tipo banco </h5>    
                <p>Para cada una de los bancos se debe realizar la parametrización contable</p>     
            </div>
            <div class="panel-body" style="overflow-x: scroll">
                <form action='/administrador/tipopagos/create' method="POST" name="formulario" id="formulario">
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Nombre</label><br>
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Escribe el nombre" required="" onkeyup="config.UperCase('nombre');">
                        </div>
                        <div class="col-md-4">
                            <label>Puc Venta</label><br>
                            <select name="puc_cuenta" id="puc_cuenta" class="form-control">
                                @foreach ($cuentas as $obj)
                                <option value="{{ $obj['id'] }}">{{ $obj['codigo'] }} - {{ $obj['descripcion'] }}</option>        
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Puc Compra</label><br>
                            <select name="puc_compra" id="puc_compra" class="form-control">
                                @foreach ($cuentas as $obj)
                                <option value="{{ $obj['id'] }}">{{ $obj['codigo'] }} - {{ $obj['descripcion'] }}</option>        
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Tercero Nit</label><br>
                            <input type="text" list="terceros" class="form-control" name="tercero" id="tercero" placeholder="Escribe la descrioción de esta clasificación" required="" onkeyup="config.UperCase('descripcion');">
                            <datalist  id="terceros">
                                @foreach ($terceros as $obj)
                                <option value="{{ $obj['id'] }}"> {{ $obj['nit'] }} - {{ $obj['razon_social'] }}</option>
                                @endforeach
                            </datalist>
                        </div>
                    </div>


                <input type="submit" value="Guardar" id="btnguardar" class="btn btn-success form-control">
                <div id="actualizar" onclick="config.send_post('#formulario', '/administrador/tipopagos/update', '/administrador/tipopagos');" class="btn btn-warning form-control">Actualizar</div>
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