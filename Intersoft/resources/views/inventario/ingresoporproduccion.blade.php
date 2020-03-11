@extends('layout')

@section('content')



<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Orden # xxx</h4>
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
                                <th class="ficha">Cantidad Materia Prima</th>
                                <th class="referencia">Saldo</th>
                                <th class="referencia">ultimo costo</th>
                            </tr>
                        </thead>
                    </table>
                    <select class="form-control" name="etapa" id="etapa">
                        <option>Seleccione la etapa</option>
                        <option value="11">Finalizar y convertir producto</option>
                        <option value="10">Cancelar la orden</option>
                    </select>
                    <div class="btn btn-success">Pasar la orden</div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Ordenes de producción pendientes</h4>
                    <p class="category">Cambio de estado de ordenes de producción</p><br>
                </div>
                <div class="btn btn-success" onclick="ing.Ver({{ $produccioningresos }})">Ver Ordenes</div>
                <div class="content">
                    <div style="overflow-x:scroll;overflow-y:scroll;height:500px;">
                        <table class="table table-hover table-striped" id="datos">
                            <thead>
                                <tr>
                                    <th>Orden de produccion</th>
                                    <th>Cantidad Items</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                foreach ($produccioningresos1 as $value) {
                                    echo "<tr>";
                                        echo "<td>".$value->orden_produccion."</td>";
                                        echo "<td>".$value->total."</td>";
                                        echo "<td><div class='btn btn-warning' onclick='ing.Ver2(".$value->orden_produccion.")'>></div></td>";
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

    this.Ver2 = function( data ){
        console.log('Daatos:');
        //var data = JSON.parse(data);
        console.log(data);
        
    };

    

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