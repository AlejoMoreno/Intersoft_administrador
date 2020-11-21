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
    <h4 class="title">Libros Auxiliares</h4>
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
                    <option value="1">Detalle y resumen</option>
                    <option value="2">Solo resumen</option>
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
                        <th style="width: 10%;">Código Contable</th>
                        <th>Nit</th>
                        <th>Documento</th>
                        <th>Debito</th>
                        <th>Credito</th>
                        <th>Saldo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $debito=0;$credito=0;?>
                    @for($i=0;$i<sizeof($data);$i++)
                    <?php $obj = $data[$i]; ?>
                        <tr>
                            <td style="background: #ddd">{{ $obj['codigo'] }} <br>{{ $obj['descripcion'] }}</td>                            
                            <td><br>{{ $obj['nit'] }}<br> {{ $obj['razon_social'] }}</td>
                            <?php 
                                if($obj['tipo_transaccion']=='D'){
                                    $debito = $debito + $obj['valor_transaccion'];
                                }
                                else{
                                    $credito = $credito + $obj['valor_transaccion'];
                                }
                                
                            ?>
                            <td >{{ $obj['tipo_documento'] }} {{ $obj['prefijo'] }} {{ $obj['numero_documento'] }} {{ $obj['fecha_documento'] }}</td>
                            <td>{{ ($obj['tipo_transaccion']=='D')?$obj['valor_transaccion']:0 }}</td>
                            <td>{{ ($obj['tipo_transaccion']=='C')?$obj['valor_transaccion']:0 }}</td>
                            <td>0</td>
                        </tr>
                    @endfor
                </tbody>
            </table>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th style="width: 10%;">Código Contable</th>
                        <th>Nit</th>
                        <th>Documento</th>
                        <th>Debito</th>
                        <th>Credito</th>
                        <th>Saldo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $debito=0;$credito=0;?>
                    @for($i=0;$i<sizeof($data);$i++)
                    <?php 
                    if($i != 0){
                        $ant = $data[$i -1];
                    }
                    $obj = $data[$i];
                    ?>
                        <tr>
                            @if(isset($ant))
                                @if($ant['codigo'] != $obj['codigo'])
                                <?php $debito=0;$credito=0;?>
                                <td colspan="6"  style="background: #ddd">{{ $obj['codigo'] }} <br>{{ $obj['descripcion'] }}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                @endif
                            @else
                            <td colspan="6" style="background: #ddd">{{ $obj['codigo'] }} <br>{{ $obj['descripcion'] }}</td></tr><tr><td></td>
                            @endif
                            
                            @if(isset($ant))
                                @if($ant['nit'] != $obj['nit'])
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td style="background: #ddd;color:red;font-size: 12pt;">{{ number_format($debito, 0, ",", ".") }}</td>
                                    <td style="background: #ddd;color:red;font-size: 12pt;">{{ number_format($credito, 0, ",", ".") }}</td>
                                    <td>0</td>
                                </tr>
                                <td></td>
                                <td colspan="6"><br>{{ $obj['nit'] }}<br> {{ $obj['razon_social'] }}</td></tr><td></td>
                                @else
                                <td></td>
                                @endif
                            @else
                            <td colspan="6"><br>{{ $obj['nit'] }}<br> {{ $obj['razon_social'] }}</td></tr><td></td>
                            @endif
                            
                            <?php 
                                if($obj['tipo_transaccion']=='D'){
                                    $debito = $debito + $obj['valor_transaccion'];
                                }
                                else{
                                    $credito = $credito + $obj['valor_transaccion'];
                                }
                                
                            ?>
                            <td></td>
                            <td >{{ $obj['tipo_documento'] }} {{ $obj['prefijo'] }} {{ $obj['numero_documento'] }} {{ $obj['fecha_documento'] }}</td>
                            <td>{{ ($obj['tipo_transaccion']=='D')? number_format($obj['valor_transaccion'], 0, ",", "."):0 }}</td>
                            <td>{{ ($obj['tipo_transaccion']=='C')? number_format($obj['valor_transaccion'], 0, ",", "."):0 }}</td>
                            <td>0</td>
                        </tr>
                    @endfor
                </tbody>
            </table>
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