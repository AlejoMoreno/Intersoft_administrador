@extends('layout')

@section('content')

<?php 

use App\Documentos;
$documentos = Documentos::where('ubicacion','=','SALIDA')->get();


?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <center><h4 class="title">Cartera</h4><br><label>Total: $ 108980</label></center>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="header">
                    <h4 class="title">Egresos</h4>
                    <p class="category">Elige que quieres hacer</p>
                </div>
                <div class="content">
                	<table class="table table-hover table-striped">
                        <thead>
                            <tr>
                            	<th>Opción</th>
                        	</tr>
                        </thead>
                        <tbody>
                        	<tr>
                        		<td><a href="/cartera/egresos">Hacer Egreso</a></td>
                        	</tr>
                        	<tr>
                        		<td><a>Causar Facturas Externas</a></td>
                        	</tr>
                        	<tr>
                        		<td><a>Reportes</a></td>
                        	</tr>
                        </tbody>
                    </table>
                    <div class="footer">
                        <div class="legend">
                            <i class="fa fa-circle text-info"></i> 
                            <i class="fa fa-circle text-danger"></i> 
                            <i class="fa fa-circle text-warning"></i>
                        </div>
                        <hr>
                        <label>Total $ 10000</label><br>
                        <div class="stats">
                            <i class="pe-7s-angle-left-circle"></i> <a href="#" onclick="config.Redirect('/layout');"> ir atras.</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="header">
                    <h4 class="title">Ingresos</h4>
                    <p class="category">Elige que quieres hacer</p>
                </div>
                <div class="content">
                	<table class="table table-hover table-striped">
                        <thead>
                            <tr>
                            	<th>Opción</th>
                        	</tr>
                        </thead>
                        <tbody>
                        	<tr>
                        		<td><a>Hacer Ingreso</a></td>
                        	</tr>
                        	<tr>
                        		<td><a>Causar Facturas Externas</a></td>
                        	</tr>
                        	<tr>
                        		<td><a>Reportes</a></td>
                        	</tr>
                        </tbody>
                    </table>
                    <div class="footer">
                        <div class="legend">
                            <i class="fa fa-circle text-info"></i> 
                            <i class="fa fa-circle text-danger"></i> 
                            <i class="fa fa-circle text-warning"></i>
                        </div>
                        <hr>
                        <label>Total $ 10000</label><br>
                        <div class="stats">
                            <i class="pe-7s-angle-left-circle"></i> <a href="#" onclick="config.Redirect('/layout');"> ir atras.</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>



@endsection()