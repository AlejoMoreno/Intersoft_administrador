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
                <input type="hidden" name="id_cliente" id="id_cliente">
                <input type="text" list="listDirectorio" name="cedula_tercero" value=""  id="cedula_tercero" placeholder="nit" class="form-control" onchange="buscarcliente(this.value)">
                <p style="font-size:10px;color:black;"  id="resCliente">Para buscar el cliente debe tener un minimo de 3 caracteres</p>                
            </div>
            <div class="col-md-4">
                <label>Razón Social:</label>
                <input type="text" name="nombre" list="listaclientes"  id="nombre" placeholder="Razón Social" class="form-control" onchange="buscarcliente2(this.value)" >
                <datalist id="listaclientes"></datalist>
            </div>
            <div class="col-md-4">
                <label>Fecha Corte:</label>
                <input type="date" name="fecha_corte"  id="fecha_corte" placeholder="Fecha corte" class="form-control" >
            </div>
            
            <div class="col-md-11" style="overflow-x:scroll;margin-left:2%">
                <table class="table table-hover table-striped"  id="datos">
                    <thead>
                        <th>idfactura</th>
                        <th>carterafactura</th>
                        <th>cliente</th>
                        <th>fnumero</th>
                        <th>fprefijo</th>
                        <th>total</th>
                        <th>totalkardexcartera</th>
                        <th>signo</th>
                        <th>idcartera</th>
                        <th>cnumero</th>
                        <th>cprefijo</th>
                        <th>totalcartera</th>
                    </tr></thead>
                    <tbody>
                        @foreach($docs as $obj)
                        <tr>
                            <td>{{ $obj->idfactura }}</td>
                            <td>{{ $obj->carterafactura }}</td>
                            <td>{{ $obj->cliente }}</td>
                            <td>{{ $obj->fnumero }}</td>
                            <td>{{ $obj->fprefijo }}</td>
                            <td>{{ $obj->total }}</td>
                            <td>{{ $obj->totalkardexcartera }}</td>
                            <td>{{ $obj->signo }}</td>
                            <td>{{ $obj->idcartera }}</td>
                            <td>{{ $obj->cnumero }}</td>
                            <td>{{ $obj->cprefijo }}</td>
                            <td>{{ $obj->totalcartera }}</td>
                        </tr>
                        @endforeach                                
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</div>


<script>


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
                    $('#cedula_tercero').val(cliente.nit);
                    //$('#nombre').val(cliente.razon_social);
                    $('#direccion').val(cliente.direccion);
                    $('#telefono').val(cliente.telefono);
                    $('#correo').val(cliente.correo); 
                    $('#id_ciudad').val(cliente.id_ciudad);
                    $('#zona').val(cliente.zona_venta);
                    $('#directorio_tipo').val(cliente.id_directorio_tipo.nombre);
                    $('#id_retefuente').val(JSON.stringify(cliente.id_retefuente));
                    $('#nombre').prop( "disabled", false );  
                    $('#direccion').prop( "disabled", false );  
                    $('#telefono').prop( "disabled", false );  
                    $('#correo').prop( "disabled", false );    
                    $('#id_ciudad').prop("disabled", false);
                    $('#zona').prop("disabled", false);
                    //$('#guardarCliente').hide();   
                    config.createToast("success", "Cliente existe");
                    $('#resCliente').text("Cliente existe");    
                    //cartera
                    $('#Carterasid_cliente').val(cliente.id);           
                }  
                else{
                    $('#listaclientes').find('option').remove();
                    $('#cedula_tercero').val("");
                    $('#nombre').val("");
                    $('#direccion').val("");
                    $('#telefono').val("");
                    $('#correo').val("");
                    $('#zona').val("");
                    $('#directorio_tipo').val("");
                    $('#id_retefuente').val("");
                    $('#nombre').prop( "disabled", false );  
                    $('#direccion').prop( "disabled", false );  
                    $('#telefono').prop( "disabled", false );  
                    $('#correo').prop( "disabled", false ); 
                    $('#id_ciudad').prop("disabled", false);
                    $('#zona').prop("disabled", false);
                    //$('#guardarCliente').show();
                    config.createToast("error", "Cliente no existe, si desea crearlo, diligencie los datos restantes");
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