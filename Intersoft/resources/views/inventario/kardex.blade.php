@extends('layout')

@section('content')

<?php 

$referencia = App\Referencias::where('id','=',$id)->first();

?>


<div class="enc-article">
    <h4 class="title">
        <form action="" class="row">
            <div class="col-md-2" style="font-size:18pt">{{ $referencia->codigo_linea . $referencia->codigo_letras . $referencia->codigo_consecutivo}}</div>
            <div class="col-md-4" style="font-size:18pt">{{ $referencia->descripcion }}</div>
            <div class="col-md-4"><select name="fecha_inicio" class="form-control" style="width: 200px;">
                <option value="">Seleccione fecha cierre</option>
                @foreach ($cierre as $obj)
                <option value="{{ $obj['fecha'] }}">{{ $obj['fecha'] }}</option>
                @endforeach
            </select></div>
            <div class="col-md-2"><input type="submit" value="consultar" name="consultar"></div>
        </form>
        
        
        
    </h4>
</div>


<br><br><br>
<div class="row top-11-w">
  <div class="col-md-11 row" style="overflow-x:scroll;margin-left:2%">
    <p>Información de kardex para el producto <h4 class="title">Saldo: {{ $referencia->saldo }}  </h4></p>
    <table class="table table-hover table-striped" id="datos">
        <thead>
        <tr>
            <th>Transacción</th>
            <th>Fecha</th>
            <th>#</th>
            <th>Tercero</th>
            <th>cantidad</th>
            <th>Saldo</th>
        </tr></thead>
        <tbody>
            <tr>
                @if(isset($saldocierre))
                <?php 
                    if($saldocierre->saldo == null){
                        $cont = 0; $total = 0; 
                    }
                    else{
                        $cont = 0; $total = $saldocierre->saldo; 
                    }
                    
                ?>
                <td>SALDO</td>
                <td>{{  $_GET['fecha_inicio'] }}</td>
                <td>SALDO</td>
                <td>{{ $cont }}</td>
                <td>{{ $total }}</td>
                <td>0</td>
                @endif
            </tr>
            @if(isset($kardex))
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
                    <td>{{ $obj->id_documento->nombre }} {{ ' Pref. '. $obj->prefijo }}</td>
                    <td>{{ $obj->fecha }}</td>
                    <td><a href="javascript:envioUrl('/documentos/imprimir/{{ $obj->cabecera[0]->id }}')">{{ $obj->numero }}</a></td>
                    <td>{{ $obj->cabecera[0]->id_tercero }}</td>
                    <td>{{ number_format($obj->cantidad) }}</td>
                    <td>{{ number_format($cont) }}</td>	
                    </tr>
                @endforeach
            @endif
           
        </tbody>
    </table>

  </div>
  
</div>


<script language=javascript>
function envioUrl (url){
window.open(url, "imprimir documento", "width=600, height=500")
}
</script>


@endsection()