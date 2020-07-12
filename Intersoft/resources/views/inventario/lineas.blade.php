@extends('layout')

@section('content')


<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Lineas</h4>
                    <p class="category">Diferentes lineas</p><br>
                </div>
                <div class="content">
                    <div style="overflow-x:scroll;overflow-y:scroll;height:500px;">
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
                                        <td>{{ $obj['v_puc_retefuente']['codigo'] }}</td>
                                        <td>{{ $obj['c_puc_retefuente']['codigo'] }}</td>
                                        <td>{{ $obj['reteiva_porcentaje'] }}</td>
                                        <td>{{ $obj['v_puc_reteiva']['codigo'] }}</td>
                                        <td>{{ $obj['c_puc_reteiva']['codigo'] }}</td>
                                        <td>{{ $obj['reteica_porcentaje'] }}</td>
                                        <td>{{ $obj['v_puc_reteica']['codigo'] }}</td>
                                        <td>{{ $obj['c_puc_reteica']['codigo'] }}</td>
                                        <td>{{ $obj['iva_porcentaje'] }}</td>
                                        <td>{{ $obj['v_puc_iva']['codigo'] }}</td>
                                        <td>{{ $obj['c_puc_iva']['codigo'] }}</td>
                                        <td><a href="javascript:;" onclick="lineas.update('{{ $obj }}');"><button class="btn btn-warning">></button></a></td>
                                        <!--td><a onclick="config.delete_get('/inventario/lineas/delete/', '{{ $obj }}',  '/inventario/lineas');" href="#"><button class="btn btn-danger">x</button></a></td-->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <h4>Crear lineas</h4>
                    
                        <form action='/inventario/lineas/create' method="POST" name="formulario" id="formulario">
                            <input type="hidden" name="id" id="id">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Nombre</label><br>
                                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Escribe el nombre" onkeyup="config.UperCase('nombre');">
                                </div>
                                <div class="col-md-3">
                                    <label>Descripción</label><br>
                                    <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Escribe el descripcion" onkeyup="config.UperCase('descripcion');">
                                </div>
                                <div class="col-md-3">
                                    <label>Código interno</label><br>
                                    <input type="text" class="form-control" name="codigo_interno" id="codigo_interno" placeholder="Escribe el codigo_interno " onkeyup="config.UperCase('codigo_interno');">
                                </div>
                                <div class="col-md-3">
                                    <label>Código alterno</label><br>
                                    <input type="text" class="form-control" name="codigo_alterno" id="codigo_alterno" placeholder="Escribe el codigo_alterno " onkeyup="config.UperCase('codigo_alterno');">
                                </div>
                            </div>
                        
                            <!-- Modal -->
                            <div class="modal fade" id="paramcontable" role="dialog">
                                <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Parametrización Contable</h4>
                                    </div>
                                    <div class="modal-body">
                                    <p>Indique a que cuentas contables iran los siguientes parametros, recuerde que cada producto ira con su linea de esto dependera la contabilización de la factura.</p>
                                    <div class="row">
                                        <div class="col-md-12"></div>
                                        <div class="col-md-4">
                                            <label>Retefuente</label>
                                            <input type="text" class="form-control" name="retefuente_porcentaje" id="retefuente_porcentaje" placeholder="(%)"> 
                                        </div>
                                        <div class="col-md-4">
                                            <label>Puc Venta</label>
                                            <select name="v_puc_retefuente" class="form-control" id="v_puc_retefuente"> 
                                                <option>Seleccione Cuenta</option>
                                                @foreach ( $cuentas as $cuenta )
                                                <option value="{{ $cuenta->id }}">{{ $cuenta->codigo }} - {{ $cuenta->descripcion }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Puc Compra</label>
                                            <select name="c_puc_retefuente" class="form-control" id="c_puc_retefuente"> 
                                                <option>Seleccione Cuenta</option>
                                                @foreach ( $cuentas as $cuenta )
                                                <option value="{{ $cuenta->id }}">{{ $cuenta->codigo }} - {{ $cuenta->descripcion }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Reteiva</label>
                                            <input type="text" class="form-control" name="reteiva_porcentaje" id="reteiva_porcentaje" placeholder="(%)"> 
                                        </div>
                                        <div class="col-md-4">
                                            <label>Puc Venta</label>
                                            <select name="v_puc_reteiva" class="form-control" id="v_puc_reteiva"> 
                                                <option>Seleccione Cuenta</option>
                                                @foreach ( $cuentas as $cuenta )
                                                <option value="{{ $cuenta->id }}">{{ $cuenta->codigo }} - {{ $cuenta->descripcion }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Puc Compra</label>
                                            <select name="c_puc_reteiva" class="form-control" id="c_puc_reteiva"> 
                                                <option>Seleccione Cuenta</option>
                                                @foreach ( $cuentas as $cuenta )
                                                <option value="{{ $cuenta->id }}">{{ $cuenta->codigo }} - {{ $cuenta->descripcion }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Reteica</label>
                                            <input type="text" class="form-control" name="reteica_porcentaje" id="reteica_porcentaje" placeholder="(%)"> 
                                        </div>
                                        <div class="col-md-4">
                                            <label>Puc Venta</label>
                                            <select name="v_puc_reteica" class="form-control" id="v_puc_reteica"> 
                                                <option>Seleccione Cuenta</option>
                                                @foreach ( $cuentas as $cuenta )
                                                <option value="{{ $cuenta->id }}">{{ $cuenta->codigo }} - {{ $cuenta->descripcion }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Puc Compra</label>
                                            <select name="c_puc_reteica" class="form-control" id="c_puc_reteica"> 
                                                <option>Seleccione Cuenta</option>
                                                @foreach ( $cuentas as $cuenta )
                                                <option value="{{ $cuenta->id }}">{{ $cuenta->codigo }} - {{ $cuenta->descripcion }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Iva</label>
                                            <input type="text" class="form-control" name="iva_porcentaje" id="iva_porcentaje" placeholder="(%)"> 
                                        </div>
                                        <div class="col-md-4">
                                            <label>Puc Venta</label>
                                            <select name="v_puc_iva" class="form-control" id="v_puc_iva"> 
                                                <option>Seleccione Cuenta</option>
                                                @foreach ( $cuentas as $cuenta )
                                                <option value="{{ $cuenta->id }}">{{ $cuenta->codigo }} - {{ $cuenta->descripcion }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Puc Compra</label>
                                            <select name="c_puc_iva" class="form-control" id="c_puc_iva"> 
                                                <option>Seleccione Cuenta</option>
                                                @foreach ( $cuentas as $cuenta )
                                                <option value="{{ $cuenta->id }}">{{ $cuenta->codigo }} - {{ $cuenta->descripcion }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                                <label>Puc Inventario Venta</label>
                                                <select name="puc_venta" class="form-control" id="puc_venta"> 
                                                    <option>Seleccione Cuenta</option>
                                                    @foreach ( $cuentas as $cuenta )
                                                    <option value="{{ $cuenta->id }}">{{ $cuenta->codigo }} - {{ $cuenta->descripcion }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        <div class="col-md-6">
                                            <label>Puc Inventario Compra</label>
                                            <select name="puc_compra" class="form-control" id="puc_compra"> 
                                                <option>Seleccione Cuenta</option>
                                                @foreach ( $cuentas as $cuenta )
                                                <option value="{{ $cuenta->id }}">{{ $cuenta->codigo }} - {{ $cuenta->descripcion }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                                
                                </div>
                            </div>
                        <button type="button" class="btn btn-info btn-lg form-control" data-toggle="modal" data-target="#paramcontable">Parametrización Contable</button><br><br>
                        <input type="submit" value="Guardar" id="btnguardar" class="btn btn-success form-control">
                        <div id="actualizar" onclick="config.send_post('#formulario', '/inventario/lineas/update', '/inventario/lineas');" class="btn btn-warning form-control">Actualizar</div>
                        </form>
                    <div id="resultado"></div>
                    <div class="footer">
                        <div class="legend">
                            <i class="fa fa-circle text-info"></i> 
                            <i class="fa fa-circle text-danger"></i> 
                            <i class="fa fa-circle text-warning"></i>
                        </div>
                        <hr>
                        <div class="stats">
                            <i class="pe-7s-angle-left-circle"></i> <a href="#" onclick="config.Redirect('/administrador/index');"> ir atras.</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>

</style>

@endsection()