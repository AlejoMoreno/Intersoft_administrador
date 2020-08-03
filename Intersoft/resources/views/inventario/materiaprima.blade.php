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
</style>

<div class="enc-article">
    <h4 class="title">Materia Prima</h4>
</div>

<div class="row top-5-w">
<p style="font-size:10pt;font-family:Poppins;margin-left:2%">En esta sección se detallan los productos de constituidos como 
materia prima, para la creación de productos.</p>
    <div class="col-md-11" style="overflow-x:scroll;margin-left:2%">
        <table class="table table-hover table-striped" id="datos">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Descripcion</th>
                    <th>Cantidad</th>
                    <th>Costo</th>
                    <th>Costo Promedio</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($referencias as $obj)
                    <tr>
                        <td>{{ $obj['codigo_linea']['id']}}{{ $obj['codigo_letras']}}{{ $obj['codigo_consecutivo'] }}</td>
                        <td>{{ $obj['descripcion'] }}</td>
                        <td>{{ $obj['saldo'] }}</td>
                        <td>{{ $obj['costo'] }}</td>
                        <td>{{ $obj['costo_promedio'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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
} );
</script>


@endsection()