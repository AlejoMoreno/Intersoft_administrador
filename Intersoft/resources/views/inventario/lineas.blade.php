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
    .pregunta{
        background: black;
        color:white;
        font-size: 10px;
        padding:5px;
        border-radius: 100%;
        cursor: -webkit-grab; 
        cursor: grab;
    }
</style>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<div class="enc-article">
    <h4 class="title">Lineas / Grupos de productos</h4>
</div>

<div class="row top-5-w" style="padding:2%;">

    <div class="panel panel-default col-md-5" >
        <!-- Default panel contents -->
        <div class="panel-heading row"><h5>Lineas</h5></div>
        <div class="panel-body" >
            <p style="font-size: 10pt;">A contiuación se muestran en detalle cada una de las lineas creadas 
                para la empresa, junto con su respectiva parametrización contable.
            </p>
            <div style="overflow-x:scroll;">
                <table class="table table-hover table-striped" id="datos">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>retefuente porcentaje</th>
                            <th>v puc retefuente</th>
                            <th>c puc retefuente</th>
                            <th>reteiva porcentaje</th>
                            <th>v puc reteiva</th>
                            <th>c puc reteiva</th>
                            <th>reteica porcentaje</th>
                            <th>v puc reteica</th>
                            <th>c puc reteica</th>
                            <th>iva porcentaje</th>
                            <th>v puc iva</th>
                            <th>c puc iva</th>
                            <th></th> 
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lineas as $obj)
                            <tr id="row{{ $obj['id'] }}">
                                <td>{{ $obj['id'] }}</td>
                                <td>{{ $obj['nombre'] }}</td>
                                <td>{{ $obj['descripcion'] }}</td>
                                <td>{{ $obj['retefuente_porcentaje'] }}</td>
                                <td>{{ $obj['v_puc_retefuente']['codigo'] }} - {{ $obj['v_puc_retefuente']['descripcion'] }}</td>
                                <td>{{ $obj['c_puc_retefuente']['codigo'] }} - {{ $obj['c_puc_retefuente']['descripcion'] }}</td>
                                <td>{{ $obj['reteiva_porcentaje'] }}</td>
                                <td>{{ $obj['v_puc_reteiva']['codigo'] }} - {{ $obj['v_puc_reteiva']['descripcion'] }}</td>
                                <td>{{ $obj['c_puc_reteiva']['codigo'] }} - {{ $obj['c_puc_reteiva']['descripcion'] }}</td>
                                <td>{{ $obj['reteica_porcentaje'] }}</td>
                                <td>{{ $obj['v_puc_reteica']['codigo'] }} - {{ $obj['v_puc_reteica']['descripcion'] }}</td>
                                <td>{{ $obj['c_puc_reteica']['codigo'] }} - {{ $obj['c_puc_reteica']['descripcion'] }}</td>
                                <td>{{ $obj['iva_porcentaje'] }}</td>
                                <td>{{ $obj['v_puc_iva']['codigo'] }} - {{ $obj['v_puc_iva']['descripcion'] }}</td>
                                <td>{{ $obj['c_puc_iva']['codigo'] }} - {{ $obj['c_puc_iva']['descripcion'] }}</td>
                                <td><a href="javascript:;" onclick="lineas.update('{{ $obj }}');"><button class="btn btn-warning">></button></a></td>
                                <!--td><a onclick="config.delete_get('/inventario/lineas/delete/', '{{ $obj }}',  '/inventario/lineas');" href="#"><button class="btn btn-danger">x</button></a></td-->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-7 row">
        <div class="panel panel-warning col-md-12" >
            <!-- Default panel contents -->
            <div class="panel-heading row" >
                <h5 class="col-md-12">Formulario Lineas </h5>    
                <p>Para cada una de las lineas se debe realizar la parametrización contable</p>     
            </div>
            <div class="panel-body" style="overflow-x: scroll">
                <form action='/inventario/lineas/create' method="POST" name="formulario" id="formulario">
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Nombre </label><i class="fas fa-question pregunta" onclick="swal('Nombre que se asigna a la linea/grupo');"></i><br>
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Escribe el nombre" onkeyup="config.UperCase('nombre');">
                        </div>
                        <div class="col-md-4">
                            <label>Código interno</label><i class="fas fa-question pregunta" onclick="swal('Codigo interno para diferenciar uno del otro');"></i><br>
                            <input type="text" class="form-control" name="codigo_interno" id="codigo_interno" placeholder="Escribe el codigo_interno " value="NA" onkeyup="config.UperCase('codigo_interno');">
                        </div>
                        <div class="col-md-4">
                            <label>Código alterno</label><i class="fas fa-question pregunta" onclick="swal('Codigo homologo para integrar con otras herramientas');"></i><br>
                            <input type="text" class="form-control" name="codigo_alterno" id="codigo_alterno" placeholder="Escribe el codigo_alterno " value="NA" onkeyup="config.UperCase('codigo_alterno');">
                        </div>
                        <div class="col-md-12">
                            <label>Descripción</label><i class="fas fa-question pregunta" onclick="swal('Es la descripción de la linea, esta se muestra al momento de contratar carrito de compras con Intersoft.');"></i><br>
                            <textarea type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Escribe el descripcion" onkeyup="config.UperCase('descripcion');">NA</textarea>
                        </div>
                    </div>
                
                    <!-- Modal -->
                    <div id="paramcontable">
                        <div class="modal-dialog" style="width: 100%;">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"> Parametrización Contable </h4>
                                </div>
                                <div class="modal-body">
                                    <p>Indique a que cuentas contables iran los siguientes parametros, recuerde que cada producto ira con su linea de esto dependera la contabilización de la factura.</p>
                                    <div class="row">
                                        <div class="col-md-12"></div>
                                        <div class="col-md-4">
                                            <label>Retefuente</label><i class="fas fa-question pregunta" onclick="swal('Normalmente es un valor de 2.5, sin embargo esto cambia anualmente, Si esta linea no contribuye a la retención indicar 0');"></i>
                                            <input type="text" class="form-control" name="retefuente_porcentaje" id="retefuente_porcentaje" value="2.5" placeholder="(%)"> 
                                        </div>
                                        <div class="col-md-4">
                                            <label>Puc Venta</label><i class="fas fa-question pregunta" onclick="swal('La cuenta 135515, corresponde a la retención en Ventas');"></i>
                                            <select name="v_puc_retefuente" class="form-control" id="v_puc_retefuente"> 
                                                <option>Seleccione Cuenta</option>
                                                @foreach ( $cuentas as $cuenta )
                                                @if(strpos($cuenta->codigo, '135515') !== false)
                                                <option value="{{ $cuenta->id }}">{{ $cuenta->codigo }} - {{ $cuenta->descripcion }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Puc Compra</label><i class="fas fa-question pregunta" onclick="swal('La cuenta 236540, corresponde a la retención en Compras');"></i>
                                            <select name="c_puc_retefuente" class="form-control" id="c_puc_retefuente"> 
                                                <option>Seleccione Cuenta</option>
                                                @foreach ( $cuentas as $cuenta )
                                                @if(strpos($cuenta->codigo, '236540') !== false)
                                                <option value="{{ $cuenta->id }}">{{ $cuenta->codigo }} - {{ $cuenta->descripcion }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Reteiva</label><i class="fas fa-question pregunta" onclick="swal('Normalmente es 1.5, sin embargo esto cambia anualmente, Si esta linea no contribuye al Reteiva indicar 0');"></i>
                                            <input type="text" class="form-control" value="0" name="reteiva_porcentaje" id="reteiva_porcentaje" placeholder="(%)"> 
                                        </div>
                                        <div class="col-md-4">
                                            <label>Puc Venta</label><i class="fas fa-question pregunta" onclick="swal('La cuenta xxxx, corresponde al reteiva en Venta  ');"></i>
                                            <select name="v_puc_reteiva" class="form-control" id="v_puc_reteiva"> 
                                                <option>Seleccione Cuenta</option>
                                                @foreach ( $cuentas as $cuenta )
                                                <option value="{{ $cuenta->id }}">{{ $cuenta->codigo }} - {{ $cuenta->descripcion }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Puc Compra</label><i class="fas fa-question pregunta" onclick="swal('La cuenta xxxx, corresponde al reteiva en Compra ');"></i>
                                            <select name="c_puc_reteiva" class="form-control" id="c_puc_reteiva"> 
                                                <option>Seleccione Cuenta</option>
                                                @foreach ( $cuentas as $cuenta )
                                                <option value="{{ $cuenta->id }}">{{ $cuenta->codigo }} - {{ $cuenta->descripcion }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Reteica</label><i class="fas fa-question pregunta" onclick="swal('Normalmente es 1.5, sin embargo esto cambia anualmente, si esta linea no contribuye al reteica indeicar 0.');"></i>
                                            <input type="text" class="form-control" value="1.5" name="reteica_porcentaje" id="reteica_porcentaje" placeholder="(%)"> 
                                        </div>
                                        <div class="col-md-4">
                                            <label>Puc Venta</label><i class="fas fa-question pregunta" onclick="swal('La cuenta 135518, corresponde al reteiva en Venta ');"></i>
                                            <select name="v_puc_reteica" class="form-control" id="v_puc_reteica"> 
                                                <option>Seleccione Cuenta</option>
                                                @foreach ( $cuentas as $cuenta )
                                                @if(strpos($cuenta->codigo, '135518') !== false)
                                                <option value="{{ $cuenta->id }}">{{ $cuenta->codigo }} - {{ $cuenta->descripcion }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Puc Compra</label><i class="fas fa-question pregunta" onclick="swal('La cuenta 236801, corresponde al reteiva en Compra ');"></i>
                                            <select name="c_puc_reteica" class="form-control" id="c_puc_reteica"> 
                                                <option>Seleccione Cuenta</option>
                                                @foreach ( $cuentas as $cuenta )
                                                @if(strpos($cuenta->codigo, '236801') !== false)
                                                <option value="{{ $cuenta->id }}">{{ $cuenta->codigo }} - {{ $cuenta->descripcion }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Iva</label><i class="fas fa-question pregunta" onclick="swal('Normalmente es 19, sin embargo esto cambia dependiendo la referencia del producto, si esta linea no contribuye al reteica indeicar 0.');"></i>
                                            <input type="text" class="form-control" value="19" name="iva_porcentaje" id="iva_porcentaje" placeholder="(%)"> 
                                        </div>
                                        <div class="col-md-4">
                                            <label>Puc Venta</label><i class="fas fa-question pregunta" onclick="swal('La cuenta 240805, corresponde al reteiva en Venta, Dependerá del valor del iva que tenga la referencia del producto ');"></i>
                                            <select name="v_puc_iva" class="form-control" id="v_puc_iva"> 
                                                <option>Seleccione Cuenta</option>
                                                @foreach ( $cuentas as $cuenta )
                                                @if(strpos($cuenta->codigo, '240805') !== false)
                                                <option value="{{ $cuenta->id }}">{{ $cuenta->codigo }} - {{ $cuenta->descripcion }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Puc Compra</label><i class="fas fa-question pregunta" onclick="swal('La cuenta 240801, corresponde al reteiva en Compra, Dependerá del valor del iva que tenga la referencia del producto ');"></i>
                                            <select name="c_puc_iva" class="form-control" id="c_puc_iva"> 
                                                <option>Seleccione Cuenta</option>
                                                @foreach ( $cuentas as $cuenta )
                                                @if(strpos($cuenta->codigo, '240801') !== false)
                                                <option value="{{ $cuenta->id }}">{{ $cuenta->codigo }} - {{ $cuenta->descripcion }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                                <label>Puc Inventario Venta</label><i class="fas fa-question pregunta" onclick="swal('La cuenta 613595, corresponde a la cuenta inventario en Venta ');"></i>
                                                <select name="puc_venta" class="form-control" id="puc_venta"> 
                                                    <option>Seleccione Cuenta</option>
                                                    @foreach ( $cuentas as $cuenta )
                                                    @if(strpos($cuenta->codigo, '613595') !== false)
                                                    <option value="{{ $cuenta->id }}">{{ $cuenta->codigo }} - {{ $cuenta->descripcion }}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        <div class="col-md-6">
                                            <label>Puc Inventario Compra</label><i class="fas fa-question pregunta" onclick="swal('La cuenta 140505, corresponde a la cuenta inventario en Compra ');"></i>
                                            <select name="puc_compra" class="form-control" id="puc_compra"> 
                                                <option>Seleccione Cuenta</option>
                                                @foreach ( $cuentas as $cuenta )
                                                @if(strpos($cuenta->codigo, '140505') !== false)
                                                <option value="{{ $cuenta->id }}">{{ $cuenta->codigo }} - {{ $cuenta->descripcion }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <input type="submit" value="Guardar" id="btnguardar" class="btn btn-success form-control">
                <div id="actualizar" onclick="config.send_post('#formulario', '/inventario/lineas/update', '/inventario/lineas');" class="btn btn-warning form-control">Actualizar</div>
                </form>
            </div>
        </div>
    </div>

</div>




<script>
    $(document).ready( function () {
        $('#datos').DataTable( {
        } );
        
    } );
</script>
    

@endsection()