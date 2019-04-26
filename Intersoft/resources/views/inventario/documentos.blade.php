@extends('layout')

@section('content')


<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Documentos</h4>
                    <p class="category">Diferentes documentos</p><br>
                </div>
                <div class="content">
                    <div style="overflow-x:scroll;overflow-y:scroll;height:500px;">
                        <table class="table table-hover table-striped" id="datos">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>nombre</th>
									<th>signo</th>
                                    <th>ubicacion</th>
                                    <th>prefijo</th>
                                    <th>num_max</th>
                                    <th>num_min</th>
                                    <th>num_presente</th>
									<th>cta contable partida</th>
									<th>cta contable ontrapartida</th>
                                    <th></th> 
                                    <th></th> 
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($documentos as $obj)
                                    <tr id="row{{ $obj['id'] }}">
                                        <td>{{ $obj['id'] }}</td>
                                        <td>{{ $obj['nombre'] }}</td>
										<td>{{ $obj['signo'] }}</td>
                                        <td>{{ $obj['ubicacion'] }}</td>
                                        <td>{{ $obj['prefijo'] }}</td>
                                        <td>{{ $obj['num_max'] }}</td>
                                        <td>{{ $obj['num_min'] }}</td>
                                        <td>{{ $obj['num_presente'] }}</td>
										<td>{{ $obj['cuenta_contable_partida'] }}</td>
										<td>{{ $obj['cuenta_contable_contrapartida'] }}</td>
                                        <td><a href="javascript:;" onclick="documentos.update('{{ $obj }}');"><button class="btn btn-warning">></button></a></td>
                                        <td><a onclick="config.delete_get('/inventario/documentos/delete/', '{{ $obj }}',  '/inventario/documentos');" href="#"><button class="btn btn-danger">x</button></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <h4>Crear documentos</h4>
                    
                        <form action='/inventario/documentos/create' method="POST" name="formulario" id="formulario">
                            <input type="hidden" name="id" id="id">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Nombre</label><br>
                                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Escribe el nombre" required="" onkeyup="config.UperCase('nombre');">
                                </div>
                                <div class="col-md-3">
                                    <label>signo</label><br>
                                    <select class="form-control" name="signo" id="signo" required="" >
                                        <option value="">Seleccione Signo</option>
                                        <option value="+">+</option>
                                        <option value="-">-</option>
                                        <option value="=">=</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>ubicacion</label><br>
                                    <select class="form-control" name="ubicacion" id="ubicacion" required="" >
                                        <option value="">Seleccione ubicacion</option>
                                        <option value="ENTRADA">MENÚ ENTRADA</option>
                                        <option value="SALIDA">MENÚ SALIDA</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Prefijo</label>
                                    <input type="text" class="form-control" name="prefijo" id="prefijo" required="">
                                </div>
                                <div class="col-md-3">
                                    <label>Numeración Hasta</label>
                                    <input type="number" class="form-control" name="num_max" id="num_max" required="">
                                </div>
                                <div class="col-md-3">
                                    <label>Numeración Desde</label>
                                    <input type="number" class="form-control" name="num_min" id="num_min" required="">
                                </div>
                                <div class="col-md-3">
                                    <label>num_presente</label>
                                    <input type="number" class="form-control" name="num_presente" id="num_presente" required="">
                                </div>
                                <div class="col-md-3">
                                    <label> cuenta_contable_partida</label><br>
                                    <input type="text" class="form-control" name="cuenta_contable_partida" id="cuenta_contable_partida" placeholder="Escribe cuenta_contable_partida " required="" onkeyup="config.UperCase('cuenta_contable_partida');">
                                </div>
                                <div class="col-md-3">
                                    <label>cuenta_contable_contrapartida</label><br>
                                    <input type="text" class="form-control" name="cuenta_contable_contrapartida" id="cuenta_contable_contrapartida" placeholder="Escribe el cuenta_contable_contrapartida " required="" onkeyup="config.UperCase('cuenta_contable_contrapartida');">
                                </div>
                            </div>


                        <input type="submit" value="Guardar" id="btnguardar" class="btn btn-success form-control">
                        <div id="actualizar" onclick="config.send_post('#formulario', '/inventario/documentos/update', '/inventario/documentos');" class="btn btn-warning form-control">Actualizar</div>
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
a img{
    margin:20px;
}
</style>

@endsection()