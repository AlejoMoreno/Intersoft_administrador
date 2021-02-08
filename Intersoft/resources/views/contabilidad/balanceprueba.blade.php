@extends('layout')

@section('content')


<style>
span{
    color: black;
    font-size: 10pt;
    text-align: right;
}
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
.table > tbody td{
    color: black;
}
</style>

<div class="enc-article">
    <h4 class="title">Balance de prueba</h4>
</div>

<div class="row top-11-w">
    <div class="card" style="margin:3%;">
        <form class="header row" style="background:white">
            <div class="col-md-3">
                <label>Desde:</label>
                <select name="desde" class="form-control">
                    @foreach ($cierres as $item)
                        <option value="{{ $item->fecha }}">{{ $item->fecha }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label style="width: 100%;">Hasta:</label>
                <input placeholder="2021" value="2021" name="ano" class="form-control" style="width: 50%;float: left;">
                <select name="mes" class="form-control" style="width: 50%;">
                    <option value="1">Enero</option>
                    <option value="2">Febrero</option>
                    <option value="3">Marzo</option>
                    <option value="4">Abril</option>
                    <option value="5">Mayo</option>
                    <option value="6">Junio</option>
                    <option value="7">Julio</option>
                    <option value="8">Agosto</option>
                    <option value="9">Septiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>
                </select>
            </div>
            <div class="col-md-3">
                <label>Terceros:</label>
                <select name="terceros" class="form-control">
                    <option value="CON">IMPRIMIR CON TERCEROS</option>
                    <option value="SIN">IMPRIMIR SIN TERCEROS</option>
                </select>
            </div>
            <div class="col-md-3">
                <label>Formato:</label>
                <select name="formato" class="form-control">
                    <option value="BALANCE DE PRUEBA">BALANCE DE PRUEBA</option>
                    <option value="BALANCE COMERCIAL">BALANCE COMERCIAL</option>
                    <option value="HOJA DE TRABAJO">HOJA DE TRABAJO</option>
                </select>
            </div>
            <div class="col-md-4"><br>
                <button onclick="ir()" class="btn btn-success">Consultar</button>
            </div>
        </form>
        <div style="margin:2%;">
            
            <div id="hoja_de_trabajo_sin_terceros">
                <h4 style="text-align: center"> H O J A    D E   T R A B A J O </h4>
                <br>
                <h5 style="text-align: center">BALANCE DE PRUEBA CORRESPONDIENTE A         OCTUBRE    DE 2020 <h5>
                <br>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>NOMBRE DEL CONCEPTO</th>
                            <th>SALDO ANTERIOR</th>
                            <th>VALOR</th>
                            <th>NATURALEZA</th>
                            <th>NUEVO SALDO</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contabilidades as $item)
                        <tr>
                            <td>{{ $item->id_auxiliar }}</td>
                            <td>{{ $item->tercero }}</td>
                            <td>{{ $item->movimiento }}</td>
                            <td>{{ $item->tipo_transaccion }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                                                                

            </div>
            
        </div>
            
            
    </div>
    
</div>


<script>
    $(document).ready( function () {
        $('#data').hide();
        $('#data').DataTable({
            dom: 'Bfrtip',
            bPaginate: false,
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ] 
        });
    } );
  </script>
@endsection()