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
    <h4 class="title">Libros Mayores</h4>
</div>

<div class="row top-11-w">
    <div class="card" style="margin:3%;">
        <form class="header row" style="background:white">
            <div class="col-md-3">
                <label>Fecha Corte:</label>
                
            </div>
            <div class="col-md-3">
                <label>Tipo Vista:</label>
                <select name="tipo" class="form-control">
                    <option value="">Seleccione tipo</option>
                    <option value="CLASES">CLASE</option>
                    <option value="GRUPOS">GRUPO</option>
                    <option value="CUENTAS">CUENTA</option>
                    <option value="SUBCUENTAS">SUB CUENTA</option>
                </select>
            </div>
            <div class="col-md-6"><br></div>
            <div class="col-md-4"><br>
                <button onclick="ir()" class="btn btn-success">Consultar</button>
            </div>
        </form>
        <div style="margin:2%;">
            <table class="table table-hover" id="data">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Debito</th>
                        <th>Credito</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $debito=0;$credito=0;?>
                    @foreach ($data as $obj)
                    <?php 
                    if($obj['tipo_transaccion'] == 'D'){
                        $debito = $debito + $obj['total'];
                    }
                    else{
                        $credito = $credito + $obj['total'];
                    }
                    ?>
                    <tr>
                        <td>{{ $obj['codigo'].'  '.$obj['descripcion'] }}</td>
                        <td>{{ ($obj['tipo_transaccion'] == 'D')? number_format($obj['total'], 0, ",", ".") : 0 }}</td>
                        <td>{{ ($obj['tipo_transaccion'] == 'C')? number_format($obj['total'], 0, ",", ".") : 0 }}</td>
                    </tr>
                    @endforeach
                    <tr style="background: #ddd;">
                        <td>Total</td>
                        <td style="font-size: 12pt;">{{ number_format($debito, 0, ",", ".") }}</td>
                        <td style="font-size: 12pt;">{{ number_format($credito, 0, ",", ".") }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
            
            
    </div>
    
</div>


<script>
    $(document).ready( function () {
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