@extends('layout')

@section('content')


<style>
.title{
    margin-left: 2%;
    font-weight: bold !important;
    font-family: Poppins !important;
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
.header_fijo {
  width: 750px;
  table-layout: fixed;
  border-collapse: collapse;
}
.header_fijo thead {
  background-color: #333;
  color: #FDFDFD;
}
.header_fijo thead tr {
  display: block;
  position: relative;
}
.header_fijo tbody {
  display: block;
  overflow: auto;
  width: 100%;
  height: 300px;
}
</style>

<div class="enc-article">
    <h4 class="title">Analizador de cartera</h4>
</div>

<div class="row top-11-w">

    <br><br>
    <p style="font-size:10pt;font-family:Poppins;margin-left:2%">Filtros de busqueda:</p>
    <div class="col-md-12"> 
        <form method="GET" class="row">
            <div style="margin-bottom:2%;" class="col-md-2">
                <label>Tipo de Informe</label>
                <select class="form-control" name="tipo_informe" id="tipo_informe"> 
                    <option value="1">Cartera de Proveedores</option>
                    <option value="2">Cartera de Clientes</option>
                    <option value="3">Cartera de Terceros</option>
                </select>
            </div>
            <div style="margin-bottom:2%;" class="col-md-3">
                <label>Fecha de Corte</label>
                <input type="date" name="fechafinal" value="{{ isset($_GET['fechafinal'])?$_GET['fechafinal']:'' }}" class="form-control">
            </div>
            <div style="margin-bottom:2%;" class="col-md-2">
                <label>Sucursal</label>
                <select class="form-control" name="sucursal" id="sucursal"> 
                    <option value="0">Todas</option>
                </select>
            </div>
            <div style="margin-bottom:2%;" class="col-md-2">
                <label>Tipo presentación</label>
                <select class="form-control" name="tipo_presentacion" id="tipo_presentacion"> 
                    <option value="1">Detalle y Resumen</option>
                    <option value="2">Solo Resumen</option>
                    <option value="3">Por Vencimiento</option>
                </select>
            </div>
            <div style="margin-bottom:2%;" class="col-md-2">
                <label>Nit</label>
                <input type="text" name="nit" placeholder="Nit" value="{{ isset($_GET['nit'])?$_GET['nit']:'' }}" class="form-control">
            </div>
            <div style="margin-bottom:2%;" class="col-md-5">
                <label>Nombre / Razón social</label>
                <input type="text" name="razonsocial" value="{{ isset($_GET['razonsocial'])?$_GET['razonsocial']:'' }}" placeholder="Razón social" class="form-control">
            </div>
            <div style="margin-bottom:2%;" class="col-md-2">
                <input type="submit" value="Consultar" class="btn btn-success">
            </div>
        </form><br><br>
    </div>
    <div class="col-md-11" style="overflow-x:scroll;margin-left:2%">
        <h4 class="title" style="text-align: center;">RELACION DE VENCIMIENTOS DE CARTERA A [[ $fechafin ]]</h4>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th></th>
                    <th class="title" style="font-size: 10pt;padding:1%;" colspan="3">DOCUMENTO</th>
                    <th class="title" style="font-size: 10pt;padding:1%;">FACTURAS</th>
                    <th class="title" style="font-size: 10pt;padding:1%;" colspan="6">CONDICIONES</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th></th>
                    <th class="title" style="font-size: 10pt;padding:1%;">NÚMERO</th>
                    <th class="title" style="font-size: 10pt;padding:1%;">EMISIÓN</th>
                    <th class="title" style="font-size: 10pt;padding:1%;">VENCIMIENTO</th>
                    <th class="title" style="font-size: 10pt;padding:1%;">SIN VENCER</th>
                    <th class="title" style="font-size: 10pt;padding:1%;">1 - 30 DÍAS</th>
                    <th class="title" style="font-size: 10pt;padding:1%;">31 - 60 DÍAS</th>
                    <th class="title" style="font-size: 10pt;padding:1%;">61 - 90 DÍAS</th>
                    <th class="title" style="font-size: 10pt;padding:1%;">91 - 120 DÍAS</th>
                    <th class="title" style="font-size: 10pt;padding:1%;">MÁS DE 120 DÍAS</th>
                    <th class="title" style="font-size: 10pt;padding:1%;">DÍAS</th>
                </tr>
                <?php $total = 0; $obj_anterior = null; $total1=0; $total2=0; $total3=0; $total4=0; $total5=0; $total6=0; ?>
                <?php for($i = 0; $i < sizeof($cartera); $i++){ ?>
                    <?php 
                    $obj = $cartera[$i];
                    if($i>0){
                        $obj_anterior = $cartera[$i-1];
                    }
                    else{
                        $obj_anterior = $cartera[0];
                    }
                    $datetime1 = new DateTime($obj->fecha);
                    $datetime2 = new DateTime($obj->fecha_vencimiento); 
                    $interval = $datetime1->diff($datetime2);
                    $plazo = $interval->format('%R%a');

                    $datetime3 = new DateTime($obj->fecha); 
                    $datetime4 = new DateTime(date("Y-m-d"));
                    $interval = $datetime3->diff($datetime4);
                    $mora = $interval->format('%R%a');
                    
                    
                    ?>
                    
                    @if($obj->nit != $obj_anterior->nit)
                    <tr>
                        <?php $total = $obj->saldo;?>
                        <td colspan="11"><p style="font-size: 10pt;">{{ $obj->razon_social }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                            {{ number_format($obj->nit, 0, ",", ".") }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                            {{ $obj->direccion }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                            {{ $obj->telefono }}</p></td>
                    </tr>
                    @endif
                    <tr>
                        <td style="width: 200px;"></td>
                        <td style="padding:4%;"><a href="javascript:envioUrl('/documentos/imprimir/{{ $obj['idfactura'] }}')" >{{ $obj->prefijo }} {{ $obj->numero }}</a></td>
                        <td style="padding:4%;">{{ $obj->fecha }}</td>
                        <td style="padding:4%;">{{ $obj->fecha_vencimiento }}</td>
                        @if(($mora - $plazo) <= 0)
                        <?php $total1=$total1 + $obj->saldo; ?>
                            <td style="text-align:center">{{ number_format($obj->saldo, 0, ",", ".") }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        @elseif(($mora - $plazo) <= 30)
                        <?php $total2=$total2 + $obj->saldo; ?>
                            <td></td>
                            <td style="text-align:center">{{ number_format($obj->saldo, 0, ",", ".") }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        @elseif(($mora - $plazo) <= 60)
                        <?php $total3=$total3 + $obj->saldo; ?>
                            <td></td>
                            <td></td>
                            <td style="text-align:center">{{ number_format($obj->saldo, 0, ",", ".") }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        @elseif(($mora - $plazo) <= 90)
                        <?php $total4=$total4 + $obj->saldo; ?>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="text-align:center">{{ number_format($obj->saldo, 0, ",", ".") }}</td>
                            <td></td>
                            <td></td>
                        @elseif(($mora - $plazo) <= 120)
                        <?php $total5=$total5 + $obj->saldo; ?>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="text-align:center">{{ number_format($obj->saldo, 0, ",", ".") }}</td>
                            <td></td>
                        @else
                        <?php $total6=$total6 + $obj->saldo; ?>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="text-align:center">{{ number_format($obj->saldo, 0, ",", ".") }}</td>
                        @endif
                        <td style="text-align:center">{{ number_format(($mora - $plazo), 0, ",", ".") }}</td>
                    </tr>
                    @if($obj_anterior->nit != $obj->nit)
                    <tr>
                        <td class="title" style="font-size: 10pt;padding:1%;text-align: right">TOTAL: {{ number_format($total, 0, ",", ".") }}</td>
                        <td colspan="3"></td>
                        <td class="title" style="font-size: 10pt;padding:1%;text-align: center">{{ ($total1!=0)?number_format($total1, 0, ",", "."):''  }}</td>
                        <td class="title" style="font-size: 10pt;padding:1%;text-align: center">{{ ($total2!=0)?number_format($total2, 0, ",", "."):''  }}</td>
                        <td class="title" style="font-size: 10pt;padding:1%;text-align: center">{{ ($total3!=0)?number_format($total3, 0, ",", "."):''  }}</td>
                        <td class="title" style="font-size: 10pt;padding:1%;text-align: center">{{ ($total4!=0)?number_format($total4, 0, ",", "."):''  }}</td>
                        <td class="title" style="font-size: 10pt;padding:1%;text-align: center">{{ ($total5!=0)?number_format($total5, 0, ",", "."):''  }}</td>
                        <td class="title" style="font-size: 10pt;padding:1%;text-align: center">{{ ($total6!=0)?number_format($total6, 0, ",", "."):''  }}</td>
                        <td></td>
                    </tr>
                    @endif
                    <?php 
                        
                        //calculat total
                        $total = $total + $obj->saldo;
                    
                    ?>
                <?php } ?>
            </tbody>
        </table>

    </div>
    <div class="col-md-11" style="overflow-x:scroll;margin-left:2%">
        <h4 class="title" style="text-align: center;">RELACION DE VENCIMIENTOS DE CARTERA A [[ $fechafin ]]</h4>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>NOMBRE</th>
                    <th>CUANTIFICACION TOTAL DEL ATRASO</th>
                </tr>
                <tr>
                    <th>CC / NIT</th>
                    <th></th>
                    <th class="title" style="font-size: 10pt;padding:1%;">NÚMERO</th>
                    <th class="title" style="font-size: 10pt;padding:1%;">EMISIÓN</th>
                    <th class="title" style="font-size: 10pt;padding:1%;">VENCIMIENTO</th>
                    <th class="title" style="font-size: 10pt;padding:1%;">SIN VENCER</th>
                    <th class="title" style="font-size: 10pt;padding:1%;">1 - 30 DÍAS</th>
                    <th class="title" style="font-size: 10pt;padding:1%;">31 - 60 DÍAS</th>
                    <th class="title" style="font-size: 10pt;padding:1%;">61 - 90 DÍAS</th>
                    <th class="title" style="font-size: 10pt;padding:1%;">91 - 120 DÍAS</th>
                    <th class="title" style="font-size: 10pt;padding:1%;">MÁS DE 120 DÍAS</th>

                </tr>
            </thead>
        </table>

    </div>



</div>




@endsection()