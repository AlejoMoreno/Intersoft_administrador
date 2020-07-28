@extends('layout')

@section('content')


<div class="enc-article">
    <h4 class="title">Consulta de documentos</h4>
</div>

<div class="row top-11-w">
    <br><br>
    <p style="font-size:10pt;font-family:Poppins;margin-left:2%">Filtros de busqueda:</p>
    <div class="col-md-12"> 
        <form method="GET" class="row">
            <div class="col-md-2">
                <input type="text" name="nit" placeholder="Nit" class="form-control">
            </div>
            <div class="col-md-4">
                <div class="col-md-12 row">
                    <div class="col-md-8">
                        <input type="text" name="razonsocial" placeholder="Razón social" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <select class="form-control" name="vendedor"> 
                            <option value="">Vendedor</option>
                            @foreach ($usuarios as $obj)
                            <option value="{{ $obj['id'] }}">{{ $obj['nombre'] }} {{ $obj['apellido'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 row">
                <div class="col-md-6">
                    <input type="date" name="fechainicio" class="form-control">
                </div>
                <div class="col-md-6">
                    <input type="date" name="fechafinal" class="form-control">
                </div>
            </div>
            <div class="col-md-2">
                <input type="submit" value="Consultar" class="btn btn-success">
            </div>
        </form><br><br>
    </div>
    <div class="col-md-11" style="overflow-x:scroll;margin-left:2%">
        <table class="table table-hover table-striped"  id="datos">
            <thead>
                <th>Documento</th>
                <th>Sucursal</th>
                <th>#</th>
                <th>Nit</th>
                <th>Nombre</th>
                <th>Fecha Emisión</th>
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
                <th>Vendedor</th>
                <th>Fecha creado</th>
                <th></th>
                <th></th>
            </tr></thead>
            <tbody>
                @foreach($factura as $obj)
                <tr>
                    <td>{{ $obj['nombre'] }} {{ $obj['prefijo'] }}</td>
                    <td><div style="width: 150px;">{{ $obj['sucunombre'] }}</div></td>
                    <td><a href="javascript:envioUrl('/documentos/imprimir/{{ $obj['idfactura'] }}')" >{{ $obj['numero'] }}</a></td>
                    <td>{{ $obj['id_tercero'] }}</td>
                    <td><div style="width: 200px;">{{ $obj['nombrecliente'] }}</div></td>
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
                    <td>{{ $obj['nombrevendedor'] }} {{ $obj['apellido'] }}</td>
                    <td><div style="width: 150px;">{{ $obj['creado'] }}</div></td>
                    <td><div onclick="config.anular('factura','{{ $obj }}')" href="/documentos/anular/{{ $obj['idfactura'] }}" class="btn btn-warning"><i style="font-size: 12px;" class="fas fa-ban"></i></div></td>
                    <td><div onclick="config.eliminar('factura','{{ $obj }}')" href="/documentos/eliminar/{{ $obj['idfactura'] }}" class="btn btn-danger"><i style="font-size: 12px;" class="fas fa-trash"></i></div></td>
                </tr>
                @endforeach                                
            </tbody>
        </table>
    </div>
    
</div>



<script language=javascript>

$(document).ready( function () {
    $('#datos').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ] 
    });
} );

function envioUrl (url){
window.open(url, "imprimir documento", "width=800, height=700")
}
</script>

@endsection()

