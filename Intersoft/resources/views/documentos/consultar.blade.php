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
                                <th>Documento</th>
                                <th>Sucursal</th>
                                <th>#</th>
                                <th>Tercero</th>
                                <th>Nombre</th>
                                <th>Fecha ___Emisión___</th>
                                <th>Fecha Vencimiento</th>
                                <th>subtotal</th>
                                <th>iva</th>
                                <th>impoconsumo</th>
                                <th>impuesto 1</th>
                                <th>impuesto 2</th>
                                <th>descuento</th>
                                <th>fletes</th>
                                <th>retefuente</th>
                                <th>total</th>
                                <th>Saldo Cartera</th>
                                <th>Estado</th>
                                <th>Fecha creado</th>
                                <th>Fecha Actualizado</th>
                                <th></th>
                                <th></th>
                            </tr></thead>
                            <tbody>
                                @foreach($factura as $obj)
                                <tr>
                                    <td>{{ $obj->id_documento[0]->nombre }} {{ $obj->prefijo }}</td>
                                    <td>{{ $obj->id_sucursal[0]->nombre }}</td>
                                    <td><a href="javascript:envioUrl('/documentos/imprimir/{{ $obj->id }}')" class="btn btn-success">{{ $obj->numero }}</a></td>
                                    <td>{{ $obj->id_tercero }}</td>
                                    <td>{{ $obj->id_cliente[0]->razon_social }}</td>
                                    <td>{{ $obj->fecha }}</td>
                                    <td>{{ $obj->fecha_vencimiento }}</td>
                                    <td>{{ number_format($obj->subtotal) }}</td>
                                    <td>{{ number_format($obj->iva) }}</td>
                                    <td>{{ number_format($obj->impoconsumo) }}</td>
                                    <td>{{ number_format($obj->otro_impuesto) }}</td>
                                    <td>{{ number_format($obj->otro_impuesto_1) }}</td>
                                    <td>{{ number_format($obj->descuento) }}</td>
                                    <td>{{ number_format($obj->fletes) }}</td>
                                    <td>{{ number_format($obj->retefuente) }}</td>
                                    <td>{{ number_format($obj->total) }}</td>
                                    <td>{{ number_format($obj->saldo) }}</td>
                                    <td>{{ $obj->estado }}</td>
                                    <td>{{ $obj->created_at }}</td>
                                    <td>{{ $obj->updated_at }}</td>
                                    <td><div onclick="config.anular('factura','{{ $obj }}')" href="/documentos/anular/{{ $obj->id }}" class="btn btn-warning">> Anular</div></td>
                                    <td><div onclick="config.eliminar('factura','{{ $obj }}')" href="/documentos/eliminar/{{ $obj->id }}" class="btn btn-danger">X Eliminar</div></td>
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

