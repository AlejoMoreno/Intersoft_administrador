@extends('layout')

@section('content')


<style>
    .red{
        background: #B40404 !important;
        color: white;
        opacity: 0.8;
    }
    .naranja{
        background: #FF8000 !important;
        color: white;
        opacity: 0.8;
    }
</style>
<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Orden # <span id="orden_text"></span></h4>
                    <p>Muestra de las fichas de esta orden</p>
                </div>
                <div class="content">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="orden">Ficha tecnica</th>
                                <th class="orden">Etapa</th>
                                <th class="orden">Unidades</th>
                                <th class="ficha">Materia Prima</th>
                                <th class="ficha">Unidad</th>
                                <th class="ficha">Total</th>
                                <th class="referencia">Saldo</th>
                                <th class="referencia">costo</th>
                            </tr>
                        </thead>
                        <tbody id="tabla"></tbody>
                    </table>
                    <div id="select_etapa">
                        
                    </div>
                    
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Ordenes de producción pendientes</h4>
                    <p class="category">Cambio de estado de ordenes de producción</p><br>
                </div>
                <div class="content">
                    <div style="overflow-x:scroll;overflow-y:scroll;height:500px;">
                        <table class="table table-hover table-striped" id="datos">
                            <thead>
                                <tr>
                                    <th>Orden de produccion</th>
                                    <th>Cliente</th>
                                    <th>Cantidad Items</th>
                                    <th>Etapa</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                foreach ($produccioningresos1 as $value) {
                                    if($value->etapa == 10){ //cancelado
                                        $clase = "red";
                                        $boton = "<td><div class='btn btn-danger'>PDF</div></td>";
                                        $nombre = "Cancelado";
                                    }
                                    else if($value->etapa == 11){ //producto terminado
                                        $clase = "naranja";
                                        $boton = "<td><div class='btn btn-danger'>PDF</div></td>";
                                        $nombre = "Orden Finalizada";
                                    }
                                    else{
                                        $clase = "";
                                        $boton = "<td><div class='btn btn-warning' onclick='ing.Ver2(".$value->orden_produccion.")'>></div></td>";
                                        $nombre = $value->etapa;
                                    }
                                    echo "<tr class='".$clase."'>";
                                        echo "<td>".$value->orden_produccion."</td>";
                                        echo "<td>".$value->id_cliente['razon_social']."</td>";
                                        echo "<td>".$value->total."</td>";
                                        echo "<td>".$nombre."</td>";
                                        echo $boton;
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="footer">
                        <div class="legend">
                            <i class="fa fa-circle text-info"></i> 
                            <i class="fa fa-circle text-danger"></i> 
                            <i class="fa fa-circle text-warning"></i>
                        </div>
                        <hr>
                        <div class="stats">
                            <i class="pe-7s-angle-left-circle"></i> <a href="#" onclick="config.Redirect('/submenu/produccion');"> ir atras.</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
var ing = new IngresosProduccion();

function IngresosProduccion(){

    this.initial = function(){
        $('#actualizar').hide();
    };

    this.Ver = function( data ){
        console.log('Daatos Sucurusal-update:');
        //var data = JSON.parse(data);
        console.log(data);
        
    };

    this.validacion = function( flag ){
        if(flag == 0){
            return "naranja";
        }
        else if(flag < 0){
            return "red";
        }
        else{
            return "";
        }
    } 

    this.Ver2 = function( data ){
        console.log('Daatos:');
        //var data = JSON.parse(data);
        console.log(data);
        $('#tabla').html("");
        parametros = {
            "orden_produccion" : data
        };
        $.ajax({
			data:  parametros,
			url:   '/inventario/ingresoporproduccion/update',
			type:  'post',
			beforeSend: function () {
                $('#resultado').html('<p>Espere porfavor</p>');
                
			},
			success:  function (response) {
                console.log(response);
                $('#orden_text').html(response.produccioningresos[0].orden_produccion);
                var tabla = "";
                var total = 0;
                var flag_numero = 0;
                var clase_style = ["#EBF5FB","#AED6F1","#5DADE2","#2E86C1","#21618C","#117864","#17A589","#48C9B0"];
                for (let j = 0; j < response.produccioningresos.length; j++) {
                    const produccioningresos = response.produccioningresos[j];
                    for (let index = 0; index < produccioningresos.fichas.length; index++) {
                        const ficha = produccioningresos.fichas[index];
                        const flag = ficha.id_referencia.saldo - (ficha.cantidad * produccioningresos.unidades);
                        flag_numero += flag;
                        const clase = ing.validacion(flag);
                        total = total + (ficha.id_referencia.costo * (ficha.cantidad * produccioningresos.unidades));
                        tabla += "<tr style='background-color: "+clase_style[j]+"'>"+
                            "<td>"+produccioningresos.id_ficha_tecnica.nombre+"</td>"+
                            "<td>"+produccioningresos.etapa+"</td>"+
                            "<td>"+ new Intl.NumberFormat(["ban", "id"]).format(produccioningresos.unidades)+"</td>"+
                            "<td>"+ ficha.id_referencia.descripcion+"</td>"+
                            "<td>"+ new Intl.NumberFormat(["ban", "id"]).format(ficha.cantidad)+"</td>"+
                            "<td>"+ new Intl.NumberFormat(["ban", "id"]).format( (ficha.cantidad * produccioningresos.unidades) )+"</td>"+
                            "<td class='"+clase+"'>"+ new Intl.NumberFormat(["ban", "id"]).format(ficha.id_referencia.saldo)+"</td>"+
                            "<td> $ "+ new Intl.NumberFormat(["ban", "id"]).format((ficha.cantidad * produccioningresos.unidades)*ficha.id_referencia.costo)+"</td>"+
                        "</tr>";
                    }
                }
                if(flag_numero < 0){
                    $('#select_etapa').html("<select class='form-control' name='etapa' id='etapa'>"+
                        "<option>Seleccione la etapa</option>"+
                        "<option value='2'>Etapa 2</option>"+
                        "<option value='3'>Etapa 3</option>"+
                        "<option value='4'>Etapa 4</option>"+
                        "<option value='5'>Etapa 5</option>"+
                        "<option value='6'>Etapa 6</option>"+
                        "<option value='7'>Etapa 7</option>"+
                        "<option value='8'>Etapa 8</option>"+
                        "<option value='9'>Etapa 9</option>"+
                        "<option value='10'>Cancelar la orden</option>"+
                    "</select>"+
                    "<div class='btn btn-success' onclick='ing.Pasar("+JSON.stringify( response.produccioningresos )+")'>Pasar la orden</div>");
                }
                else{
                    $('#select_etapa').html("<select class='form-control name='etapa' id='etapa'>"+
                        "<option>Seleccione la etapa</option>"+
                        "<option value='2'>Etapa 2</option>"+
                        "<option value='3'>Etapa 3</option>"+
                        "<option value='4'>Etapa 4</option>"+
                        "<option value='5'>Etapa 5</option>"+
                        "<option value='6'>Etapa 6</option>"+
                        "<option value='7'>Etapa 7</option>"+
                        "<option value='8'>Etapa 8</option>"+
                        "<option value='9'>Etapa 9</option>"+
                        "<option value='11'>Finalizar y convertir producto</option>"+
                        "<option value='10'>Cancelar la orden</option>"+
                    "</select>"+
                    "<div class='btn btn-success' onclick='ing.Pasar("+JSON.stringify( response.produccioningresos )+")'>Pasar la orden</div>");
                }
                
                tabla += "<tr><th colspan='7'><center>Total: </center></th><th> $ "+ new Intl.NumberFormat(["ban", "id"]).format(total) +"</th></tr>";
                
                $('#tabla').html(tabla);
			}
        });
        
    };

    this.Pasar = function( data ){
        //console.log(data); //convertir en o pasar de etapa
        parametros = {
            "data" : data,
            "etapa" : $('#etapa').val()
        };
        $.ajax({
			data:  parametros,
			url:   '/inventario/ingresoporproduccion/convertir',
			type:  'post',
			beforeSend: function () {
				$('#resultado').html('<p>Espere porfavor</p>');
			},
			success:  function (response) {
                console.log(response);
                config.Redirect('/inventario/ingresoporproduccion');
			}
        });
    }
    

}
</script>

<style>
    .orden{
        background: red !important;
        opacity: 0.7 !important;
    }
    .ficha{
        background: blue !important;
        opacity: 0.7 !important;
    }
    .referencia{
        background: green !important;
        opacity: 0.7 !important;
    }
</style>

@endsection()