@extends('layout')

@section('content')

<?php 

use App\Documentos;

$documentos = Documentos::where('ubicacion','=','SALIDA')->
                          where('id_empresa','=',Session::get('id_empresa'))->get();

$egresos = DB::select("SELECT sum(total) as total FROM carteras where tipoCartera like 'EGRESO' AND id_empresa = ".Session::get('id_empresa').";");
$ingresos = DB::select("SELECT sum(total) as total FROM carteras where tipoCartera like 'INGRESO' AND id_empresa = ".Session::get('id_empresa').";");
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <center><h4 class="title">Cartera</h4><br>
                    </center>
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
                        		<td><a href="/cartera/causar">Causar Facturas Externas</a></td>
                        	</tr>
                        	<tr>
                        		<td><a href="/cartera/consultar_documentos?tipo=EGRESO">Reportes</a></td>
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
                        		<td><a href="/cartera/ingresos">Hacer Ingreso</a></td>
                        	</tr>
                        	<tr>
                        		<td><a href="/cartera/causar">Causar Facturas Externas</a></td>
                        	</tr>
                        	<tr>
                        		<td><a href="/cartera/consultar_documentos?tipo=INGRESO">Reportes</a></td>
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
                        <div class="stats">
                            <i class="pe-7s-angle-left-circle"></i> <a href="#" onclick="config.Redirect('/index');"> ir atras.</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>



@endsection()