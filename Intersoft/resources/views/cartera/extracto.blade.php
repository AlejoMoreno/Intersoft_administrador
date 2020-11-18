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
        <form class="header row" style="background:white">
            <div class="col-md-2">
                <label>Nit:</label>
                <input type="hidden" name="id_cliente" value="<?php echo (isset($docs[0]->cliente->id ))?$docs[0]->cliente->id :""; ?>" id="id_cliente">
                <input type="text" name="cedula_tercero" value="<?php echo (isset($docs[0]->cliente->nit ))?$docs[0]->cliente->nit :""; ?>"  id="cedula_tercero" placeholder="nit" class="form-control" onchange="buscarcliente(this.value)">
                <p style="font-size:10px;color:black;"  id="resCliente">Para buscar el cliente debe tener un minimo de 3 caracteres</p>                
            </div>
            <div class="col-md-2">
                <label>Razón Social:</label>
                <input type="text" name="nombre" list="listaclientes"  id="nombre" placeholder="Razón Social" class="form-control" onchange="buscarcliente2(this.value)" >
                <datalist id="listaclientes"></datalist>
            </div>
            <div class="col-md-2">
                <label>Sucursal:</label>
                <select name="sucursal" class="form-control">
                    <option value="">Seleccione sucursal</option>
                    @foreach ($sucursales as $obj)
                    <option value="{{$obj['id']}}">{{$obj['nombre']}}</option>    
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label>Fecha Corte:</label>
                <select name="fecha_corte" class="form-control">
                    <option value="">Seleccione fecha corte</option>
                    @foreach ($cierres as $obj)
                    <option value="{{$obj['fecha']}}">{{$obj['fecha']}}</option>    
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label>Tipo Vista:</label>
                <select name="tipo" class="form-control">
                    <option value="">Seleccione tipo</option>
                    <option value="1">Detalle y resumen</option>
                    <option value="2">Solo resumen</option>
                </select>
            </div>
            <div class="col-md-6"><br></div>
            <div class="col-md-4"><br>
                <button onclick="ir()" class="btn btn-success">Consultar</button>
            </div>
        </form>
        <div style="margin:2%;">
            <h4 class="title" style="color:black;text-align: center"> RELACION DE EXTRACTO</h4>
            @if(isset($cliente->nit))
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th colspan="4" style="text-align: center;">{{ isset($cliente->nit)? $cliente->nit .' '.$cliente->razon_social : '0000000 NOMBRE' }}</th>
                    </tr>
                    <tr>
                        <th>DESCRIPCIÓN ACTIVIDAD</th>
                        <th>DEBE</th>
                        <th>HABER</th>
                        <th>SALDO</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>SALDO {{ $_GET['fecha_corte'] }}</td>
                        <td>{{ ($saldos->saldo < 0)? '0' : $saldos->saldo }}</td>
                        <td>{{ ($saldos->saldo >= 0)? '0' : $saldos->saldo }}</td>
                        <td>{{ $saldos->saldo }}</td>
                    </tr>
                    @if(isset($carteras))
                        @foreach ($carteras as $cartera)
                        <?php 
                            if($cartera['tipoCartera'] == 'INGRESO'){
                                $saldos->saldo = $saldos->saldo - $cartera['totalkard'];
                            }
                            else if($cartera['tipoCartera'] == 'EGRESO'){
                                $saldos->saldo = $saldos->saldo + $cartera['totalkard'];
                            }
                            
                        ?>
                        <tr>
                            <td>Pago de factura {{ $cartera['numeroFactura'] }} tipo {{ $cartera['tipoCartera'] }} # {{ $cartera['numero'] }}</td>
                            <td>{{ ($cartera['tipoCartera'] == 'INGRESO')? '0' : $cartera['totalkard'] }}</td>
                            <td>{{ ($cartera['tipoCartera'] == 'EGRESO')? '0' : $cartera['totalkard'] }}</td>
                            <td>{{ $saldos->saldo }}</td>
                        </tr>
                        @endforeach
                    @endif
                    @if(isset($facturas))
                        @foreach ($facturas as $factura)
                        <?php 
                            if($factura['signo'] == '-'){
                                $saldos->saldo = $saldos->saldo + $factura['total'];
                            }
                            else if($factura['signo'] == '+'){
                                $saldos->saldo = $saldos->saldo - $factura['total'];
                            }
                            
                        ?>
                        <tr>
                            <td>Factura {{ $factura['prefijo'] }}||{{ $factura['numero'] }} tipo {{ $factura['id_documento']['nombre'] }}</td>
                            <td>{{ ($factura['signo'] == '+')? '0' : $factura['total'] }}</td>
                            <td>{{ ($factura['signo'] == '-')? '0' : $factura['total'] }}</td>
                            <td>{{ $saldos->saldo }}</td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            @endif
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