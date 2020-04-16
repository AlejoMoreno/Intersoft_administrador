@extends('layout')

@section('content')

<?php 

use App\Documentos;
$documentos = Documentos::where('ubicacion','=','ENTRADA')
                        ->where('id_empresa','=',Session::get('id_empresa'))->get();

use App\Referencias;
$referencias = Referencias::where('id_empresa','=',Session::get('id_empresa'))->get();

use App\Lotes;
$lotes = Lotes::where('id_empresa','=',Session::get('id_empresa'))->get();

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="header">
                    <h4 class="title">Inventario</h4>
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
                    <h4 class="title">Sub menu Inventario</h4>
                    <p class="category">Elige que quieres hacer</p>
                </div>
                <div class="content">
                    <div> 
                    <table class="table table-hover table-striped">
                                    <thead>
                                        <tr><th></th>
                                        <th>Opcion</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr></thead>
                                    <tbody>
                                        <tr onclick="config.Redirect('/inventario/referencias');">
                                            <td><img width="30" src="/assets/138226.svg"></td>
                                            <td>Referencias</td>
                                            <td><?php  echo sizeof($referencias); ?></td></a>
                                            <td><img width="20" onclick="config.Redirect('inventarios/searchProductos.html');" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/inventario/lotes');">
                                            <td><img width="30" src="/assets/272429.svg"></td>
                                            <td>Lotes</td>
                                            <td><?php  echo sizeof($lotes); ?></td>
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/inventario/cierreInventario');">
                                            <td><img width="30" src="/assets/138213.svg"></td>
                                            <td>Cierre de Inventario</td>
                                            <td>?</td>
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/inventario/catalogo');">
                                            <td><img width="30" src="/assets/296383.svg"></td>
                                            <td>Catálogo</td>
                                            <td>?</td>
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        @foreach ($documentos as $obj)
                                            <?php 
                                            if($obj["signo"]=='+'){
                                                $signo = "mas";
                                            }
                                            elseif($obj["signo"]=='-'){
                                                $signo = "menos";
                                            }
                                            else{
                                                $signo = "igual";
                                            }
                                            $url = '/documentos/documento?signo='.$signo.'&nombre='.$obj['nombre'].'&id='.$obj['id'].'&prefijo='.$obj['prefijo'].'&numero='.$obj['num_presente'];?> 
                                            <tr>
                                                <td><a href="{{ $url }}" target="_blank"><img width="30" src="/assets/138212.svg"></a></td>
                                                <td><a href="{{ $url }}">{{ $obj['nombre'] }}</a></td>
                                                <td></td>
                                                <?php $urlconsulta = '/documentos/consultar/'.$obj['id']; ?>
                                                <td><a href="{{ $urlconsulta }}" class="btn btn-default">Consultar</a></td>
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
                            <i class="pe-7s-angle-left-circle"></i> <a href="#" onclick="config.Redirect('/index');"> ir atras.</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection()