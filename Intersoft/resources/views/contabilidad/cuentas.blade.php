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

    
    <div class="col-md-12 row">
        <div class="panel panel-warning col-md-12" >
            <!-- Default panel contents -->
            <form action="/contabilidad/cuentas" method="post">
                <div class="panel-heading row" >
                    <h5 class="col-md-4">Creación de cuenta (PUC) </h5>
                    <div class="col-md-8 row">
                        <button type="submit" id="btnguardar" class="btn btn-success col-md-3 btn-guardar"><i class="fas fa-save"></i> Guardar</button>
                        <div id="actualizar" onclick="cuentaContable.sendUpdate();" class="btn btn-warning col-md-3 btn-actualizar"><i class="fas fa-pen-square"></i> Actualizar</div>
                        <div onclick="config.Redirect('/contabilidad/cuentas');" class="btn btn-danger col-md-3 btn-nuevo"><i class="fas fa-plus-circle"></i> Nuevo</div>
                    </div>                
                </div>
                <div class="panel-body" >
                    <p style="font-size: 10pt;">Diligencie cada uno de los datos relacionados con la cuenta a crear.
                    </p>
                    
                    <div class="row">
                        <div class="col-md-9">
                            <label>Codigo Clase</label>
                            <input type="text" maxlength="1" class="form-control" name="pucclase" id="pucclase">
                        </div>
                        <label id="descripcion_clase" class="col-md-3"></label>

                        <div class="col-md-9">
                            <label>Codigo Grupo</label>
                            <input type="text" maxlength="2" class="form-control" name="pucgrupo" id="pucgrupo">
                        </div>
                        <label id="descripcion_grupo" class="col-md-3"></label>

                        <div class="col-md-9">
                            <label>Codigo Cuentas</label>
                            <input type="text" maxlength="4" class="form-control" name="puccuenta" id="puccuenta">
                        </div>
                        <label id="descripcion_cuenta" class="col-md-3"></label>

                        <div class="col-md-9">
                            <label>Codigo SubCuentas</label>
                            <input type="text" maxlength="6" class="form-control" name="pucsubcuenta" id="pucsubcuenta">
                        </div>
                        <label id="descripcion_subcuenta" class="col-md-3"></label>

                        <div class="col-md-9">
                            <label>Codigo Auxiliar</label>
                            <input type="text" maxlength="8" class="form-control" name="pucauxiliar" id="pucauxiliar">
                        </div>
                        <label id="descripcion_auxiliar" class="col-md-3"></label>
                        <input type="hidden" id="codigo" name="codigo">
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
                                <option value="NA">NA</option>
                                <option value="MIX">MIXTA</option>
                                <option value="NIF">NIF</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label>Descripción</label>
                            <input type="text" class="form-control" name="descripcion" id="descripcion">
                        </div>
                        <div class="col-md-6">
                            <label>Cod. Exogena</label>
                            <select type="text" class="form-control" name="exogena" id="exogena">
                                <option value="NA">NA</option>
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
                                <option value="NA">NA</option>
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

$('#pucclase').on('keydown', function(e) {
    if (e.key === "Enter") {
        pucclase = document.getElementById('pucclase');
        console.log(pucclase.value);
        $('#codigo').val(pucclase.value);
        parametros = {
            "codigo" : pucclase.value
        };
        $.ajax({
            data:  parametros,
            url:   '/contabilidad/buscarCodigo',
            type:  'post',
            success:  function (response) {
                if(response.result == "fail"){
                    $('#descripcion_clase').html("<br><br>No existe");
                    $('#descripcion_clase').css("color","red");
                    $('#pucauxiliar').prop('disabled', true);
                    $('#pucsubcuenta').prop('disabled', true);
                    $('#puccuenta').prop('disabled', true);
                    $('#pucgrupo').prop('disabled', true);
                    $('#pucauxiliar').val('');
                    $('#pucsubcuenta').val('');
                    $('#puccuenta').val('');
                    $('#pucgrupo').val('');
                    $('#descripcion').val('');
                    $('#pucgrupo').val('');
                    $('#pucclase').focus();
                }
                else{
                    puc = response.puc;
                    $('#descripcion_clase').html("<br><br>"+puc.descripcion);
                    $('#descripcion_clase').css("color","black");
                    $('#pucauxiliar').prop('disabled', false);
                    $('#pucsubcuenta').prop('disabled', false);
                    $('#puccuenta').prop('disabled', false);
                    $('#pucgrupo').prop('disabled', false);
                    $('#descripcion').val(puc.descripcion);
                    $('#pucgrupo').val(puc.codigo);
                    $('#pucgrupo').focus();
                }
            }
        });
        return false;
    }
});


$('#pucgrupo').on('keydown', function(e) {
    if (e.key === "Enter") {
        pucgrupo = document.getElementById('pucgrupo');
        console.log(pucgrupo.value);
        $('#codigo').val(pucgrupo.value);
        parametros = {
            "codigo" : pucgrupo.value
        };
        $.ajax({
            data:  parametros,
            url:   '/contabilidad/buscarCodigo',
            type:  'post',
            success:  function (response) {
                if(response.result == "fail"){
                    $('#descripcion_grupo').html("<br><br>No existe");
                    $('#descripcion_grupo').css("color","red");
                    $('#pucauxiliar').prop('disabled', true);
                    $('#pucsubcuenta').prop('disabled', true);
                    $('#puccuenta').prop('disabled', true);
                    $('#pucauxiliar').val('');
                    $('#pucsubcuenta').val('');
                    $('#puccuenta').val('');
                    $('#descripcion').val('');
                    $('#puccuenta').val('');
                    $('#pucgrupo').focus();
                }
                else{
                    puc = response.puc;
                    $('#descripcion_grupo').html("<br><br>"+puc.descripcion);
                    $('#descripcion_grupo').css("color","black");
                    $('#pucauxiliar').prop('disabled', false);
                    $('#pucsubcuenta').prop('disabled', false);
                    $('#puccuenta').prop('disabled', false);
                    $('#descripcion').val(puc.descripcion);
                    $('#puccuenta').val(puc.codigo);
                    $('#puccuenta').focus();
                }
            }
        });
        return false;
    }
});

$('#puccuenta').on('keydown', function(e) {
    if (e.key === "Enter") {
        puccuenta = document.getElementById('puccuenta');
        console.log(puccuenta.value);
        $('#codigo').val(puccuenta.value);
        parametros = {
            "codigo" : puccuenta.value
        };
        $.ajax({
            data:  parametros,
            url:   '/contabilidad/buscarCodigo',
            type:  'post',
            success:  function (response) {
                if(response.result == "fail"){
                    $('#descripcion_cuenta').html("<br><br>No existe");
                    $('#descripcion_cuenta').css("color","red");
                    $('#pucauxiliar').prop('disabled', true);
                    $('#pucsubcuenta').prop('disabled', true);
                    $('#pucauxiliar').val('');
                    $('#pucsubcuenta').val('');
                    $('#descripcion').val('');
                    $('#pucsubcuenta').val('');
                    $('#puccuenta').focus();
                }
                else{
                    puc = response.puc;
                    $('#descripcion_cuenta').html("<br><br>"+puc.descripcion);
                    $('#descripcion_cuenta').css("color","black");
                    $('#pucauxiliar').prop('disabled', false);
                    $('#pucsubcuenta').prop('disabled', false);
                    $('#descripcion').val(puc.descripcion);
                    $('#pucsubcuenta').val(puc.codigo);
                    $('#pucsubcuenta').focus();
                }
            }
        });
        return false;
    }
});

$('#pucsubcuenta').on('keydown', function(e) {
    if (e.key === "Enter") {
        pucsubcuenta = document.getElementById('pucsubcuenta');
        console.log(pucsubcuenta.value);
        $('#codigo').val(pucsubcuenta.value);
        parametros = {
            "codigo" : pucsubcuenta.value
        };
        $.ajax({
            data:  parametros,
            url:   '/contabilidad/buscarCodigo',
            type:  'post',
            success:  function (response) {
                if(response.result == "fail"){
                    $('#descripcion_subcuenta').html("<br><br>No existe");
                    $('#descripcion_subcuenta').css("color","red");
                    $('#pucauxiliar').prop('disabled', true);
                    $('#pucauxiliar').val('');
                    $('#descripcion').val('');
                    $('#pucauxiliar').val('');
                    $('#pucsubcuenta').focus();
                }
                else{
                    puc = response.puc;
                    $('#descripcion_subcuenta').html("<br><br>"+puc.descripcion);
                    $('#descripcion_subcuenta').css("color","black");
                    $('#pucauxiliar').prop('disabled', false);
                    $('#descripcion').val(puc.descripcion);
                    $('#pucauxiliar').val(puc.codigo);
                    $('#pucauxiliar').focus();
                }
            }
        });
        return false;
    }
});

$('#pucauxiliar').on('keydown', function(e) {
    if (e.key === "Enter") {
        pucauxiliar = document.getElementById('pucauxiliar');
        console.log(pucauxiliar.value);
        $('#codigo').val(pucauxiliar.value);
        parametros = {
            "codigo" : pucauxiliar.value
        };
        $.ajax({
            data:  parametros,
            url:   '/contabilidad/buscarCodigo',
            type:  'post',
            success:  function (response) {
                if(response.result == "fail"){
                    $('#descripcion_auxiliar').html("<br><br>No existe");
                    $('#descripcion_auxiliar').css("color","red");
                    $('#descripcion').val('');
                }
                else{
                    puc = response.puc;
                    $('#descripcion_auxiliar').html("<br><br>"+puc.descripcion);
                    $('#descripcion_auxiliar').css("color","black");
                    $('#descripcion').val(puc.descripcion);
                    //treer datos
                    $('#tipo').val(puc.tipo);
                    $('#naturaleza').val(puc.naturaleza);
                    $('#clase').val(puc.clase);
                    $('#exogena').val(puc.exogena);
                    $('#na').val(puc.na);   
                }
            }
        });
        return false;
    }
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