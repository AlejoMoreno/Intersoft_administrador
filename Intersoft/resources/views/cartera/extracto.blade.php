@extends('layout')

@section('content')


<style>
span{
    color: black;
    font-size: 10pt;
    text-align: right;
}
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
.table > tbody td{
    color: black;
}
</style>

<div class="enc-article">
    <h4 class="title">Extracto</h4>
</div>

<div class="row top-11-w">
    <div class="card" style="margin:3%;">
        <div class="header row" style="background:white">
            <div class="col-md-4">
                <label>Nit:</label>
                <input type="hidden" name="id_cliente" value="<?php echo (isset($docs[0]->cliente->id ))?$docs[0]->cliente->id :""; ?>" id="id_cliente">
                <input type="text" name="cedula_tercero" value="<?php echo (isset($docs[0]->cliente->nit ))?$docs[0]->cliente->nit :""; ?>"  id="cedula_tercero" placeholder="nit" class="form-control" onchange="buscarcliente(this.value)">
                <p style="font-size:10px;color:black;"  id="resCliente">Para buscar el cliente debe tener un minimo de 3 caracteres</p>                
            </div>
            <div class="col-md-4">
                <label>Razón Social:</label>
                <input type="text" name="nombre" list="listaclientes"  id="nombre" placeholder="Razón Social" class="form-control" onchange="buscarcliente2(this.value)" >
                <datalist id="listaclientes"></datalist>
            </div>
            <div class="col-md-4">
                <label>Fecha Corte:</label>
                <input type="date" name="fecha_corte" value="<?php echo (isset($fecha))?$fecha:""; ?>"  id="fecha_corte" placeholder="Fecha corte" class="form-control" >
            </div>

            <div class="col-md-4"><br>
                <button onclick="ir()" class="btn btn-success">Consultar</button>
            </div>
            
            <div class="col-md-11" style="overflow-x:scroll;margin-left:2%">
                <h2>{{ $docs[0]->cliente->nit }} {{ $docs[0]->cliente->razon_social }}</h2>
                <table class="table table-hover table-striped"  id="datos">
                    <thead>
                        <th>TIPO DOC</th>
                        <th>DOCUMENTO</th>
                        <th>TOTAL</th>
                        <th>TIPO CARTERA</th>
                        <th>CARTERA</th>
                        <th>CARTERA PAGO</th>
                        <th>SALDO</th>
                    </tr></thead>
                    <tbody>
                        <?php
                        $total = 0; 
                        for($i=0;$i<=sizeof($docs)-1;$i++){
                            $obj = $docs[$i];
                            if($obj->id_documento->nombre == "VENTA" || $obj->id_documento->nombre == "MAYORISTA"){
                                $total = $total + $obj->total; 
                            }
                            else if($obj->id_documento->nombre == "COMPRA"){
                                $total = $total - $obj->total ; 
                            }
                            else{
                                $total = $total;
                            }

                            if($obj->totalkardexcartera != null){
                                if($obj->tipoCartera == "INGRESO"){
                                    $total = $total - $obj->totalkardexcartera; 
                                }
                                if($obj->tipoCartera == "EGRESO"){
                                    $total = $total + $obj->totalkardexcartera; 
                                }
                                else{
                                    $total = $total;
                                }
                            }
                            else{
                                $total = $total;
                            }
                            
                        ?>
                        <tr>
                            <td>{{ $obj->id_documento->nombre }}</td>
                            <td>{{ $obj->fprefijo }} {{ $obj->fnumero }}</td>
                            <td>{{ $obj->total }}</td>
                            <td>{{ $obj->tipoCartera }}</td>
                            <td>{{ $obj->cprefijo }} {{ $obj->cnumero }}</td>
                            <td>{{ $obj->totalkardexcartera }}</td>
                            <td>{{ $total }}</td>
                        </tr>
                        <?php } ?>               
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</div>


<script>

function ir(){
    config.Redirect('/cartera/extracto/'+$('#id_cliente').val()+'/'+$('#fecha_corte').val());
}

$('#cedula_tercero').on('keydown', function(e) {
    if (e.key === "Enter") {
        buscarcliente($('#cedula_tercero').val());
        return false;
    }
});

$('#nombre').on('keydown', function(e) {
    if (e.key === "Enter") {
        buscarcliente2($('#nombre').val());
        return false;
    }
});

function buscarcliente(texto){
    console.log(texto);
    if(texto.length > 3){
        var urls = "/administrador/diretorios/search/search";
        if($('#nombre').val()==""){
            parametros = {
                "nit" : texto.trim()
            };
        }
        else{
            parametros = {
                "razon_social" : $('#nombre').val()
            };
        }
        $.ajax({
            data:  parametros,
            url:   urls,
            type:  'post',
            beforeSend: function () {
                $('#resultado').html('<p>Espere porfavor</p>');
            },
            success:  function (response) {
                console.log(response);
                if(response.body.length != 0){ // existe
                    cliente = response.body[0];
                    $('#id_cliente').val(cliente.id);
                    $('#cedula_tercero').val(cliente.nit);
                    $('#nombre').val(cliente.razon_social);
                    $('#resCliente').text("Cliente existe");            
                }  
                else{
                    $('#cedula_tercero').val("");
                    $('#nombre').val("");
                    $('#id_cliente').val("");
                    $('#resCliente').text("Cliente no existe, si desea crearlo, diligencie los datos restantes");               
                }              
            },
            error: function(){
                swal({
                  title: "Algo anda mal",
                  text: "Verifique conexión a internet y/o diligencie completamente los campos del encabezado",
                  icon: "error",
                  button: "Aceptar",
                });
            }
        });
    }
}

function buscarcliente2(texto){
    console.log(texto);
    if(texto.length > 3){
        var urls = "/administrador/diretorios/search/search";
        parametros = {
            "razon_social" : texto.trim()
        };
        $.ajax({
            data:  parametros,
            url:   urls,
            type:  'post',
            beforeSend: function () {
                $('#resultado').html('<p>Espere porfavor</p>');
            },
            success:  function (response) {
                console.log(response);
                if(response.body.length != 0){ // existe
                    cliente = response.body[0];
                    $('#listaclientes').find('option').remove();
                    for(i=0;response.body.length > i;i++){
                        $('#listaclientes').append('<option value="'+response.body[i].razon_social+'">"'+response.body[i].razon_social+'"</option>');
                    }
                    $('#id_cliente').val(cliente.id);
                    $('#cedula_tercero').val(cliente.nit);
                    $('#nombre').val(cliente.razon_social);
                    $('#resCliente').text("Cliente existe");           
                }  
                else{
                    $('#cedula_tercero').val("");
                    $('#nombre').val("");
                    $('#id_cliente').val("");
                    $('#resCliente').text("Cliente no existe, si desea crearlo, diligencie los datos restantes");               
                }              
            },
            error: function(){
                swal({
                  title: "Algo anda mal",
                  text: "Verifique conexión a internet y/o diligencie completamente los campos del encabezado",
                  icon: "error",
                  button: "Aceptar",
                });
            }
        });
    }
}
</script>


@endsection()