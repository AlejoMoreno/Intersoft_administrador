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
</style>


<div class="enc-article">
    <h4 class="title">Documentos entrada y salida de mercancía</h4>
</div>

<div class="row top-11-w" style="padding:2%;">

    <div class="panel panel-default col-md-5" >
        <!-- Default panel contents -->
        <div class="panel-heading row"><h5>Vista de documentos</h5></div>
        <div class="panel-body" >
            <p style="font-size: 10pt;">A contiuación se describe la lista de Diferentes documentos que intervienen con referencias.
            </p>
        </div>

        <!-- Table -->
        <div style="overflow-x:scroll;">
            <table class="table table-hover" id="tabla">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>nombre</th>
                        <th>signo</th>
                        <th>ubicacion</th>
                        <th>Documento Contable</th>
                        <th></th> 
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($documentos))
                        @foreach ($documentos as $obj)
                        <tr id="row{{ $obj['id'] }}">
                            <td>{{ $obj['id'] }}</td>
                            <td>{{ $obj['nombre'] }}</td>
                            <td>{{ $obj['signo'] }}</td>
                            <td>{{ $obj['ubicacion'] }}</td>
                            <td>{{ $obj['documento_contable'] }}</td>
                            <td><button type="button" class="btn btn-success" onclick="documentos.verResoluciones('{{ $obj }}')" data-toggle="modal" data-target="#myModal">Resolución</button></td>
                            <td><a href="javascript:;" onclick="documentos.update('{{ $obj }}');"><button class="btn btn-warning">></button></a></td>
                            <!--td><a onclick="config.delete_get('/inventario/documentos/delete/', '{{ $obj }}',  '/inventario/documentos');" href="#"><button class="btn btn-danger">x</button></a></td-->
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>


    <div class="col-md-7 row">
        <div class="panel panel-warning col-md-12" >
            <!-- Default panel contents -->
            <form action='/inventario/documentos/create' method="POST" name="formulario" id="formulario">
                <div class="panel-heading row" >
                    <h5 class="col-md-4">Creación Documento </h5>
                    <div class="col-md-8 row">
                        <button type="submit" id="btnguardar" class="btn btn-success col-md-3 btn-guardar"><i class="fas fa-save"></i> Guardar</button>
                        <div id="actualizar" onclick="config.send_post('#formulario', '/inventario/documentos/update', '/inventario/documentos');" class="btn btn-warning col-md-3 btn-actualizar"><i class="fas fa-pen-square"></i> Actualizar</div>
                        <div onclick="config.Redirect('/administrador/usuarios');" class="btn btn-danger col-md-3 btn-nuevo"><i class="fas fa-plus-circle"></i> Nuevo</div>
                    </div>                
                </div>
                <input type="hidden" name="id" id="id">
                <div class="row">
                    <br><br>
                    <div class="col-md-12">
                        <label>Nombre</label><br>
                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Escribe el nombre" required="" onkeyup="config.UperCase('nombre');">
                    </div>
                    <div class="col-md-6">
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
                            <option value="ENTRADA">FACTURACION</option>
                            <option value="SALIDA">INVENTARIO</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label> Documento contable</label><br>
                        <select class="form-control" name="documento_contable" id="documento_contable" >
                            <option value="0">(0) SIN CONTABILIZACIÓN</option>
                            <option value="3">(3) FACTURA VENTA</option>
                            <option value="4">(4) FACTURA COMPRA</option>
                            <option value="10">(10) NOTA CONTABLE</option>
                        </select>
                        <br><br>
                    </div>

                    <div class="col-md-12">
                        <input type="hidden" value="NA" class="form-control" name="prefijo" id="prefijo" required="">
                        <input type="hidden" value="0"  class="form-control" name="num_min" id="num_min" required="">
                        <input type="hidden" value="0"  class="form-control" name="num_max" id="num_max" required="">
                        <input type="hidden" value="0"  class="form-control" name="num_presente" id="num_presente" required="">
                        <input type="hidden" class="form-control" name="resolucion" id="resolucion" placeholder="Escribe la resolución, si no tiene resolución escriba NA" required="" onkeyup="config.UperCase('cuenta_contable_contrapartida');">
                        <input type="hidden" class="form-control" name="usuario" id="usuario" placeholder="Escribe el usuario">
                        <input type="hidden" class="form-control" name="password" id="password" placeholder="Escribe la contraseña" required="" onkeyup="config.UperCase('cuenta_contable_contrapartida');">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Resoluciones</h4>
                </div>
                <div class="modal-body">
                    <p>Estas son las resoluciones asingadas a este documento</p>
                    <input id="id_documento" type="hidden">
                    <div style="width: 100%;overflow-x: scroll;">
                        <table id="tableresoluciones" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>prefijo</th>
                                    <th>rango_inicio</th>
                                    <th>rango_final</th>
                                    <th>numero_presente</th>
                                    <th>fecha</th>
                                    <th>usuario_dian</th>
                                    <th>password_dian</th>
                                    <th></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Prefijo</label>
                            <input type="hidden" id="res_id">
                            <input id="res_prefijo" name="res_prefijo" class="form-control" placeholder="prefijo">
                        </div>
                        <div class="col-md-6">
                            <label>Fecha</label>
                            <input type="date" id="res_fecha" name="res_fecha" class="form-control" placeholder="fecha">
                        </div>
                        <div class="col-md-6">
                            <label>Número presente</label>
                            <input id="res_numero_presente" name="res_numero_presente" class="form-control" placeholder="Número presente">
                        </div>
                        <div class="col-md-6">
                            <label>Rango inicio</label>
                            <input type="number" id="res_rango_inicio" name="res_rango_inicio" class="form-control" placeholder="rango inicio">
                        </div>
                        <div class="col-md-6">
                            <label>Rango final</label>
                            <input type="number" id="res_rango_final" name="res_rango_final" class="form-control" placeholder="rango final">
                        </div>
                        <div class="col-md-6">
                            <label>Usuario DIAN</label>
                            <input id="res_usuario_dian" name="res_usuario_dian" class="form-control" placeholder="usuario dian">
                        </div>
                        <div class="col-md-6">
                            <label>Password DIAN</label>
                            <input id="res_password_dian" name="res_password_dian" class="form-control" placeholder="password dian">
                        </div>
                        <div class="col-md-12">
                            <br>
                            <div style="background: #3c763d;color:white;" class="form-control btn btn-success" onclick="documentos.sendResoluciones()">Guardar</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
</div>

<script>
$(document).ready(function() {
    var table = $('#tabla').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
});
</script>


@endsection()