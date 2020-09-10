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
    <h4 class="title">Creación de cuentas bancarias</h4>
</div>

<div class="row top-5-w" style="padding:2%;">

    <div class="panel panel-default col-md-5" >
        <!-- Default panel contents -->
        <div class="panel-heading row"><h5>Mis bancos</h5></div>
        <div class="panel-body" >
            <p style="font-size: 10pt;">A contiuación se muestran en detalle cada uno de los bancos creados.
            </p>
            <div style="overflow-x:scroll;">
                <table class="table table-hover table-striped" id="datos">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Sucursal</th>
                            <th>Número de cuenta</th>
                            <th>cuenta contable</th>
                            <th>Nit banco</th>
                            <th>Impuesto (%)</th>
                            <th></th> 
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bancos as $obj)
                        <tr>
                            <td>{{ $obj['id'] }}</td>
                            <td>{{ $obj['nombre'] }}</td>
                            <td>{{ $obj['sucursal'] }}</td>
                            <td>{{ $obj['numero_de_cuenta'] }}</td>
                            <td>{{ $obj['cuenta_contable'] }}</td>
                            <td>{{ $obj['nit_banco'] }}</td>
                            <td>{{ $obj['impuesto'] }}</td>
                            <td></td> 
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
                <h5 class="col-md-12"> Creación de banco </h5>    
                <p>Para cada una de los bancos se debe realizar la parametrización contable</p>     
            </div>
            <div class="panel-body" style="overflow-x: scroll">
                <form action='/administrador/bancos/create' method="POST" name="formulario" id="formulario">
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Nombre</label><br>
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Escribe el nombre" required="" onkeyup="config.UperCase('nombre');">
                        </div>
                        <div class="col-md-4">
                            <label>Sucursal</label><br>
                            <input type="text" class="form-control" name="sucursal" id="sucursal" placeholder="Escribe el sucursal" required="" onkeyup="config.UperCase('sucursal');">
                        </div>
                        <div class="col-md-4">
                            <label>Número de cuenta</label><br>
                            <input type="text" class="form-control" name="numero_cuenta" id="numero_cuenta" placeholder="Escribe el numero_cuenta" required="" onkeyup="config.UperCase('numero_cuenta');">
                        </div>
                        <div class="col-md-4">
                            <label>Cuenta Contable</label><br>
                            <select type="text" list="pucauxiliares" class="form-control" name="cuenta_contable" id="cuenta_contable" placeholder="Escribe el codigo interno" required="" onkeyup="config.UperCase('codigo_interno');">
                                @foreach ($pucauxiliares as $obj)
                            <option value="{{ $obj['id'] }}">{{ $obj['codigo'] }} - {{ $obj['descripcion'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Nit Banco</label><br>
                            <input type="text" class="form-control" name="nitbanco" id="nitbanco" placeholder="Escribe el nit banco" required="" onkeyup="config.UperCase('nitbanco');">
                        </div>
                        <div class="col-md-4">
                            <label>Impuesto</label><br>
                            <input type="number" class="form-control" name="impuesto" id="impuesto" placeholder="Escribe el impuesto" required="" onkeyup="config.UperCase('impuesto');">
                        </div>
                        <div class="col-md-4">
                            <label>Consecutivo Cheque </label><br>
                            <input type="number" class="form-control" value="0" name="consecutivo_cheque" id="consecutivo_cheque" placeholder="Escribe el consecutivo_cheque" required="" onkeyup="config.UperCase('consecutivo_cheque');">
                        </div>
                    </div>
                    <br><br>

                <input type="submit" value="Guardar" id="btnguardar" class="btn btn-success form-control">
                <div id="actualizar" onclick="config.send_post('#formulario', '/administrador/bancos/update', '/administrador/bancos');" class="btn btn-warning form-control">Actualizar</div>
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