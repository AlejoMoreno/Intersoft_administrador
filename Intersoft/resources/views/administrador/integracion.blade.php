
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

    .esperando{
        background: #e2e2e2;
        color: gray;
    }
    .correcto{
        background: #337ab7;
        color: #1dc7ea;
    }
    .incorrecto{
        background: #a94442;
        color: #ff4a55;
    }
</style>
    

<div class="enc-article">
    <h4 class="title">Integrador con Intercon</h4>
</div>

<div class="row top-11-w" style="padding:2%;">


    <div class="panel panel-default col-md-12" >
        <!-- Default panel contents -->
        <div class="panel-heading row"><h5>Integración de Vendedores</h5></div>
        <div class="panel-body" >
            <p style="font-size: 10pt;">Debe subir el archivo plano VENDEDOR.LIS generado por el software INTERCON. 
            </p>
        </div>
        <div class="row" style="padding: 2%;">
            <div class="col-md-10 col-md-offset-1">
                <form method="POST" action="/administrador/integracion/vendedor" accept-charset="UTF-8" enctype="multipart/form-data">
                                          
                    <div class="form-group" >
                      <label class="col-md-4 control-label">Archivo .LIS Intercon</label>
                      <div class="col-md-4">
                        <input type="file" class="form-control" name="file" >
                      </div>
                      <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Validar</button>
                      </div>
                      <div class="col-md-2">
                        <div class="btn btn-primary" id="recorrerVendedor">Recorrer</div>
                      </div>
                    </div>

                </form>
            </div>
            <div class="col-md-12" style="overflow-x: scroll">
                
                @if(isset($vendedores))
                <table class="table" id="vendedor">
                    @foreach ($vendedores as $linea)
                    <tbody>
                        <tr>
                            <td>{{ $linea[0] }}</td>
                            <td>{{ $linea[1] }}</td>
                            <td>{{ $linea[2] }}</td>
                            <td>{{ $linea[3] }}</td>
                            <td>{{ $linea[4] }}</td>
                            <td>Resultado</td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
                @endif
            </div>
        </div>

    </div>

    <div class="panel panel-default col-md-12" >
        <!-- Default panel contents -->
        <div class="panel-heading row"><h5>Integración de Tercero/proveedor/cliente</h5></div>
        <div class="panel-body" >
            <p style="font-size: 10pt;">Debe subir el archivo plano CLIENTE.LIS generado por el software INTERCON, Sin carcareres especiales hay que revisar Ñ ñ y demás caracteres que puedan generar un error. 
                <br>TIPO;IDENTIFICACION;D;NOMBRE O RAZON SOCIAL;DIRECCION;CORREO ELECTRONICO;CIUDAD;NOM CIUDAD;TELEFONO;CELULAR;FINGRESO;F.ULTIMO;RTFTE;REGIM;NIVEL;COD VENDEDOR;NOMBRE VENDEDOR;IND;%;RTIVA;EST;TIPIFICA;CALI;ZONA;CUPO ENDE
            </p>
        </div>
        <div class="row" style="padding: 2%;">
            <div class="col-md-10 col-md-offset-1">
                <form method="POST" action="/administrador/integracion/terceros" accept-charset="UTF-8" enctype="multipart/form-data">
                                          
                    <div class="form-group" >
                      <label class="col-md-4 control-label">Archivo .LIS Intercon</label>
                      <div class="col-md-4">
                        <input type="file" class="form-control" name="file" >
                      </div>
                      <div class="col-md-4">
                        <select name="id_directorio_tipo_tercero" class="form-control"   id="id_directorio_tipo_tercero">
                            <option value="PROVEEDOR">PROVEEDOR</option>
                            <option value="CLIENTE">CLIENTE</option>
                            <option value="TERCERO">TERCERO</option>
                        </select>
                      </div>
                      <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Validar</button>
                      </div>
                      <div class="col-md-2">
                        <div class="btn btn-primary" id="recorrerTercero">Recorrer</div>
                      </div>
                    </div>

                </form>
            </div>
            <div class="col-md-12" style="overflow-x: scroll">
                
                @if(isset($terceros))
                <table class="table" id="terceros">
                    @foreach ($terceros as $linea)
                    <tbody>
                        <tr>
                            <td>{{ $linea[0] }}</td>
                            <td>{{ str_replace('.','',$linea[1]) }}</td>
                            <td>{{ $linea[2] }}</td>
                            <td>{{ $linea[3] }}</td>
                            <td>{{ $linea[4] }}</td>
                            <td>{{ $linea[5] }}</td>
                            <td>{{ $linea[6] }}</td>
                            <td>{{ $linea[7] }}</td>
                            <td>{{ $linea[8] }}</td>
                            <td>{{ $linea[9] }}</td>
                            <td>{{ $linea[10] }}</td>
                            <td>{{ $linea[11] }}</td>
                            <td>{{ $linea[12] }}</td>
                            <td>{{ $linea[13] }}</td>
                            <td>{{ $linea[14] }}</td>
                            <td>{{ $linea[15] }}</td>
                            <td>{{ $linea[16] }}</td>
                            <td>{{ $linea[17] }}</td>
                            <td>{{ $linea[18] }}</td>
                            <td>{{ $linea[19] }}</td>
                            <td>{{ $linea[20] }}</td>
                            <td>{{ $linea[21] }}</td>
                            <td>{{ $linea[22] }}</td>
                            <td>{{ $linea[23] }}</td>
                            <td>{{ $linea[24] }}</td>
                            <td>Resultado</td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
                @endif
            </div>
        </div>

    </div>

    <div class="panel panel-default col-md-12" >
        <!-- Default panel contents -->
        <div class="panel-heading row"><h5>Integración de Facturas</h5></div>
        <div class="panel-body" >
            <p style="font-size: 10pt;">Debe subir el archivo plano FACTURAS.LIS generado por el software INTERCON. 
            </p>
        </div>

        <div class="row" style="padding: 2%;">
            <div class="col-md-10 col-md-offset-1">
                <form method="POST" action="/administrador/integracion/facturacion" accept-charset="UTF-8" enctype="multipart/form-data">
                                          
                    <div class="form-group" >
                      <label class="col-md-4 control-label">Archivo .LIS Intercon</label>
                      <div class="col-md-4">
                        <input type="file" class="form-control" name="file" >
                      </div>
                      <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Validar</button>
                      </div>
                      <div class="col-md-2">
                        <div class="btn btn-primary" id="recorrerFacturas">Recorrer</div>
                      </div>
                    </div>

                </form>
            </div>
            <div class="col-md-12" style="overflow-x: scroll">
                @if(isset($archivo))
                <table class="table" id="mytab1">
                    @foreach ($archivo as $linea)
                    <tbody>
                        <tr>
                            <td>{{ $linea[0] }}</td>
                            <td>{{ $linea[1] }}</td>
                            <td>{{ $linea[2] }}</td>
                            <td>{{ $linea[3] }}</td>
                            <td>{{ $linea[4] }}</td>
                            <td>{{ $linea[5] }}</td>
                            <td>{{ $linea[6] }}</td>
                            <td>{{ $linea[7] }}</td>
                            <td>{{ $linea[8] }}</td>
                            <td>{{ $linea[9] }}</td>
                            <td>{{ $linea[10] }}</td>
                            <td>{{ $linea[11] }}</td>
                            <td>{{ $linea[12] }}</td>
                            <td>{{ $linea[13] }}</td>
                            <td>{{ $linea[14] }}</td>
                            <td>{{ $linea[15] }}</td>
                            <td>{{ $linea[16] }}</td>
                            <td>{{ $linea[17] }}</td>
                            <td>{{ $linea[18] }}</td>
                            <td>{{ $linea[19] }}</td>
                            <td>Resultado</td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
                @endif
            </div>
        </div>
    </div>

    <div class="panel panel-default col-md-12" >
        <!-- Default panel contents -->
        <div class="panel-heading row"><h5>Integración de Kardex Facturas</h5></div>
        <div class="panel-body" >
            <p style="font-size: 10pt;">Debe subir el archivo plano KARDEX.LIS generado por el software INTERCON. 
            </p>
        </div>

        <div class="row" style="padding: 2%;">
            <div class="col-md-10 col-md-offset-1">
                <form method="POST" action="/administrador/integracion/kardex" accept-charset="UTF-8" enctype="multipart/form-data">
                                          
                    <div class="form-group" >
                      <label class="col-md-4 control-label">Archivo .LIS Intercon</label>
                      <div class="col-md-4">
                        <input type="file" class="form-control" name="file" >
                      </div>
                      <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Validar</button>
                      </div>
                      <div class="col-md-2">
                        <div class="btn btn-primary" id="recorrerKardex">Recorrer</div>
                      </div>
                    </div>

                </form>
            </div>
            <div class="col-md-12" style="overflow-x: scroll">
                @if(isset($kardex))
                <table class="table" id="kardex">
                    @foreach ($kardex as $linea)
                    <tbody>
                        <tr>
                            <td>{{ $linea[0] }}</td>
                            <td>{{ $linea[1] }}</td>
                            <td>{{ $linea[2] }}</td>
                            <td>{{ $linea[3] }}</td>
                            <td>{{ $linea[4] }}</td>
                            <td>{{ $linea[5] }}</td>
                            <td>{{ $linea[6] }}</td>
                            <td>{{ $linea[7] }}</td>
                            <td>{{ $linea[8] }}</td>
                            <td>{{ $linea[9] }}</td>
                            <td>{{ $linea[10] }}</td>
                            <td>{{ $linea[11] }}</td>
                            <td>{{ $linea[12] }}</td>
                            <td>{{ $linea[13] }}</td>
                            <td>{{ $linea[14] }}</td>
                            <td>{{ $linea[15] }}</td>
                            <td>{{ $linea[16] }}</td>
                            <td>{{ $linea[17] }}</td>
                            <td>{{ $linea[18] }}</td>
                            <td>{{ $linea[19] }}</td>
                            <td>{{ $linea[20] }}</td>
                            <td>{{ $linea[21] }}</td>
                            <td>{{ $linea[22] }}</td>
                            <td>{{ $linea[23] }}</td>
                            <td>{{ $linea[24] }}</td>
                            <td>{{ $linea[25] }}</td>
                            <td>{{ $linea[26] }}</td>
                            <td>{{ $linea[27] }}</td>
                            <td>{{ $linea[28] }}</td>
                            <td>{{ $linea[29] }}</td>
                            <td>{{ $linea[30] }}</td>
                            <td>{{ $linea[31] }}</td>
                            <td>{{ $linea[32] }}</td>
                            <td>{{ $linea[33] }}</td>
                            <td>Resultado</td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
                @endif
            </div>
        </div>
    </div>


    <div class="panel panel-default col-md-12" >
        <!-- Default panel contents -->
        <div class="panel-heading row"><h5>Integración de carteras</h5></div>
        <div class="panel-body" >
            <p style="font-size: 10pt;">Debe subir el archivo plano CARTERAS.LIS generado por el software INTERCON. 
            </p>
        </div>

        <div class="row" style="padding: 2%;">
            <div class="col-md-10 col-md-offset-1">
                <form method="POST" action="/administrador/integracion/carteras" accept-charset="UTF-8" enctype="multipart/form-data">
                                          
                    <div class="form-group" >
                      <label class="col-md-4 control-label">Archivo .LIS Intercon</label>
                      <div class="col-md-4">
                        <input type="file" class="form-control" name="file" >
                      </div>
                      <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Validar</button>
                      </div>
                      <div class="col-md-2">
                        <div class="btn btn-primary" id="recorrerCarteras">Recorrer</div>
                      </div>
                    </div>

                </form>
            </div>
            <div class="col-md-12" style="overflow-x: scroll">
                @if(isset($carteras))
                <table class="table" id="carteras">
                    @foreach ($carteras as $linea)
                    <tbody>
                        <tr>
                            <td>{{ $linea[0] }}</td>
                            <td>{{ $linea[1] }}</td>
                            <td>{{ $linea[2] }}</td>
                            <td>{{ $linea[3] }}</td>
                            <td>{{ $linea[4] }}</td>
                            <td>{{ $linea[5] }}</td>
                            <td>{{ $linea[6] }}</td>
                            <td>{{ $linea[7] }}</td>
                            <td>{{ $linea[8] }}</td>
                            <td>{{ $linea[9] }}</td>
                            <td>{{ $linea[10] }}</td>
                            <td>{{ $linea[11] }}</td>
                            <td>{{ $linea[12] }}</td>
                            <td>Resultado</td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
                @endif
            </div>
        </div>
    </div>


    <div class="panel panel-default col-md-12" >
        <!-- Default panel contents -->
        <div class="panel-heading row"><h5>Integración de Facturas pagadas / kardexcarteras</h5></div>
        <div class="panel-body" >
            <p style="font-size: 10pt;">Debe subir el archivo plano kardexcarteras.LIS generado por el software INTERCON. 
            </p>
        </div>

        <div class="row" style="padding: 2%;">
            <div class="col-md-10 col-md-offset-1">
                <form method="POST" action="/administrador/integracion/kardexcarteras" accept-charset="UTF-8" enctype="multipart/form-data">
                                          
                    <div class="form-group" >
                      <label class="col-md-4 control-label">Archivo .LIS Intercon</label>
                      <div class="col-md-4">
                        <input type="file" class="form-control" name="file" >
                      </div>
                      <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Validar</button>
                      </div>
                      <div class="col-md-2">
                        <div class="btn btn-primary" id="recorrerKardexcarteras">Recorrer</div>
                      </div>
                    </div>

                </form>
            </div>
            <div class="col-md-12" style="overflow-x: scroll">
                @if(isset($kardexcarteras))
                <table class="table" id="kardexcarteras">
                    @foreach ($kardexcarteras as $linea)
                    <tbody>
                        <tr>
                            <td>{{ $linea[0] }}</td>
                            <td>{{ $linea[1] }}</td>
                            <td>{{ $linea[2] }}</td>
                            <td>{{ $linea[3] }}</td>
                            <td>{{ $linea[4] }}</td>
                            <td>{{ $linea[5] }}</td>
                            <td>{{ $linea[6] }}</td>
                            <td>{{ $linea[7] }}</td>
                            <td>{{ $linea[8] }}</td>
                            <td>{{ $linea[9] }}</td>
                            <td>{{ $linea[10] }}</td>
                            <td>{{ $linea[11] }}</td>
                            <td>{{ $linea[12] }}</td>
                            <td>{{ $linea[13] }}</td>
                            <td>{{ $linea[14] }}</td>
                            <td>{{ $linea[15] }}</td>
                            <td>{{ $linea[16] }}</td>
                            <td>Resultado</td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
                @endif
            </div>
        </div>
    </div>

    <div class="panel panel-default col-md-12" >
        <!-- Default panel contents -->
        <div class="panel-heading row"><h5>Integración de saldos kardex</h5></div>
        <div class="panel-body" >
            <p style="font-size: 10pt;">Debe subir el archivo plano SALDOS.LIS generado por el software INTERCON. 
            </p>
        </div>

        <div class="row" style="padding: 2%;">
            <div class="col-md-10 col-md-offset-1">
                <form method="POST" action="/administrador/integracion/saldos" accept-charset="UTF-8" enctype="multipart/form-data">
                                          
                    <div class="form-group" >
                      <label class="col-md-4 control-label">Archivo .LIS Intercon</label>
                      <div class="col-md-4">
                        <input type="file" class="form-control" name="file" >
                      </div>
                      <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Validar</button>
                      </div>
                      <div class="col-md-2">
                        <div class="btn btn-primary" id="recorrerSaldos">Recorrer</div>
                      </div>
                    </div>

                </form>
            </div>
            <div class="col-md-12" style="overflow-x: scroll">
                @if(isset($saldos))
                <table class="table" id="saldos">
                    @foreach ($saldos as $linea)
                    <tbody>
                        <tr>
                            <td>{{ $linea[0] }}</td>
                            <td>{{ $linea[1] }}</td>
                            <td>{{ $linea[2] }}</td>
                            <td>Resultado</td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
                @endif
            </div>
        </div>
    </div>


    <div class="panel panel-default col-md-12" >
        <!-- Default panel contents -->
        <div class="panel-heading row"><h5>Integración de Contabilidad</h5></div>
        <div class="panel-body" >
            <p style="font-size: 10pt;">Debe subir el archivo plano CONTABILIDAD.DAT generado por el software INTERCON. 
            </p>
        </div>

        <div class="row" style="padding: 2%;">
            <div class="col-md-10 col-md-offset-1">
                <form method="POST" action="/administrador/integracion/contabilidad" accept-charset="UTF-8" enctype="multipart/form-data">
                                          
                    <div class="form-group" >
                      <label class="col-md-4 control-label">Archivo .DAT Intercon</label>
                      <div class="col-md-4">
                        <input type="file" class="form-control" name="file" >
                      </div>
                      <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Validar</button>
                      </div>
                      <div class="col-md-2">
                        <div class="btn btn-primary" id="recorrerContabilidad">Recorrer</div>
                      </div>
                    </div>

                </form>
            </div>
            <div class="col-md-12" style="overflow-x: scroll">
                @if(isset($contabilidad))
                <table class="table" id="contabilidad1">
                    @foreach ($contabilidad as $linea)
                    <tbody>
                        <tr>
                            <td>{{ $linea[0] }}</td>
                            <td>{{ $linea[1] }}</td>
                            <td>{{ $linea[2] }}</td>
                            <td>{{ $linea[3] }}</td>
                            <td>{{ $linea[4] }}</td>
                            <td>{{ $linea[5] }}</td>
                            <td>{{ $linea[6] }}</td>
                            <td>{{ $linea[7] }}</td>
                            <td>{{ $linea[8] }}</td>
                            <td>{{ $linea[9] }}</td>
                            <td>{{ $linea[10] }}</td>
                            <td>{{ $linea[11] }}</td>
                            <td>{{ $linea[12] }}</td>
                            <td>Resultado</td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
                @endif
            </div>
        </div>
    </div>

    <script>
        $('#recorrerFacturas').click(function (){
            var table = document.getElementById("mytab1"); 
            recursivoTablaFactura( table, 1 );
        });

        function recursivoTablaFactura( table, index){
            var row = table.rows[index];
            console.log(index);
            index = index + 1;
            if(index >= table.rows.length + 1){
               return true; 
            }
            else{
                if(row.cells[10].innerHTML==''){
                    row.cells[10].innerHTML = 0;
                }
                parametros = {
                    'numero' : row.cells[2].innerHTML,
                    'prefijo' : row.cells[1].innerHTML,
                    'nit_tercero' : row.cells[5].innerHTML,
                    'nit_vendedor' : row.cells[10].innerHTML,
                    'fecha' : row.cells[3].innerHTML,
                    'fecha_vencimiento' : row.cells[3].innerHTML,
                    'tipo_documento' : row.cells[0].innerHTML,
                    'subtotal' : row.cells[12].innerHTML,
                    'iva' : row.cells[17].innerHTML,
                    'impoconsumo' : 0,
                    'otro_impuesto' : row.cells[14].innerHTML,
                    'otro_impuesto1' : row.cells[15].innerHTML,
                    'descuento' : row.cells[16].innerHTML,
                    'fletes' : 0,
                    'retefuente' : row.cells[13].innerHTML,
                    'estado' : row.cells[4].innerHTML,
                    'saldo' : row.cells[18].innerHTML //valor pagado toca restarlo con el valor total
                }
                $.ajax({
                    data:  parametros,
                    url:   '/administrador/saveFactura',
                    type:  'post',
                    beforeSend: function () {
                        row.classList.add("esperando");
                    },
                    success:  function (response) {
                        row.classList.remove("esperando");
                        if(response.result == "Correcto"){
                            row.classList.add("correcto");
                            row.cells[20].innerHTML = response.body;
                        }
                        else if(response.result == "Existe"){
                            row.classList.add("correcto");
                            row.cells[20].innerHTML = response.body;
                        }
                        else{
                            row.classList.add("incorrecto");
                            row.cells[20].innerHTML = response.body;
                        }
                        console.log("respuesta index: "+index, response);
                        recursivoTablaFactura( document.getElementById("mytab1"), index );
                    },
                    error: function (error) {
                        row.classList.add("incorrecto");
                        row.cells[20].innerHTML = response.body;
                        recursivoTablaFactura( document.getElementById("mytab1"), index );
                    }
                });
            }
        }

        
    </script>

    <script>
        $('#recorrerVendedor').click(function (){
            var table = document.getElementById("vendedor"); 
            recursivoTablaVendedor( table, 0 );
        });

        function recursivoTablaVendedor( table, index){
            var row = table.rows[index];
            console.log(index);
            index = index + 1;
            if(index >= table.rows.length + 1){
            return true; 
            }
            else{
                parametros = {
                    'ncedula': row.cells[0].innerHTML,
                    'nombre': row.cells[1].innerHTML,
                    'apellido': row.cells[1].innerHTML,
                    'cargo': "Ventas",
                    'telefono': row.cells[4].innerHTML,
                    'password': "Temporal123",
                    'correo': "correo@corre.com",
                    'estado': "ACTIVO",
                    'token': "Temporal123",
                    'arl': "NA",
                    'eps': "NA",
                    'cesantias': "NA",
                    'pension': "1,2,3",
                    'caja_compensacion': "NA",
                    'id_contrato': 0,
                    'referencia_personal': row.cells[1].innerHTML,
                    'telefono_referencia': row.cells[4].innerHTML
                }
                $.ajax({
                    data:  parametros,
                    url:   '/administrador/saveVendedor',
                    type:  'post',
                    beforeSend: function () {
                        row.classList.add("esperando");
                    },
                    success:  function (response) {
                        row.classList.remove("esperando");
                        if(response.result == "Correcto"){
                            row.classList.add("correcto");
                            row.cells[5].innerHTML = response.body;
                        }
                        else if(response.result == "Existe"){
                            row.classList.add("correcto");
                            row.cells[5].innerHTML = response.body;
                        }
                        else{
                            row.classList.add("incorrecto");
                            row.cells[5].innerHTML = response.body;
                        }
                        console.log("respuesta index: "+index, response);
                        recursivoTablaVendedor( document.getElementById("vendedor"), index );
                    },
                    error: function (error) {
                        row.classList.add("incorrecto");
                        row.cells[5].innerHTML = response.body;
                        recursivoTablaVendedor( document.getElementById("vendedor"), index );
                    }
                });
            }
        }

        
    </script>

    <script>
        $('#recorrerTercero').click(function (){
            var table = document.getElementById("terceros"); 
            recursivoTablaTercero( table, 1 );
        });

        function recursivoTablaTercero( table, index){
            //console.log(table);
            var row = table.rows[index];
            console.log(index);
            index = index + 1;
            if(index >= table.rows.length + 1){
            return true; 
            }
            else{
                parametros = {
                    'nit': row.cells[1].innerHTML,
                    'digito': row.cells[2].innerHTML,
                    'razon_social': row.cells[3].innerHTML,
                    'direccion': row.cells[4].innerHTML,
                    'correo': row.cells[5].innerHTML,
                    'telefono': row.cells[8].innerHTML,
                    'telefono1': row.cells[9].innerHTML,
                    'telefono2': row.cells[8].innerHTML,
                    'financiacion': 0,
                    'descuento': 0,
                    'cupo_financiero': row.cells[24].innerHTML,
                    'rete_ica': row.cells[18].innerHTML,
                    'porcentaje_rete_iva': 0,
                    'actividad_economica': 0000,
                    'nivel': row.cells[14].innerHTML,
                    'zona_venta': row.cells[23].innerHTML,
                    'estado': row.cells[20].innerHTML,
                    'id_retefuente': row.cells[12].innerHTML,
                    'id_ciudad': row.cells[6].innerHTML,
                    'id_regimen': row.cells[13].innerHTML,
                    'id_usuario': row.cells[15].innerHTML,
                    'id_directorio_tipo_tercero': $('#id_directorio_tipo_tercero').val(),
                    'calificacion': 2,
                    'transporte': "NO",
                    'id_directorio_clase': row.cells[0].innerHTML
                }
                $.ajax({
                    data:  parametros,
                    url:   '/administrador/saveTercero',
                    type:  'post',
                    beforeSend: function () {
                        row.classList.add("esperando");
                    },
                    success:  function (response) {
                        row.classList.remove("esperando");
                        if(response.result == "Correcto"){
                            row.classList.add("correcto");
                            row.cells[25].innerHTML = response.body;
                        }
                        else if(response.result == "Existe"){
                            row.classList.add("correcto");
                            row.cells[25].innerHTML = response.body;
                        }
                        else{
                            row.classList.add("incorrecto");
                            row.cells[25].innerHTML = response.body;
                        }
                        console.log("respuesta index: "+index, response);
                        recursivoTablaTercero( document.getElementById("terceros"), index );
                    },
                    error: function (error) {
                        row.classList.add("incorrecto");
                        row.cells[25].innerHTML = response.body;
                        recursivoTablaTercero( document.getElementById("terceros"), index );
                    }
                });
            }
        }

        
    </script>


    <script>
        $('#recorrerKardex').click(function (){
            var table = document.getElementById("kardex"); 
            recursivoTablaKardex( table, 1 );
        });

        function recursivoTablaKardex( table, index){
            var row = table.rows[index];
            console.log(index);
            index = index + 1;
            if(index >= table.rows.length + 1){
               return true; 
            }
            else{
                if(row.cells[14].innerHTML==""){
                    row.cells[14].innerHTML = 0;
                }
                cantidad = row.cells[9].innerHTML.substr(0, (row.cells[9].innerHTML.length - 2));
                precio = row.cells[10].innerHTML.substr(0, (row.cells[10].innerHTML.length - 2));
                decimalesCantidad = (row.cells[9].innerHTML.substr(row.cells[9].innerHTML.length, -2)!=0)?row.cells[9].innerHTML.substr(row.cells[9].innerHTML.length, -2):'0';
                decimalesPrecio = (row.cells[10].innerHTML.substr(row.cells[10].innerHTML.length, -2)!=0)?row.cells[10].innerHTML.substr(row.cells[10].innerHTML.length, -2):'0';
                parametros = {
                    'nit_tercero' :     row.cells[4].innerHTML,
                    'tipo_documento' :  row.cells[1].innerHTML,
                    'numero' :          row.cells[3].innerHTML,
                    'prefijo' :         row.cells[2].innerHTML,
                    'sucursal' :        row.cells[0].innerHTML,
                    'codigo' :          row.cells[7].innerHTML,
                    'cantidad' :        parseFloat(cantidad + '.' + decimalesCantidad),
                    'precio' :          parseFloat(precio + '.' + decimalesPrecio),
                    'costo' :           row.cells[10].innerHTML,
                    'subtotal' :        (parseFloat(cantidad + '.' + decimalesCantidad) * parseFloat(precio + '.' + decimalesPrecio)),
                    'iva' :             row.cells[14].innerHTML,
                    'reteica' :         row.cells[17].innerHTML,
                    'reteiva' :         row.cells[18].innerHTML,
                    'retefuente' :      row.cells[16].innerHTML,
                    'fecha_vence_lote': row.cells[33].innerHTML,
                    'serie':            row.cells[25].innerHTML,
                }
                console.log(parametros);
                $.ajax({
                    data:  parametros,
                    url:   '/administrador/saveKardex',
                    type:  'post',
                    beforeSend: function () {
                        row.classList.add("esperando");
                    },
                    success:  function (response) {
                        row.classList.remove("esperando");
                        if(response.result == "Correcto"){
                            row.classList.add("correcto");
                            row.cells[34].innerHTML = response.body;
                        }
                        else if(response.result == "Existe"){
                            row.classList.add("correcto");
                            row.cells[34].innerHTML = response.body;
                        }
                        else{
                            row.classList.add("incorrecto");
                            row.cells[34].innerHTML = response.body;
                        }
                        console.log("respuesta index: "+index, response);
                        recursivoTablaKardex( document.getElementById("kardex"), index );
                    },
                    error: function (error) {
                        row.classList.add("incorrecto");
                        row.cells[34].innerHTML = response.body;
                        recursivoTablaKardex( document.getElementById("kardex"), index );
                    }
                });
            }
        }

        
    </script>


    <script>
        $('#recorrerCarteras').click(function (){
            var table = document.getElementById("carteras"); 
            recursivoTablaCarteras( table, 1 );
        });

        function recursivoTablaCarteras( table, index){
            var row = table.rows[index];
            console.log(index);
            index = index + 1;
            if(index >= table.rows.length + 1){
               return true; 
            }
            else{
                parametros = {
                    'numero' : row.cells[3].innerHTML,
                    'prefijo' : row.cells[2].innerHTML,
                    'nit_tercero' : row.cells[5].innerHTML,
                    'tipoCartera' : row.cells[0].innerHTML,
                    'efectivo' : row.cells[8].innerHTML,
                    'fecha' : row.cells[6].innerHTML,
                    'total' : row.cells[7].innerHTML
                }
                $.ajax({
                    data:  parametros,
                    url:   '/administrador/saveCarteras',
                    type:  'post',
                    beforeSend: function () {
                        row.classList.add("esperando");
                    },
                    success:  function (response) {
                        row.classList.remove("esperando");
                        if(response.result == "Correcto"){
                            row.classList.add("correcto");
                            row.cells[13].innerHTML = response.body;
                        }
                        else if(response.result == "Existe"){
                            row.classList.add("correcto");
                            row.cells[13].innerHTML = response.body;
                        }
                        else{
                            row.classList.add("incorrecto");
                            row.cells[13].innerHTML = response.body;
                        }
                        console.log("respuesta index: "+index, response);
                        recursivoTablaCarteras( document.getElementById("carteras"), index );
                    },
                    error: function (error) {
                        row.classList.add("incorrecto");
                        row.cells[13].innerHTML = response.body;
                        recursivoTablaCarteras( document.getElementById("carteras"), index );
                    }
                });
            }
        }

        
    </script>

    <script>
        $('#recorrerKardexcarteras').click(function (){
            var table = document.getElementById("kardexcarteras"); 
            recursivoTablaKardexcarteras( table, 1 );
        });

        function recursivoTablaKardexcarteras( table, index){
            var row = table.rows[index];
            console.log(index);
            index = index + 1;
            if(index >= table.rows.length + 1){
               return true; 
            }
            else{
                parametros = {
                    'nit_tercero' : row.cells[4].innerHTML,
                    'numero' : row.cells[2].innerHTML,
                    'prefijo' : row.cells[1].innerHTML,
                    'tipoCartera' : row.cells[0].innerHTML,
                    'numero_factura' : row.cells[8].innerHTML,
                    'prefijo_factura' : row.cells[7].innerHTML,
                    'tipo_factura' : row.cells[6].innerHTML,
                    'efectivo' : row.cells[9].innerHTML,
                    'descuentos' : row.cells[11].innerHTML,
                    'sobrecostos' : row.cells[14].innerHTML,
                    'retefuente' : row.cells[10].innerHTML,
                    'reteiva' : row.cells[13].innerHTML,
                    'reteica' : row.cells[12].innerHTML
                }
                $.ajax({
                    data:  parametros,
                    url:   '/administrador/saveKardexcarteras',
                    type:  'post',
                    beforeSend: function () {
                        row.classList.add("esperando");
                    },
                    success:  function (response) {
                        row.classList.remove("esperando");
                        if(response.result == "Correcto"){
                            row.classList.add("correcto");
                            row.cells[17].innerHTML = response.body;
                        }
                        else if(response.result == "Existe"){
                            row.classList.add("correcto");
                            row.cells[17].innerHTML = response.body;
                        }
                        else{
                            row.classList.add("incorrecto");
                            row.cells[17].innerHTML = response.body;
                        }
                        console.log("respuesta index: "+index, response);
                        recursivoTablaKardexcarteras( document.getElementById("kardexcarteras"), index );
                    },
                    error: function (error) {
                        row.classList.add("incorrecto");
                        row.cells[17].innerHTML = response.body;
                        recursivoTablaKardexcarteras( document.getElementById("kardexcarteras"), index );
                    }
                });
            }
        }

        
    </script>

    <script>
        $('#recorrerSaldos').click(function (){
            var table = document.getElementById("saldos"); 
            recursivoTablaSaldos( table, 1 );
        });

        function recursivoTablaSaldos( table, index){
            var row = table.rows[index];
            console.log(index);
            index = index + 1;
            if(index >= table.rows.length + 1){
               return true; 
            }
            else{
                parametros = {
                    'codigo' : row.cells[0].innerHTML,
                    'saldo' : row.cells[1].innerHTML,
                    'ultimoCosto' : row.cells[2].innerHTML
                }
                $.ajax({
                    data:  parametros,
                    url:   '/administrador/saveSaldos',
                    type:  'post',
                    beforeSend: function () {
                        row.classList.add("esperando");
                    },
                    success:  function (response) {
                        row.classList.remove("esperando");
                        if(response.result == "Correcto"){
                            row.classList.add("correcto");
                            row.cells[17].innerHTML = response.body;
                        }
                        else if(response.result == "Existe"){
                            row.classList.add("correcto");
                            row.cells[17].innerHTML = response.body;
                        }
                        else{
                            row.classList.add("incorrecto");
                            row.cells[17].innerHTML = response.body;
                        }
                        console.log("respuesta index: "+index, response);
                        recursivoTablaSaldos( document.getElementById("saldos"), index );
                    },
                    error: function (error) {
                        row.classList.add("incorrecto");
                        row.cells[17].innerHTML = response.body;
                        recursivoTablaSaldos( document.getElementById("saldos"), index );
                    }
                });
            }
        }

        
    </script>


<script>
        $('#recorrerContabilidad').click(function (){
            var table = document.getElementById("contabilidad1"); 
            console.log(table);
            recursivoTablaContabilidad( table, 0 );
        });

        function recursivoTablaContabilidad( table, index){
            var row = table.rows[index];
            console.log(index);
            index = index + 1;
            if(index >= table.rows.length + 1){
               return true; 
            }
            parametros = {
                'tipo_documento' : row.cells[0].innerHTML,
                'id_sucursal' : row.cells[1].innerHTML,
                'id_documento' : 0,
                'numero_documento' : row.cells[3].innerHTML,
                'prefijo' : row.cells[2].innerHTML,
                'fecha_documento' : row.cells[4].innerHTML,
                'valor_transaccion' : row.cells[10].innerHTML,
                'tipo_transaccion' : row.cells[11].innerHTML,
                'tercero' : row.cells[6].innerHTML,
                'id_auxiliar' : row.cells[5].innerHTML
            }
            $.ajax({
                data:  parametros,
                url:   '/administrador/saveContabilidad',
                type:  'post',
                beforeSend: function () {
                    row.classList.add("esperando");
                },
                success:  function (response) {
                    row.classList.remove("esperando");
                    if(response.result == "Correcto"){
                        row.classList.add("correcto");
                        row.cells[13].innerHTML = response.body;
                    }
                    else if(response.result == "Existe"){
                        row.classList.add("correcto");
                        row.cells[13].innerHTML = response.body;
                    }
                    else{
                        row.classList.add("incorrecto");
                        row.cells[13].innerHTML = response.body;
                    }
                    console.log("respuesta index: "+index, response);
                    recursivoTablaContabilidad( document.getElementById("contabilidad1"), index );
                },
                error: function (error) {
                    row.classList.add("incorrecto");
                    row.cells[13].innerHTML = response.body;
                    recursivoTablaContabilidad( document.getElementById("contabilidad1"), index );
                }
            });
        }

        
    </script>


    
    
</div>



@endsection()