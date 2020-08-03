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
    <h4 class="title">Cuentas PUC</h4>
</div>

<div class="row top-11-w" style="padding:2%;">

    <div class="panel panel-default col-md-5" >
        <!-- Default panel contents -->
        <div class="panel-heading row"><h5>Vista de puc</h5></div>
        <div class="panel-body" >
            <p style="font-size: 10pt;">A contiuación se describen las cuentas contables que tiene registrada en el sistema.
            </p>
            <div class="content" style="overflow-x: scroll;">
                <table class="table table-hover" id="tabla">
                    <thead>
                        <tr>
                            <th>Tipo</th>
                            <th>Naturaleza</th>
                            <th>Clase</th>
                            <th>Código</th>
                            <th>Descripción</th>
                            <th>Exógena</th>
                            <th>NA</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($auxiliares as $auxiliar)
                        <tr>
                        <td>{{ $auxiliar->tipo }}</td>
                        <td>{{ $auxiliar->naturaleza }}</td>
                        <td>{{ $auxiliar->clase }}</td>
                        <td>{{ $auxiliar->codigo }}</td>
                        <td>{{ $auxiliar->descripcion }}</td>
                        <td>{{ $auxiliar->exogena }}</td>
                        <td>{{ $auxiliar->na }}</td>
                        <td><div class="btn btn-warning" onclick="cuentas.update('{{ $auxiliares }}');"><i class="fas fa-pen-square"></i></div></td>
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
            <form action="/contabilidad/cuentas" method="post">
                <div class="panel-heading row" >
                    <h5 class="col-md-4">Creación de cuenta </h5>
                    <div class="col-md-8 row">
                        <button type="submit" id="btnguardar" class="btn btn-success col-md-3 btn-guardar"><i class="fas fa-save"></i> Guardar</button>
                        <div id="actualizar" onclick="cuentas.sendUpdate();" class="btn btn-warning col-md-3 btn-actualizar"><i class="fas fa-pen-square"></i> Actualizar</div>
                        <div onclick="config.Redirect('/contabilidad/cuentas');" class="btn btn-danger col-md-3 btn-nuevo"><i class="fas fa-plus-circle"></i> Nuevo</div>
                    </div>                
                </div>
                <div class="panel-body" >
                    <p style="font-size: 10pt;">Diligencie cada uno de los datos relacionados con la cuenta a crear.
                    </p>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <input type="hidden" id="id" name="id">
                            <label>Tipo</label>
                            <select type="text" class="form-control" name="tipo" id="tipo">
                            <option value="A">ACTIVO</option>
                            <option value="P">PASIVO</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Naturaleza</label>
                            <select type="text" class="form-control" name="naturaleza" id="naturaleza">
                            <option value="D">DEBITO</option>
                            <option value="C">CREDITO</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Clase</label>
                            <select type="text" class="form-control" name="clase" id="clase">
                            <option value="MIX">MIXTA</option>
                            <option value="NIF">NIF</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label>Sub cuenta</label>
                            <select name="pucsubcuentas"  id="pucsubcuentas" onchange="cuentaContable.changeSubCuentas();" class="form-control">
                            @foreach($pucsubcuentas as $pucsubcuenta)
                            <option value="{{ $pucsubcuenta->id }}">{{ $pucsubcuenta->codigo . '-' . $pucsubcuenta->descripcion }}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label>Codigo</label>
                            <input type="text" list="pucauxiliarcuentas" class="form-control" name="codigo" id="codigo" onchange="cuentaContable.changeAuxiliarCuentas();">
                            <div id="listachange">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label>Descripción</label>
                            <input type="text" class="form-control" name="descripcion" id="descripcion">
                        </div>
                        <div class="col-md-6">
                            <label>Cod. Exogena</label>
                            <select type="text" class="form-control" name="exogena" id="exogena">
                            <option value="1001">1001</option>
                            <option value="1002">1002</option>
                            <option value="1003">1003</option>
                            <option value="1005">1005</option>
                            <option value="1006">1006</option>
                            <option value="1007">1007</option>
                            <option value="1008">1008</option>
                            <option value="1009">1009</option>
                            <option value="1011">1011</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>NA</label>
                            <select type="text" class="form-control" name="na" id="na">
                            <option value="1115">1115</option>
                            <option value="1301">1301</option>
                            <option value="1302">1302</option>
                            <option value="1307">1307</option>
                            <option value="1309">1309</option>
                            <option value="1315">1315</option>
                            <option value="1316">1316</option>
                            <option value="1317">1317</option>
                            <option value="1318">1318</option>
                            <option value="1406">1406</option>
                            <option value="1502">1502</option>
                            <option value="1503">1503</option>
                            <option value="1504">1504</option>
                            <option value="1505">1505</option>
                            <option value="1508">1508</option>
                            <option value="1514">1514</option>
                            <option value="2039">2039</option>
                            <option value="2201">2201</option>
                            <option value="2202">2202</option>
                            <option value="2203">2203</option>
                            <option value="2204">2204</option>
                            <option value="2205">2205</option>
                            <option value="2206">2206</option>
                            <option value="2302">2302</option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>


<div id="data">{{ $auxiliares }}</div>
<script>
$(document).ready(function(){
    cuentaContable.init();
});
</script>

<script>
$(document).ready(function() {
    var table = $('#tabla').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
});
</script>

@endsection()