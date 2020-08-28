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
    <h4 class="title">Reporte usuarios</h4>
</div>


<div class="row top-5-w" style="padding:2%;">

    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">Usuarios</h4>
                <p class="category">Buscar referencias</p><br>
            </div>
            <div class="content">
                
                <p style="font-size:10px;">Para realizar cambios a la lista de precios uno a uno debe buscar el producto y dar dobleclick a los tres valores que existen en azul</p>
                <div style="overflow-x:scroll;overflow-y:scroll;height:500px;">
                    
                </div>
                
                    
                <div id="resultado"></div>
                <div class="footer">
                    <div class="legend">
                        <i class="fa fa-circle text-info"></i> 
                        <i class="fa fa-circle text-danger"></i> 
                        <i class="fa fa-circle text-warning"></i>
                    </div>
                    <hr>
                    <div class="stats">
                        <i class="pe-7s-angle-left-circle"></i> <a href="#" onclick="config.Redirect('/administrador/index');"> ir atras.</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection()