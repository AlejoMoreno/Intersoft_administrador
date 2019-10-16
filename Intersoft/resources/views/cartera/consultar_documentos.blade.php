@extends('layout')

@section('content')

<?php 


?>



<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Consulta de Documentos </h4>
                    <p class="category">Elige que quieres hacer</p>
                </div>
                <div class="content">
                    <div style="width: 100%;overflow: scroll;"> 
                        <table class="table table-hover table-striped"  id="datos">
                            <thead>
                                <th>id_sucursal</th>
								<th>numero</th>
								<th>prefijo</th>
								<th>id_cliente</th>
								<th>id_vendedor</th>
								<th>fecha</th>
                                <th>reteiva</th>
								<th>reteica</th>
								<th>efectivo</th>
								<th>sobrecosto</th>
								<th>descuento</th>
								<th>retefuente</th>
								<th>otros</th>								
								<th>tipoCartera</th>
								<th>subtotal</th>
								<th>total</th>
								<th>estado</th>
                                <th></th>
                                <th></th>
                            </tr></thead>
                            <tbody>
                                @foreach($carteras as $obj)
                                <tr>
                                    <td>{{ $obj->id_sucursal }}</td>
                                    <td><a href="javascript:envioUrl('/cartera/imprimir/{{ $obj->id }}')" class="btn btn-success">{{ $obj->numero }}</a></td>
                                    <td>{{ $obj->prefijo }}</td>
                                    <td>{{ $obj->id_clienteid_cliente }}</td>
                                    <td>{{ $obj->id_vendedor }}</td>
                                    <td>{{ $obj->fecha }}</td>
                                    <td>{{ number_format($obj->reteiva) }}</td>
                                    <td>{{ number_format($obj->reteica) }}</td>
                                    <td>{{ number_format($obj->efectivo) }}</td>
                                    <td>{{ number_format($obj->sobrecosto) }}</td>
                                    <td>{{ number_format($obj->descuento) }}</td>
                                    <td>{{ number_format($obj->retefuente) }}</td>
                                    <td>{{ number_format($obj->otros) }}</td>
                                    <td>{{ $obj->tipoCartera }}</td>
                                    <td>{{ number_format($obj->subtotal) }}</td>
                                    <td>{{ number_format($obj->total) }}</td>
                                    <td>{{ $obj->estado }}</td>
                                    <td><div onclick="config.anular('cartera','{{ $obj }}')" href="/cartera/anular/{{ $obj->id }}" class="btn btn-warning">> Anular</div></td>
                                    <td><div onclick="config.eliminar('cartera','{{ $obj }}')" href="/cartera/eliminar/{{ $obj->id }}" class="btn btn-danger">X Eliminar</div></td>
                                </tr>
                                @endforeach                                
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
                            <i class="pe-7s-angle-left-circle"></i> <a href="#" onclick="config.Redirect('/index');"> ir atras.</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script language=javascript>
function envioUrl (url){
window.open(url, "imprimir documento", "width=600, height=500")
}
</script>

@endsection()

