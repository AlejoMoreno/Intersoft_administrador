
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
            <p style="font-size: 10pt;">Debe subir el archivo plano CLIENTE.LIS generado por el software INTERCON. 
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
                            <option value="CIENTE">CLIENTE</option>
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
                            <td><?php print_r(sizeof($linea)); ?></td>
                            
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
                            row.cells[20].innerHTML = "CARGO";
                        }
                        else if(response.result == "Existe"){
                            row.classList.add("correcto");
                            row.cells[20].innerHTML = "Ya existe";
                        }
                        else{
                            row.classList.add("incorrecto");
                            row.cells[20].innerHTML = "FALLO";
                        }
                        console.log("respuesta index: "+index, response);
                        recursivoTablaFactura( document.getElementById("mytab1"), index );
                    },
                    error: function (error) {
                        row.classList.add("incorrecto");
                        row.cells[20].innerHTML = "FALLO";
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
                            row.cells[5].innerHTML = "CARGO";
                        }
                        else if(response.result == "Existe"){
                            row.classList.add("correcto");
                            row.cells[5].innerHTML = "Ya existe";
                        }
                        else{
                            row.classList.add("incorrecto");
                            row.cells[5].innerHTML = "FALLO";
                        }
                        console.log("respuesta index: "+index, response);
                        recursivoTablaVendedor( document.getElementById("vendedor"), index );
                    },
                    error: function (error) {
                        row.classList.add("incorrecto");
                        row.cells[5].innerHTML = "FALLO";
                        recursivoTablaVendedor( document.getElementById("vendedor"), index );
                    }
                });
            }
        }

        
    </script>

<script>
    $('#recorrerTercero').click(function (){
        var table = document.getElementById("tercero"); 
        recursivoTablaTercero( table, 0 );
    });

    function recursivoTablaTercero( table, index){
        var row = table.rows[index];
        console.log(index);
        index = index + 1;
        if(index >= table.rows.length + 1){
        return true; 
        }
        else{
            parametros = {
                'ncedula': row.cells[0].innerHTML,
                'id_directorio_tipo_tercero': $('#id_directorio_tipo_tercero').val()
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
                        row.cells[5].innerHTML = "CARGO";
                    }
                    else if(response.result == "Existe"){
                        row.classList.add("correcto");
                        row.cells[5].innerHTML = "Ya existe";
                    }
                    else{
                        row.classList.add("incorrecto");
                        row.cells[5].innerHTML = "FALLO";
                    }
                    console.log("respuesta index: "+index, response);
                    recursivoTablaTercero( document.getElementById("tercero"), index );
                },
                error: function (error) {
                    row.classList.add("incorrecto");
                    row.cells[5].innerHTML = "FALLO";
                    recursivoTablaTercero( document.getElementById("tercero"), index );
                }
            });
        }
    }

    
</script>


    
    
</div>



@endsection()