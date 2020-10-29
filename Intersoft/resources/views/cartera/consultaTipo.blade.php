@extends('layout')

@section('content')


<div class="enc-article">
    <h4 class="title">Consulta de {{ $tipo }}</h4>
</div>

<div class="row top-11-w">
    <br><br>
    <p style="font-size:10pt;font-family:Poppins;margin-left:2%">Filtros de busqueda:</p>
    <div class="col-md-12"> 
        <form method="GET" class="row">
            <div class="col-md-2">
                <input type="text" name="nit" placeholder="Nit" value="{{ isset($_GET['nit'])?$_GET['nit']:'' }}" class="form-control">
            </div>
            <div class="col-md-4">
                <div class="col-md-12 row">
                    <div class="col-md-8">
                        <input type="text" name="razonsocial" value="{{ isset($_GET['razonsocial'])?$_GET['razonsocial']:'' }}" placeholder="Razón social" class="form-control">
                    </div>
                    
                </div>
            </div>
            
            <div class="col-md-4 row">
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
    <div class="col-md-11" style="overflow-x:scroll;margin-left:2%">
        <table class="table table-hover table-striped"  id="datos">
            <thead>
                <th>Tipo Cartera</th>
                <th>Prefijo</th>
                <th>Número</th>
                <th>Tercero</th>
                <th>Fecha</th>
                <th>Total</th>
            </tr></thead>
            <tbody>
                @foreach($documento as $obj)
                <tr>
                    <td>{{ $obj['tipoCartera'] }}</td>
                    <td>{{ $obj['prefijo'] }}</td>
                    <td><a href="/cartera/imprimir/{{ $obj['idcartera'] }}"> {{ $obj['numero'] }} </a></td>
                    <td>{{ $obj['nit_cliente'] }} {{ $obj['nombre_cliente'] }}</td>
                    <td>{{ $obj['fecha'] }}</td>
                    <td style="text-align: right"><?php echo number_format($obj['total'], 0, ",", ".");?></td>
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

