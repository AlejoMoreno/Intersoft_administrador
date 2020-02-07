@extends('layout')

@section('content')


<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Tipo Pagos</h4>
                    <p class="category">Diferentes pagos</p><br>
                </div>
                <div class="content">
                    <div style="overflow-x:scroll;overflow-y:scroll;height:500px;">
                        <table class="table table-hover table-striped" id="datos">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre
                                    <th>Cuenta Contable</th>
                                    <th>Cuenta Descripción</th>
                                    <th>Nit</th>
                                    <th>Razon social</th>
                                    <th></th> 
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tipopagos as $obj)
                                    <tr id="row{{ $obj['id'] }}">
                                        <td>{{ $obj['id'] }}</td>
                                        <td>{{ $obj['nombre'] }}</td>
                                        <td>{{ $obj['puc_cuenta']['codigo'] }}</td>
                                        <td>{{ $obj['puc_cuenta']['descripcion'] }}</td>
                                        <td>{{ $obj['tercero']['nit'] }}</td>
                                        <td>{{ $obj['tercero']['razon_social'] }}</td>
                                        <td><a href="javascript:;" onclick="tipopagos.update('{{ $obj }}');"><button class="btn btn-warning">></button></a></td>
                                        <!--td><a onclick="config.delete_get('/inventario/tipo_presentaciones/delete/', '{{ $obj }}',  '/inventario/tipo_presentaciones');" href="#"><button class="btn btn-danger">x</button></a></td-->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <h4>Crear tipo pagos</h4>
                    
                        <form action='/administrador/tipopagos/create' method="POST" name="formulario" id="formulario">
                            <input type="hidden" name="id" id="id">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Nombre</label><br>
                                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Escribe el nombre" required="" onkeyup="config.UperCase('nombre');">
                                </div>
                                <div class="col-md-4">
                                    <label>Puc Cuenta</label><br>
                                    <select name="puc_cuenta" id="puc_cuenta" class="form-control">
                                        @foreach ($cuentas as $obj)
                                        <option value="{{ $obj['id'] }}">{{ $obj['codigo'] }} - {{ $obj['descripcion'] }}</option>        
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Tercero Nit</label><br>
                                    <input type="text" list="terceros" class="form-control" name="tercero" id="tercero" placeholder="Escribe la descrioción de esta clasificación" required="" onkeyup="config.UperCase('descripcion');">
                                    <datalist  id="terceros">
                                        @foreach ($terceros as $obj)
                                        <option value="{{ $obj['id'] }}"> {{ $obj['nit'] }} - {{ $obj['razon_social'] }}</option>
                                        @endforeach
                                    </datalist>
                                </div>
                            </div>


                        <input type="submit" value="Guardar" id="btnguardar" class="btn btn-success form-control">
                        <div id="actualizar" onclick="config.send_post('#formulario', '/administrador/tipopagos/update', '/administrador/tipopagos');" class="btn btn-warning form-control">Actualizar</div>
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