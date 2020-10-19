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
    <h4 class="title">Extracto clientes / proveedores</h4>
</div>
<br><br>
<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Gráfica</button>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Graficas</h4>
      </div>
      <div class="modal-body">
        <canvas id="myChart" width="400" height="200"></canvas>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>

<br><br>
<div class="row top-11-w">

    
    <div class="panel panel-primary " style="margin-left:5%;margin-right:5%;">
        <!-- Default panel contents -->
        <div class="panel-heading">Extracto clientes</div>
        <div class="panel-body" >

            <br><br>
            <p style="font-size:10pt;font-family:Poppins;margin-left:2%">Filtros de busqueda:</p>
            <div class="col-md-12"> 
                <form method="GET" class="row">
                    <div class="col-md-2">
                        <input type="text" name="nit" placeholder="Nit" value="{{ isset($_GET['nit'])?$_GET['nit']:'' }}" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <div class="col-md-12 row">
                            <div class="col-md-12">
                                <input type="text" name="razonsocial" value="{{ isset($_GET['razonsocial'])?$_GET['razonsocial']:'' }}" placeholder="Razón social" class="form-control">
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-5 row">
                        <div class="col-md-6">
                            <input type="date" name="fechainicio" value="{{ isset($_GET['fechainicio'])?$_GET['fechainicio']:date('Y-m-d') }}" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <input type="date" name="fechafinal" value="{{ isset($_GET['fechafinal'])?$_GET['fechafinal']:date('Y-m-d') }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <input type="submit" value="Consultar" class="btn btn-success">
                    </div>
                </form><br><br>
            </div>
            

            <p style="font-size: 10pt;">A continuación se describe el extracto de los clientes, en el cual se detalla
                el saldo diferente de 0 (cero) de cada uno de las facturas emitidas con corte
                al presente día. <br> <strong style="font-size: 20pt;">TOTAL : $ 
                @if(isset($totalcarteracliente))
                <span style="font-size: 20pt;" >{{ $totalcarteracliente->totalfacturas }}</span>
                @else
                <span style="font-size: 20pt;" id="total_cliente"></span>
                @endif
                    
                </strong>
                <div id="total_cliente1"></div>
            </p>
        </div>

        
        <!-- Table -->
        <div style="overflow-x:scroll;">
            <table class="table table-hover" id="tabla_cliente">
                <thead>
                    <tr>
                        <th>NIT</th>
                        <th>RAZÓN SOCIAL</th>
                        <th>TELÉFONO</th>
                        <th>ZONA VENTA</th>
                        <th>PLAZO DE </th>
                        <th>DIAS MORA</th>
                        <th>DOCUMENTO</th>
                        <th>VENDEDOR</th>
                        <th>SALDO</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carteracliente as $obj)
                    <?php $datetime1 = new DateTime($obj->fecha);
                    $datetime2 = new DateTime($obj->fecha_vencimiento); 
                    $interval = $datetime1->diff($datetime2);
                    $plazo = $interval->format('%R%a días');
                    
                    $datetime3 = new DateTime(date("Y-m-d"));
                    $datetime4 = new DateTime($obj->fecha_vencimiento); 
                    $interval = $datetime3->diff($datetime4);
                    $mora = $interval->format('%R%a días');?>
                    <tr>
                        <td>{{ number_format($obj->nit, 0, ",", ".") }}</td>
                        <td><a href="/cartera/historial/{{ $obj['idcliente'] }}">{{ $obj->razon_social }}</td>
                        <td>{{ $obj->telefono }}</td>
                        <td>{{ $obj->zona_venta }}</td>
                        <td>{{ $plazo }}</td>
                        <td>{{ $mora }}</td>
                        <td><a href="javascript:envioUrl('/documentos/imprimir/{{ $obj['idfactura'] }}')" >{{ $obj->prefijo }} {{ $obj->numero }}</a></td>
                        <td>{{ number_format($obj->ncedula, 0, ",", ".") }}</td>
                        <td>{{ $obj->saldo }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <div class="panel panel-warning " style="margin-left:5%;margin-right:5%;">
        <!-- Default panel contents -->
        <div class="panel-heading">Extracto proveedores</div>
        <div class="panel-body" >

            <br><br>
            <p style="font-size:10pt;font-family:Poppins;margin-left:2%">Filtros de busqueda:</p>
            <div class="col-md-12"> 
                <form method="GET" class="row">
                    <div class="col-md-2">
                        <input type="text" name="nit" placeholder="Nit" value="{{ isset($_GET['nit'])?$_GET['nit']:'' }}" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <div class="col-md-12 row">
                            <div class="col-md-12">
                                <input type="text" name="razonsocial" value="{{ isset($_GET['razonsocial'])?$_GET['razonsocial']:'' }}" placeholder="Razón social" class="form-control">
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-5 row">
                        <div class="col-md-6">
                            <input type="date" name="fechainicio" value="{{ isset($_GET['fechainicio'])?$_GET['fechainicio']:date('Y-m-d') }}" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <input type="date" name="fechafinal" value="{{ isset($_GET['fechafinal'])?$_GET['fechafinal']:date('Y-m-d') }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <input type="submit" value="Consultar" class="btn btn-success">
                    </div>
                </form><br><br>
            </div>
            
            <p style="font-size: 10pt;">A continuación se describe el extracto de los proveedores, en el cual se detalla
                el saldo diferente de 0 (cero) de cada uno de las facturas emitidas con corte
                al presente día. <br> <strong style="font-size: 20pt;">TOTAL : $                 
                @if(isset($totalcarteraproveedor))
                <span style="font-size: 20pt;">{{ $totalcarteraproveedor->totalfacturas }}</span>
                @else
                <span style="font-size: 20pt;" id="total_proveedor"></span>
                @endif
                </strong>
                <div id="total_proveedor1"></div>
            </p>
        </div>

        <!-- Table -->
        <div style="overflow-x:scroll;">
            <table class="table table-hover" id="tabla_proveedor">
                <thead>
                    <tr>
                        <th>NIT</th>
                        <th>RAZÓN SOCIAL</th>
                        <th>TELÉFONO</th>
                        <th>ZONA VENTA</th>
                        <th>PLAZO DE </th>
                        <th>DIAS MORA</th>
                        <th>DOCUMENTO</th>
                        <th>VENDEDOR</th>
                        <th>SALDO</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carteraproveedor as $obj)
                    <?php $datetime1 = new DateTime($obj->fecha);
                    $datetime2 = new DateTime($obj->fecha_vencimiento); 
                    $interval = $datetime1->diff($datetime2);
                    $plazo = $interval->format('%R%a días');
                    
                    $datetime3 = new DateTime(date("Y-m-d"));
                    $datetime4 = new DateTime($obj->fecha_vencimiento); 
                    $interval = $datetime3->diff($datetime4);
                    $mora = $interval->format('%R%a días');?>
                    <tr>
                        <td>{{ number_format($obj->nit, 0, ",", ".") }}</td>
                        <td>{{ $obj->razon_social }}</td>
                        <td>{{ $obj->telefono }}</td>
                        <td>{{ $obj->zona_venta }}</td>
                        <td>{{ $plazo }}</td>
                        <td>{{ $mora }}</td>
                        <td><a href="javascript:envioUrl('/documentos/imprimir/{{ $obj['idfactura'] }}')" >{{ $obj->prefijo }} {{ $obj->numero }}</a></td>
                        <td>{{ number_format($obj->ncedula, 0, ",", ".") }}</td>
                        <td>{{ $obj->saldo }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>





<script>
$(document).ready(function() {
    var table = $('#tabla_cliente').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
    var table2 = $('#tabla_proveedor').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );

    totalclientes(table);
    totalproveedor(table2);

    $('input[aria-controls=tabla_cliente]').keypress(function(){
        totalclientes(table);
    });
    
    $('input[aria-controls=tabla_proveedor]').keypress(function(){
        totalproveedor(table2);
    });

} );


function totalclientes(table){
    var total = 0;
    var data = table.rows().data();
    data.each(function (value, index){
        total = total + parseInt(value[8]);
    });
    $('#total_cliente').html(new Intl.NumberFormat("de-DE", {style: "currency", currency: "COP"}).format(total));
    $('#total_cliente1').html(total);
}

function totalproveedor(table){
    var total = 0;
    var data = table.rows().data();
    data.each(function (value, index){
        total = total + parseInt(value[8]);
    });
    $('#total_proveedor').html(new Intl.NumberFormat("de-DE", {style: "currency", currency: "COP"}).format(total));
    $('#total_proveedor1').html(total);
}

function envioUrl (url){
    window.open(url, "imprimir documento", "width=800, height=700")
}
</script>

<script>

    setTimeout(function() {
        // rest of code here
        var ctx = document.getElementById('myChart').getContext('2d');
        var cliente = document.getElementById('total_cliente1').innerHTML;
        var proveedor = document.getElementById('total_proveedor1').innerHTML;
        console.log(cliente);
        console.log(proveedor);
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Clientes', 'Proveedor'],
                datasets: [{
                    label: 'Cuentas por cobrar / pagar',
                    data: [cliente,proveedor],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1
                }]
            }
        });
    }, 15000);
        
</script>

@endsection()