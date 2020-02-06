@extends('layout')

@section('content')


<div class="container-fluid">
    <div class="row">

    

        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Cuentas (PUC)</h4>
                    <p class="category">PUC</p>
                </div>
                <div class="content" style="height: 300px;overflow-y:scroll;">

                    <table class="table table-hover">
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
                            <td><div class="btn btn-warning">></div></td>
                            <td><div class="btn btn-danger">X</div></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $auxiliares->links() }}
                    
                </div>

                <div class="content" style="overflow-x:scroll;">
                    <h3>Añadir cuenta</h3>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Tipo</th>
                                <th>Naturaleza</th>
                                <th>Clase</th>
                                <th>pucsubcuentas</th>
                                <th>Código</th>
                                <th>Descripción</th>
                                <th>Exógena</th>
                                <th>NA</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <form action="" method="post">
                            <tr>
                                <td>
                                    <select type="text" class="form-control" name="tipo" id="tipo">
                                    <option value="A">ACTIVO</option>
                                    <option value="P">PASIVO</option>
                                    </select>
                                </td>
                                <td>
                                    <select type="text" class="form-control" name="naturaleza" id="naturaleza">
                                    <option value="D">DEBITO</option>
                                    <option value="C">CREDITO</option>
                                    </select>
                                </td>
                                <td>
                                    <select type="text" class="form-control" name="clase" id="clase">
                                    <option value="MIX">MIXTA</option>
                                    <option value="NIF">NIF</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="pucsubcuentas"  id="pucsubcuentas" onchange="cuentaContable.changeSubCuentas();" class="form-control">
                                    @foreach($pucsubcuentas as $pucsubcuenta)
                                    <option value="{{ $pucsubcuenta->id }}">{{ $pucsubcuenta->codigo . '-' . $pucsubcuenta->descripcion }}</option>
                                    @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="text" list="pucauxiliarcuentas" class="form-control" name="codigo" id="codigo" onchange="cuentaContable.changeAuxiliarCuentas();">
                                    <div id="listachange">
                                    </div>
                                </td>
                                <td><input type="text" class="form-control" name="descripcion" id="descripcion"></td>
                                <td>
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
                                </td>
                                <td>
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
                                </td>
                                <td></td>
                                <td><input type="submit" name="guardar" id="guardar" class="btn btn-success" value="+"></td>
                            </tr>
                            </form>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="data">{{ $auxiliares }}</div>
<script>
$(document).ready(function(){
    cuentaContable.init();
});
</script>

@endsection()