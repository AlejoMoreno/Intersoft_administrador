@extends('layout')

@section('content')

<?php 

use App\Documentos;
$documentos = Documentos::where('ubicacion','=','SALIDA')->
                          where('id_empresa','=',Session::get('id_empresa'))->get();


?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="header">
                    <h4 class="title">Facturación</h4>
                    <p class="category">Nota: Las imagenes que se muestran a continuación representan un link a donde podrás viajar por intersoft.</p>
                </div>
                <div class="content">
                    

                    <div class="footer">
                        <div class="legend">
                            <i class="fa fa-circle text-info"></i> 
                            <i class="fa fa-circle text-danger"></i> 
                            <i class="fa fa-circle text-warning"></i> 
                        </div>
                        <hr>
                        <div class="stats">
                            <i class="fa fa-clock-o"></i> Ir a la sección del manual
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="header">
                    <h4 class="title">Sub menu Facturación</h4>
                    <p class="category">Elige que quieres hacer</p>
                </div>
                <div class="content">
                    <div> 
                    <table class="table table-hover table-striped">
                                    <thead>
                                        <tr><th></th>
                                        <th>Opcion</th>
                                        <th></th>
                                    </tr></thead>
                                    <tbody>
                                        @foreach ($documentos as $obj)
                                        
                                            <?php 
                                            $num = 0;
                                            if($obj["signo"]=='+'){
                                                $signo = "mas";
                                            }
                                            elseif($obj["signo"]=='-'){
                                                $signo = "menos";
                                            }
                                            else{
                                                $signo = "igual";
                                            }
                                            if($obj['nombre']=="MAYORISTA"){
                                                $num  = $obj['num_presente'];
                                            }
                                            $url = '/documentos/documento?signo='.$signo.'&nombre='.$obj['nombre'].'&id='.$obj['id'].'&prefijo='.$obj['prefijo'].'&numero='.$obj['num_presente'];?> 
                                            <tr>
                                                <td><a href="{{ $url }}" target="_blank"><img width="30" src="/assets/138212.svg"></a></td>
                                                <td><a href="{{ $url }}">{{ $obj['nombre'] }} <small style="color:black;">Prefijo:</small> {{ $obj['prefijo'] }}</a></td>
                                                <?php $urlconsulta = '/documentos/consultar/'.$obj['id']; ?>
                                                <td><a href="{{ $urlconsulta }}" class="btn btn-default">Consultar</a></td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td><a href="/documentos/facturaPost?signo=menos&nombre=MAYORISTA&id=34&prefijo=NA&numero=<?php echo $num;?>" target="_blank"><img width="30" src="https://image.flaticon.com/icons/svg/138/138212.svg"></a></td>
                                            <td><a href="/documentos/facturaPost?signo=menos&nombre=MAYORISTA&id=34&prefijo=NA&numero=<?php echo $num;?>" target="_blank">TIPO POST</a></td>
                                            <?php $urlconsulta = '/documentos/consultar/'.$obj['id']; ?>
                                            <td><a href="{{ $urlconsulta }}" class="btn btn-default">Consultar</a></td>
                                        </tr>
                                        <tr onclick="config.Redirect('/submenu/inventario');">
                                            <td><img width="30" src="https://image.flaticon.com/icons/svg/2166/2166821.svg"></td>
                                            <td colspan="2">Liquidación Comisiones</td>
                                        </tr>
                                        <tr onclick="config.Redirect('/submenu/inventario');">
                                            <td><img width="30" src="https://image.flaticon.com/icons/svg/858/858699.svg"></td>
                                            <td colspan="2">Estadistica Ventas</td>
                                        </tr>
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
                            <i class="pe-7s-angle-left-circle"></i> <a href="#" onclick="config.Redirect('/index');"> ir atras.</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection()