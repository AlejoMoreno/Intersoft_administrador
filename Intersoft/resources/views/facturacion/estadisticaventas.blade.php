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

    .container {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  padding: 0 10px;
}
 
#dt-table_wrapper {
  width: 35%;
  margin-right: 2%;
}
 
#chart {
  width: 63%;
}
 
table {
  text-align: left;
}
 
@media screen and (max-width: 1200px) {
  #dt-table_wrapper,
  #chart {
    width: 100%;
  }
 
  #dt-table_wrapper {
    margin-right: 0;
  }
}
</style>
    

<div class="enc-article">
    <h4 class="title">Estadisticas de ventas</h4>
</div>

<div class="row top-11-w" style="padding:2%;">

    <div class="panel panel-default col-md-5" >
        <!-- Default panel contents -->
        <div class="panel-heading row"><h5>Filtros de busqueda</h5></div>
        <div class="panel-body" >
            <p style="font-size: 10pt;">A contiuación se describe la lista de usuarios y demás datos 
                para el filtro de busqueda.
            </p>
        </div>
        <form class="row" method="GET" action="">
            <label class="col-md-2">Desde:</label>
            <div class="col-md-4">
                <input type="date" name="fecha_inicio" value="{{ isset($_GET['fecha_inicio'])?$_GET['fecha_inicio']:date('Y-m-d') }}" class="form-control">
            </div>
            <label class="col-md-2">Hasta:</label>
            <div class="col-md-4">
                <input type="date" name="fecha_fin" value="{{ isset($_GET['fecha_fin'])?$_GET['fecha_fin']:date('Y-m-d') }}" class="form-control">
            </div>
            <label class="col-md-2">Linea:</label>
            <div class="col-md-10">
                <select class="form-control" name="linea[]" multiple="multiple">
                    @foreach ($lineas as $obj)
                        <option value="{{ $obj->id }}">{{ $obj->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <label class="col-md-2">Usuario:</label>
            <div class="col-md-10">
                <select class="form-control" name="usuario[]" multiple="multiple">
                    @foreach ($usuarios as $obj)
                        <option value="{{ $obj->id }}">{{ $obj->nombre }} / {{ $obj->ncedula }}</option>
                    @endforeach
                </select>
            </div>
            <label class="col-md-2">Documento:</label>
            <div class="col-md-10">
                <select class="form-control" name="documento[]" multiple="multiple">
                    @foreach ($documentos as $obj)
                        <option value="{{ $obj->id }}">{{ $obj->nombre }}</option>
                    @endforeach
                </select>
            </div><br>
            <div class="col-md-12">
                <input type="submit" value="Consultar" class="btn btn-success">
                <br><br>
            </div>
        </form>

        
    </div>

    <div class="col-md-7 row">
        <div class="panel panel-warning col-md-12" >
            <!-- Default panel contents -->
            <div class="panel-heading row" >
                <h5 class="col-md-12">Resultado busqueda</h5>            
            </div>
            <div class="panel-body" >
                <p>
                    Colocar algun filtro de busqueda
                </p>
                <div style="overflow-x:scroll;">
                    <table class="table table-hover" id="datos">
                        <thead>
                            <tr>
                                <th>Ncedula</th>
                                <th>Nombre</th>                                 
                                <th>Linea</th> 
                                <th>Referencia</th> 
                                <th>Precio Und.</th> 
                                <th>Cantidad</th>
                                <th>Total</th>
                                <th>Documento</th> 
                                <th>Número</th> 
                                <th>Nit cliente</th> 
                                <th>Razón social</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @if($kardex!=null)
                                @foreach ($kardex as $obj)
                                    <tr>
                                        <td style="background: #ededed">{{ $obj['ncedula'] }}</td>
                                        <td style="background: #ededed">{{ $obj['usuarionombre'] }}</td>                                    
                                        <td>{{ $obj['lineasdescripcion'] }}</td>
                                        <td>{{ $obj['referenciasdescripcion'] }}</td>
                                        <td>{{ $obj['precio'] }}</td>
                                        <td>{{ $obj['cantidad'] }}</td>
                                        <td>{{ $obj['preciototal'] }}</td>
                                        <td style="background: #b7deed">{{ $obj['documentosnombre'] }}</td>
                                        <td style="background: #b7deed">{{ $obj['numero'] }} {{ $obj['prefijo'] }}</td>
                                        <td style="background: #b7deed">{{ $obj['nit'] }}</td>
                                        <td style="background: #b7deed">{{ $obj['razon_social'] }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div id="chart"></div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    $(document).ready( function () {
        $('#datos').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ] 
        });
    });
</script>    


@endsection()

