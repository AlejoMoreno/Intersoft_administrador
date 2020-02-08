@extends('layout')

@section('content')


<div class="container-fluid">
    <div class="row">

        <div class="col-md-6">
            <div class="card">
                <div class="header">
                    <h4 class="title">Referencias</h4>
                    <p class="category">Buscar referencias</p><br>
                </div>
                <div class="content">
                    <form method="GET" action="/inventario/actualizacionPrecios">
                        <div class="row">
                            <div class="col-md-6">
                                <select name="codigo_linea" id="codigo_linea" class="form-control">
                                    <option value="0">Codigo linea</option>
                                    @foreach ($lineas as $obj)
                                    <option value="{{ $obj['id'] }}">{{ $obj['nombre'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select name="id_marca" id="id_marca" class="form-control">
                                    <option value="0">Marca</option>
                                    @foreach ($marcas as $obj)
                                    <option value="{{ $obj['id'] }}">{{ $obj['nombre'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select name="id_clasificacion" id="id_clasificacion" class="form-control">
                                    <option value="0">Clasificacion</option>
                                    @foreach ($clasificacion as $obj)
                                    <option value="{{ $obj['id'] }}">{{ $obj['nombre'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select name="estado" id="estado" class="form-control">
                                    <option value="0">Estado</option>
                                    <option value="ACTIVO">ACTIVO</option>
                                    <option value="INACTIVO">INACTIVO</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <input placeholder="descripcion" class="form-control" type="text" name="descripcion" id="descripcion">
                            </div>
                            <div class="col-md-6">
                                <input type="number" placeholder="saldo" class="form-control"  name="saldo" id="saldo">
                            </div>
                            <div class="col-md-12">
                                <input type="submit" value="Buscar" name="buscar" style="width: 100%" class="btn btn-success">
                            </div>
                        </div>
                    </form>
                    <div style="overflow-x:scroll;overflow-y:scroll;height:500px;">
                        <table class="table table-hover table-striped" id="datos">
                            <thead>
                                <tr>
                                    <th></th> 
                                    <th>codigo</th>
                                    <th>descripcion</th>
                                    <th>nombre</th>
                                    <th>precio1</th>
                                    <th>precio2</th>
                                    <th>precio3</th>
                                    <th>precio4</th>
                                    <th>estado</th>
                                    <th>costo</th>
                                    <th>saldo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $referencias as $ob)
                                <tr>
                                    <td><input id="obj_{{ $ob['id'] }}" type="checkbox" ></td> 
                                    <td>{{ $ob['codigo'] }}</td>
                                    <td>{{ $ob['descripcion'] }}</td>
                                    <td>{{ $ob['nombre'] }}</td>
                                    <td>{{ $ob['precio1'] }}</td>
                                    <td>{{ $ob['precio2'] }}</td>
                                    <td>{{ $ob['precio3'] }}</td>
                                    <td>{{ $ob['precio4'] }}</td>
                                    <td>{{ $ob['estado'] }}</td>
                                    <td>{{ $ob['costo'] }}</td>
                                    <td>{{ $ob['saldo'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                        
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

        <div class="col-md-6">
            <div class="card">
                <div class="header">
                    <h4>Actualizar Precios</h4>
                </div>
                <div class="content">
                    <form >
                        <div class="row">
                            <label class="col-md-6">Factor Rendimiento:</label>
                            <div class="col-md-6"><input class="form-control" placeholder="(%)" name="factor_rendimiento" id="factor_rendimiento"></div>
                            <div class="col-md-12"><button value="Buscar" name="buscar" style="width: 100%" class="btn btn-success">Buscar</button></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>

</style>

@endsection()