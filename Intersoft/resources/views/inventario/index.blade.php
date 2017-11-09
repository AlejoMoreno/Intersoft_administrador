@extends('layout')

@section('content')

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
                                        <tr onclick="config.Redirect('/inventario/productos');">
                                            <td><img width="30" src="https://image.flaticon.com/icons/svg/138/138226.svg"></td>
                                            <td>Productos</td>
                                            <td>100</td></a>
                                            <td><img width="20" onclick="config.Redirect('inventarios/searchProductos.html');" src="https://image.flaticon.com/icons/svg/265/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/inventario/marcas');">
                                            <td><img width="30" src="https://image.flaticon.com/icons/svg/265/265706.svg"></td>
                                            <td>Marcas</td>
                                            <td>20</td>
                                            <td><img width="20" src="https://image.flaticon.com/icons/svg/265/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/inventario/lineas');">
                                            <td><img width="30" src="https://image.flaticon.com/icons/svg/149/149023.svg"></td>
                                            <td>Líneas</td>
                                            <td>5</td>
                                            <td><img width="20" src="https://image.flaticon.com/icons/svg/265/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/documentos/documento');">
                                            <td><img width="30" src="https://image.flaticon.com/icons/png/512/272/272480.png"></td>
                                            <td>Factura Compra</td>
                                            <td>500</td>
                                            <td><img width="20" src="https://image.flaticon.com/icons/svg/265/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/documentos/documento');">
                                            <td><img width="30" src="https://image.flaticon.com/icons/svg/272/272429.svg"></td>
                                            <td>Remisión Compra</td>
                                            <td>200</td>
                                            <td><img width="20" src="https://image.flaticon.com/icons/svg/265/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/inventario/kits');">
                                            <td><img width="30" src="https://image.flaticon.com/icons/svg/340/340077.svg"></td>
                                            <td>Kits</td>
                                            <td>50</td>
                                            <td><img width="20" src="https://image.flaticon.com/icons/svg/265/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/documentos/documento');">
                                            <td><img width="30" src="https://www.flaticon.com/premium-icon/icons/svg/507/507887.svg"></td>
                                            <td>Pedido Compra</td>
                                            <td>30</td>
                                            <td><img width="20" src="https://image.flaticon.com/icons/svg/265/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/inventario/cierreInventario');">
                                            <td><img width="30" src="https://image.flaticon.com/icons/svg/138/138213.svg"></td>
                                            <td>Cierre de Inventario</td>
                                            <td>50</td>
                                            <td><img width="20" src="https://image.flaticon.com/icons/svg/265/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/inventario/ajustes');">
                                            <td><img width="30" src="https://image.flaticon.com/icons/svg/148/148912.svg"></td>
                                            <td>Ajustes de Entrada y Salida</td>
                                            <td>100</td>
                                            <td><img width="20" src="https://image.flaticon.com/icons/svg/265/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/inventario/catalogo');">
                                            <td><img width="30" src="https://www.flaticon.com/premium-icon/icons/svg/296/296383.svg"></td>
                                            <td>Catálogo</td>
                                            <td>1</td>
                                            <td><img width="20" src="https://image.flaticon.com/icons/svg/265/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/inventario/otros');">
                                            <td><img width="20" src="https://image.flaticon.com/icons/svg/424/424067.svg"></td>
                                            <td>Otros Documentos</td>
                                            <td>30</td>
                                            <td></td>
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
                            <i class="pe-7s-angle-left-circle"></i> <a href="#" onclick="config.Redirect('/layout');"> ir atras.</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection()