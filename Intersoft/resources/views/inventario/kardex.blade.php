@extends('layout')

@section('content')

<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Kardex <small style="color:white;">Código: </small> {{ $kardex[0]->id_referencia[0]->codigo_linea . $kardex[0]->id_referencia[0]->codigo_letras . $kardex[0]->id_referencia[0]->codigo_consecutivo}}</h4>
                    <p class="category"> <br>{{ $kardex[0]->id_referencia[0]->descripcion }} // saldo: {{ $kardex[0]->id_referencia[0]->saldo }}</p>
                </div>
                <div class="content">
                    <div style="overflow-x: scroll;"> 
                    <table class="table table-hover table-striped">
                                    <thead>
                                    <tr>
                                        <th>Documento</th>
                                        <th>Sucursal</th>
                                        <th>#</th>
                                        <th>Tercero</th>
                                        <th>cantidad</th>
                                        <th>precio compra/venta</th>
                                        <th>Saldo</th>
                                    </tr></thead>
                                    <tbody>
                                    	<?php $cont = 0; $total = 0; ?>
                                    	<tr><td></td><td></td><td></td><td>{{ $cont }}</td><td>{{ $total }}</td></tr>
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
                                       <tr>
	                                       <td>{{ $obj->id_documento[0]->nombre }} {{ ' Pref. '. $obj->prefijo }}
	                                       </td>
	                                       <td>{{ $obj->id_sucursal[0]->nombre }}</td>
	                                       <td><a href="javascript:envioUrl('/documentos/imprimir/{{ $obj->cabecera[0]->id }}')" class="btn btn-success">{{ $obj->numero }}</a></td>
	                                       <td>{{ $obj->cabecera[0]->id_tercero }}</td>
	                                       <td>{{ number_format($obj->cantidad) }}</td>
	                                       <td>{{ number_format($obj->total) }}</td>
	                                       <td>{{ number_format($cont) }}</td>	
	                                    </tr>
                                       @endforeach
                                    </tbody>
                                </table>
                            </div>
                    <div class="footer">
                        <div class="legend">
                            <i class="fa fa-circle text-info"></i> 
                            <i class="fa fa-circle text-danger"></i> 
                            <i class="fa fa-circle text-warning"></i>
                        </div>
                        <hr>
                        <div class="stats">
                            <i class="pe-7s-angle-left-circle"></i> <a href="#" onclick="window.close();"> ir atras.</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script language=javascript>
function envioUrl (url){
window.open(url, "imprimir documento", "width=600, height=500")
}
</script>


@endsection()