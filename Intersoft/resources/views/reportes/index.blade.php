@extends('layout')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>

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
    <h4 class="title">Reportes Generales</h4>
</div>


<div class="row top-5-w" style="padding:2%;">

    <form action="" method="GET">
        <input type="date" value="{{ isset($_GET['sesion_fecha_inicio'])? $_GET['sesion_fecha_inicio'] : '' }}" name="sesion_fecha_inicio">
        <input type="date" value="{{ isset($_GET['sesion_fecha_final'])? $_GET['sesion_fecha_final'] : '' }}" name="sesion_fecha_final">
        <select name="usuarios">
            <option value="0">Seleccione vendedor</option>
            @foreach ($usuarios as $obj)
                <option value="{{ $obj->id }}">{{ $obj->nombre }}</option>
            @endforeach
        </select>
        <input type="submit" value="Buscar">
    </form>

    <div class="col-md-5">
        <div class="panel panel-default">
            <div class="panel-heading">Reporte sesiones usuarios</div>
            <div class="row panel-body">
                <div class="col-md-3">
                    <table class="table">
                        <tr>
                            <th>Cedula</th>
                            <th>Sesiones</th>
                        </tr>
                        @foreach ($sesiones as $obj)
                            <tr>
                            <td>{{ $obj->ncedula }}</td>
                            <td>{{ $obj->sesiones }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="col-md-12">
                    <canvas id="sesionesChart" ></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-7">
        <div class="panel panel-warning">
            <div class="panel-heading">Reporte Ventas vs Compras</div>
            <div class="row panel-body">
                <div class="col-md-12">
                    <canvas id="ventascompras" ></canvas>
                </div>
            </div>
        </div>
    </div>

    
</div>

<script>
var ctx = document.getElementById('sesionesChart');
sesiones = {!! json_encode($sesiones) !!};
//console.log(sesiones);

labels  = [];
data    = [];
for(i=0; sesiones.length > i; i++){
    obj = sesiones[i];
    labels.push(obj.ncedula);
    data.push(obj.sesiones);
}

var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: '# de sesiones',
            data: data,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>

<script>
var ctx = document.getElementById('ventascompras');
ventas = {!! json_encode($ventas) !!};
compras = {!! json_encode($compras) !!};
pedidos = {!! json_encode($pedidos) !!};
//console.log(sesiones);

labels  = [];
data    = [];
for(i=0; ventas.length > i; i++){
    obj = ventas[i];
    labels.push('total');
    labels.push('iva');
    labels.push('retefuente');
    data.push({
            label: '# de Ventas',
            data: [obj.total,obj.iva,obj.retefuente],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)'
            ],
            borderWidth: 1
        });
}
for(i=0; compras.length > i; i++){
    obj = compras[i];
    data.push({
            label: '# de Compras',
            data: [obj.total,obj.iva,obj.retefuente],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)'
            ],
            borderWidth: 1
        });
}
for(i=0; pedidos.length > i; i++){
    obj = pedidos[i];
    data.push({
            label: '# de Pedidos',
            data: [obj.total,obj.iva,obj.retefuente],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)'
            ],
            borderWidth: 1
        });
}
console.log(labels);
console.log(data);

var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: data
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>
    

@endsection()