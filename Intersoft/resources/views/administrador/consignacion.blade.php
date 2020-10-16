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
    <h4 class="title">Consignaciones</h4>
</div>

<div class="row top-5-w" style="padding:2%;">

    <div class="panel panel-default col-md-5" >
        <!-- Default panel contents -->
        <div class="panel-heading row"><h5>Mis consignaciones</h5></div>
        <div class="panel-body" >
            <p style="font-size: 10pt;">A contiuación se muestran en detalle cada uno de las consignaciones creados.
            </p>
            <div style="overflow-x:scroll;">
                <table class="table table-hover table-striped" id="datos">
                    <thead>
                        <tr>
                            <th>Consecutivo</th>
                            <th>Concepto</th>
                            <th>Valor</th>
                            <th>Tipo pago</th>
                            <th>Total</th>
                            <th>Fecha consignacion</th>
                            <th>Banco</th>
                            <th></th> 
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($consignaciones as $obj)
                        <tr>
                            <td>{{ $obj['consecutivo'] }}</td>
                            <td>{{ $obj['concepto'] }}</td>
                            <td>{{ $obj['valor'] }}</td>
                            <td>{{ $obj['id_tipo_pago']['nombre'] }}</td>
                            <td>{{ $obj['total'] }}</td>
                            <td>{{ $obj['fecha_consignacion'] }}</td>
                            <td>{{ $obj['id_banco']['nombre'] }}</td>
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
                <h5 class="col-md-12"> Creación de consignación </h5>    
                <p>Para cada una de la consignación se debe realizar la parametrización contable</p>     
            </div>
            <div class="panel-body" style="overflow-x: scroll">
                <form action='/administrador/consignacion/create' method="POST" name="formulario" id="formulario">
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Consecutivo</label><br>
                            <input type="text" class="form-control" name="consecutivo" id="consecutivo" placeholder="Escribe el consecutivo" required="" onkeyup="config.UperCase('consecutivo');">
                        </div>
                        <div class="col-md-4">
                            <label>Concepto</label><br>
                            <input type="text" class="form-control" name="concepto" id="concepto" placeholder="Escribe el concepto" required="" onkeyup="config.UperCase('concepto');">
                        </div>
                        <div class="col-md-4">
                            <label>Valor</label><br>
                            <input type="text" class="form-control" name="valor" id="valor" placeholder="Escribe el valor" required="" >
                        </div>
                        <div class="col-md-4">
                            <label>Tipo pago</label><br>
                            <select type="text" list="id_tipo_pago" class="form-control" name="id_tipo_pago" id="id_tipo_pago" placeholder="Escribe el id_tipo_pago" required="" onkeyup="config.UperCase('codigo_interno');">
                                @foreach ($tipo_pago as $obj)
                            <option value="{{ $obj['id'] }}">{{ $obj['nombre'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Total</label><br>
                            <input type="number" class="form-control" name="total" id="total" placeholder="Escribe el total" required="" >
                        </div>
                        <div class="col-md-4">
                            <label>Fecha Consignacion</label><br>
                            <input type="date" class="form-control" name="fecha_consignacion" id="fecha_consignacion" placeholder="Escribe el fecha_consignacion" required="" >
                        </div>
                        <div class="col-md-4">
                            <label>Banco </label><br>
                            <select type="text" list="id_banco" class="form-control" name="id_banco" id="id_banco" placeholder="Escribe el id_banco" required="">
                                @foreach ($bancos as $obj)
                            <option value="{{ $obj['id'] }}">{{ $obj['nombre'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br><br>

                <input type="submit" value="Guardar" id="btnguardar" class="btn btn-success form-control">
                <div id="actualizar" onclick="config.send_post('#formulario', '/administrador/consignacion/update', '/administrador/consignacion');" class="btn btn-warning form-control">Actualizar</div>
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