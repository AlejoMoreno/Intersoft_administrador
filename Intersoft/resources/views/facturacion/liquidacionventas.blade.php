@extends('layout')

@section('content')


<div class="container-fluid">
    <div class="row">
        
        <div class="col-md-4">
            <div class="card">
                <div class="header">
                    <h4 class="title">Usuarios</h4>
                    <p class="category">Elige el usuario a consultar</p>
                </div>
                <div class="content">
                    <div class="row">

                        <input type="number" id="valor" name="valor" placeholder="porcentaje (%) comisión" class="form-control"><br>
                        
                        @foreach($usuarios as $obj)
                        <div class="col-md-12">
                            <div class="btn-success" style="padding:3%;color:white;" onclick="verUsuarioVentas({{ $obj['id'] }})">
                                {{ $obj['ncedula'] }} / {{ $obj['correo'] }}
                            </div>
                        </div>
                        @endforeach
                        
                    </div>
                    <div class="footer">
                        <div class="legend">
                            <i class="fa fa-circle text-info"></i> 
                            <i class="fa fa-circle text-danger"></i> 
                            <i class="fa fa-circle text-warning"></i>
                        </div>
                        <hr>
                        <div class="stats">
                            <i class="pe-7s-angle-left-circle"></i> <a href="#" onclick="config.Redirect('/submenu/facturacion');"> ir atras.</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-8">
            <div class="card">
                <div class="header">
                    <h4 class="title">Facturas</h4>
                    <p class="category">Elige las facturas para usuario</p>
                </div>
                <div class="content">
                    <div style="overflow-x:scroll;overflow-y:scroll;height:300px;">
                    <table class="table table-hover table-striped"  id="datos">
                            <thead>
                            <tr>
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
                            </tr></thead>
                            <tbody>
                            
                                @if($facturas!=null)
                                <?php  $total = 0; ?>
                                    @foreach($facturas as $obj)
                                    <?php $total = $total + ( ($obj['subtotal']*$valor)/100 );  ?>
                                    <tr>
                                        <td>{{ $obj['id_documento']['nombre'] }} {{ $obj->prefijo }}</td>
                                        <td>{{ $obj['id_sucursal']['nombre'] }}</td>
                                        <td><a href="javascript:envioUrl('/documentos/imprimir/{{ $obj['id'] }}')" class="btn btn-success">{{ $obj['numero'] }}</a></td>
                                        <td>{{ $obj['id_tercero'] }}</td>
                                        <td>{{ $obj['id_cliente']['razon_social'] }}</td>
                                        <td>{{ $obj['fecha'] }}</td>
                                        <td>{{ $obj['fecha_vencimiento'] }}</td>
                                        <td>{{ number_format($obj['subtotal']) }}</td>
                                        <td>{{ number_format($obj['iva']) }}</td>
                                        <td>{{ number_format($obj['impoconsumo']) }}</td>
                                        <td>{{ number_format($obj['otro_impuesto']) }}</td>
                                        <td>{{ number_format($obj['otro_impuesto_1']) }}</td>
                                        <td>{{ number_format($obj['descuento']) }}</td>
                                        <td>{{ number_format($obj['fletes']) }}</td>
                                        <td>{{ number_format($obj['retefuente']) }}</td>
                                        <td>{{ number_format($obj['total']) }}</td>
                                        <td>{{ number_format($obj['saldo']) }}</td>
                                        <td>{{ $obj['estado'] }}</td>
                                        <td>{{ $obj['created_at'] }}</td>
                                        <td>{{ $obj['updated_at'] }}</td>
                                    </tr>
                                    @endforeach         
                                @endif                       
                            </tbody>
                        </table>
                        
                    </div>
                    <h2>Calculo total de comisión con valor {{ $valor }}(%) es: {{ $total }} </h2>
                    <div class="footer">
                        <div class="legend">
                            <i class="fa fa-circle text-info"></i> 
                            <i class="fa fa-circle text-danger"></i> 
                            <i class="fa fa-circle text-warning"></i>
                        </div>
                        <hr>
                        <div class="stats">
                            <i class="pe-7s-angle-left-circle"></i> <a href="#" onclick="config.Redirect('/submenu/facturacion');"> ir atras.</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
function verUsuarioVentas(id){
    valor = $('#valor').val();
    config.Redirect('/facturacion/liquidacionventas/'+id+'/'+valor);
}
function envioUrl(url){
    window.open(url, "imprimir documento", "width=800, height=700")
}
</script>

@endsection()

