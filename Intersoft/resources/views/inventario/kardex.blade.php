@extends('layout')

@section('content')

<?php 

$referencia = App\Referencias::where('id','=',$kardex[0]->id_referencia->id)->first();

?>


<div class="enc-article">
    <h4 class="title">Kardex <small style="color:#99f;">Código: </small> {{ $referencia->codigo_linea . $referencia->codigo_letras . $referencia->codigo_consecutivo}}</h4>
</div>


<br><br><br>
<div class="row top-11-w">
  <div class="col-md-11 row" style="overflow-x:scroll;margin-left:2%">
    <p>Información de kardex para el producto <h4 class="title">Saldo: {{ $referencia->saldo }}</h4></p>
    <table class="table table-hover table-striped" id="datos">
        <thead>
        <tr>
            <th>Id</th>
            <th>Documento</th>
            <th>Sucursal</th>
            <th>#</th>
            <th>Tercero</th>
            <th>cantidad</th>
            <th>Saldo</th>
        </tr></thead>
        <tbody>
            <tr>
                <td>0</td>
                <?php $cont = 0; $total = 0; ?>
                <td>na</td>
                <td>na</td>
                <td>na</td>
                <td>{{ $cont }}</td>
                <td>{{ $total }}</td>
                <td>0</td>
            </tr>
           @foreach( $kardex as $obj )
           <?php 

           if($obj->signo == "+"){
                   $cont = $cont + $obj->cantidad;
                   $total = $total + ( -($obj->total*2)+ $obj->total);
           }
           else if($obj->signo == "-"){
                   $cont = $cont - $obj->cantidad;
                   $total = $total - ( -($obj->total*2)+ $obj->total);
           }
           else{
                   $cont = $cont;
                   $total = $total;
           }

           ?>
               <td>{{ $obj->id }}</td>
               <td>{{ $obj->id_documento->nombre }} {{ ' Pref. '. $obj->prefijo }}</td>
               <td>{{ $obj->id_sucursal->nombre }}</td>
               <td><a href="javascript:envioUrl('/documentos/imprimir/{{ $obj->cabecera[0]->id }}')">{{ $obj->numero }}</a></td>
               <td>{{ $obj->cabecera[0]->id_tercero }}</td>
               <td>{{ number_format($obj->cantidad) }}</td>
               <td>{{ number_format($cont) }}</td>	
            </tr>
           @endforeach
        </tbody>
        {{ $kardex->links() }}
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

<script language=javascript>
function envioUrl (url){
window.open(url, "imprimir documento", "width=600, height=500")
}
</script>


@endsection()