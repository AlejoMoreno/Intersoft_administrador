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
    <h4 class="title">Referencias</h4>
</div>

<div class="row top-11-w" style="padding:2%;">
    <br><br>
    <p style="font-size:10pt;font-family:Poppins;margin-left:2%">Filtros de busqueda:</p>
    <div class="col-md-12"> 
        <div class="row">
            <div class="col-md-2">
                <p>Ordenar:</p>
                <select name="orden" id="orden" class="form-control">
                    <option value="codigo">Por Código</option>
                    <option value="nombre">Por Nombre</option>
                    <option value="codigo_linea">Por Linea</option>
                    <option value="id_marca">Por Marca</option>
                    <option value="costo">Por Costo</option>
                    <option value="saldo">Por Saldo</option>
                </select>
            </div>
            <div class="col-md-2">
                <p>Tipo Reporte:</p>
                <select name="tipo_reporte" id="tipo_reporte" class="form-control">
                    <option value="total">Total</option>
                    <option value="exitencia">Con Existencia</option>
                </select>
            </div>
            <div class="col-md-2">
                <p>Linea</p>
                <select name="linea" id="linea" class="form-control" multiple>
                    <option value="0">TODAS</option>
                    @foreach ($lineas as $linea)
                    <option value="{{ $linea->id }}">{{ $linea->id }} - {{ $linea->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-1">
                    <p>Observar</p>
                    <div onclick="referencias.observar()" style="width: 100%;background: white;" class="btn btn-info">(*)</div>    
                </div>
            <div class="col-md-3">
                <p>Descargar</p>
                <div onclick="referencias.envioExcel()" style="width: 45%;background: white;" class="btn btn-success">(EXCEL)</div>
                <div onclick="referencias.envioPDF()" style="width: 45%;background: white;" class="btn btn-danger">(PDF)</div>
            </div>
            <div class="col-md-2">
                    <p>Nueva Referencia</p>
                <div class="btn btn-success" style="background: white;" onclick="config.Redirect('/inventario/referencias');">(+) </div>
            </div>
            <div class="col-md-12"><br></div>
        </div>
    </div>


    <div class="panel panel-default col-md-5" >
        <!-- Default panel contents -->
        <div class="panel-heading row"><h5>Vista de usuarios</h5></div>
        <div class="panel-body" >
            <p style="font-size: 10pt;">A contiuación se describe la lista de usuarios, aqui usted puede realizar la actualización de cada uno de los usuarios con el boton <a href="javascript:;" ><button class="btn btn-warning">></button></a>.<br>
                Además podrá adicionar un usuario en el formulario que continua con la lista de usuarios.
            </p>
        </div>

        <!-- Table -->
        <div style="overflow-x:scroll;">
            <table class="table table-hover" id="tabla">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>descripcion</th>
                        <th>Código Barras</th>
                        <th>Presentación</th>
                        <th>Marca</th>
                        <th>peso</th>
                        <th>precio 1</th>
                        <th>precio 2</th>
                        <th>precio 3</th>
                        <th>precio 4</th>
                        <th>estado</th>
                        <th>Ultimo costo</th>
                        <th>costo promedio</th>
                        <th>saldo</th>
                        <th></th> 
                    </tr>
                </thead>
                <tbody>
                    @foreach ($referencias as $obj)
                        <tr id="row{{ $obj->id }}">
                            <td>{{ $obj->refcodigo_barras }}</td>
                            <td>{{ $obj->refdescripcion }}</td>
                            <td><small style="font-size: 9px;">{{ $obj->refcodigo_barras }}</small></td>
                            <td>{{ $obj->presnombre }}</td>
                            <td>{{ $obj->marcnombre }}</td>
                            <td>{{ $obj->refpeso }}</td>
                            <td>{{ number_format($obj->refprecio1, 0, ",", ".") }}</td>
                            <td>{{ number_format($obj->refprecio2, 0, ",", ".") }}</td>
                            <td>{{ number_format($obj->refprecio3, 0, ",", ".") }}</td>
                            <td>{{ number_format($obj->refprecio4, 0, ",", ".") }}</td>
                            <td>{{ $obj->estado }}</td>
                            <td>{{ number_format($obj->refcosto, 0, ",", ".") }}</td>
                            <td>{{ number_format($obj->refcosto_promedio, 0, ",", ".") }}</td>
                            <td>{{ number_format($obj->refsaldo, 0, ",", ".") }}</td>
                            <td><a href="javascript:;" onclick="referencias.update('{{json_encode($obj)}}');"><button class="btn btn-warning">></button></a></td>
                            <!--td><a onclick="referencias.delete_get('/inventario/referencias/delete/', '{{json_encode($obj)}}',  '/inventario/referencias');" href="#"><button class="btn btn-danger">x</button></a></td-->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-md-7 row">
        <div class="panel panel-warning col-md-12" >
            <form action='/inventario/referencias/create' method="POST" name="formulario" id="formulario">
                <div class="panel-heading row" >
                    <h5 class="col-md-4">Creación Referencias </h5>
                    <div class="col-md-8 row">
                        <input type="submit" value="Guardar" id="btnguardar" class="btn btn-success">
                        <div id="actualizar" onclick="config.send_post('#formulario', '/inventario/referencias/update', '/inventario/referencias');" class="btn btn-warning">Actualizar</div>
                        <div class="btn btn-danger" onclick="config.printDiv('crear');">Imprimir Ficha</div>
                    </div>                
                </div>
                <div class="panel-body" >
                    <p style="font-size: 10pt;">Diligencie cada uno de los datos relacionados con la referencia a crear.
                    Recordar que para el uso de decimales
                    es necesario delimitarlos con (.)
                    </p>
                </div>
            
                <input type="hidden" name="id" id="id">
                <div class="row">

                    <div class="col-md-12" >
                        <div>
                            <br>
                            <div class="panel-heading">
                                <h6>Datos 1</h6>
                            </div>
                            <div class="content">
                                
                                <label>código linea</label>
                                <select class="form-control" name="codigo_linea" id="codigo_linea" >
                                @foreach ($lineas as $obj)
                                    <option value="{{ $obj['id'] }}">{{ $obj['id']}} {{ $obj['nombre']}}</option>
                                @endforeach
                                </select>

                                <input type="hidden" class="form-control" name="codigo_letras" id="codigo_letras" placeholder="Escribe el codigo_letras" required="" maxlength="3" value="NAA" onkeyup="config.UperCase('codigo_letras');">

                                <input type="hidden" class="form-control" name="codigo_consecutivo" id="codigo_consecutivo" placeholder="Escribe el codigo_consecutivo" maxlength="3" required="" value="1" onkeyup="config.UperCase('codigo_consecutivo');">

                                <label>descripción</label><br>
                                <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Escribe el descripcion" required="" onkeyup="config.UperCase('descripcion');">

                                <label>código barras</label><br>
                                <input type="text" class="form-control" name="codigo_barras" id="codigo_barras" placeholder="Escribe el codigo_barras" required="" onkeyup="config.UperCase('codigo_barras');">

                                <div class="col-md-6">
                                    <label>código interno</label><br>
                                    <input type="text" class="form-control" name="codigo_interno" id="codigo_interno" placeholder="Escribe el codigo_interno" value="NA" onkeyup="config.UperCase('codigo_interno');">
                                </div>
                                <div class="col-md-6">
                                    <!--<label>código alterno</label><br>-->
                                    <input type="hidden" class="form-control" name="codigo_alterno" id="codigo_alterno" placeholder="Escribe el codigo_alterno" value="NA" onkeyup="config.UperCase('codigo_alterno');">
                                </div>

                                <div class="col-md-6">
                                    <label>presentación</label><br>
                                    <select class="form-control" name="id_presentacion" id="id_presentacion"> 
                                    @foreach ($presentaciones as $obj)
                                        <option value="{{ $obj['id'] }}">{{ $obj['nombre']}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label>peso</label><br>
                                    <input type="text" class="form-control" value="0" name="peso" id="peso" placeholder="Escribe el peso" required="" onkeyup="config.UperCase('peso');">
                                </div>
                                <label>Marca</label><br>
                                <select class="form-control" name="id_marca" id="id_marca">
                                @foreach ($marcas as $obj)
                                    <option value="{{ $obj['id'] }}">{{ $obj['nombre']}}</option>
                                @endforeach
                                </select>
                                
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12" >
                        <div>
                            <br>
                            <div class="panel-heading">
                                <h6>Datos 2</h6>
                            </div>
                            <div class="content">
                                <label>factor_rendimiento (%)</label><br>
                                <input type="text" class="form-control" name="factor_rendimiento" id="factor_rendimiento" maxlength="4" placeholder="Escribe el factor_rendimiento" value="0" required="" onkeyup="config.UperCase('factor_rendimiento');">
                                
                                <div class="col-md-6">
                                    <label>stok mínimo</label><br>
                                    <input type="text"  class="form-control" name="stok_minimo" id="stok_minimo" value="0" placeholder="Escribe el stok_minimo" required="" onkeyup="config.UperCase('stok_minimo');">
                                </div>
                                <div class="col-md-6">
                                    <label>stok máximo</label><br>
                                    <input type="text" class="form-control" name="stok_maximo" id="stok_maximo" value="1" placeholder="Escribe el stok_maximo" required="" onkeyup="config.UperCase('stok_maximo');">
                                </div>

                                <div class="col-md-6">
                                    <label>iva (%)</label><br>
                                    <input type="text" name="iva" id="iva"  class="form-control"  value="19">
                                </div>
                                <div class="col-md-6">
                                    <label>impo consumo (%)</label><br>
                                    <input type="text" value="0" maxlength="4" class="form-control" name="impo_consumo" id="impo_consumo" placeholder="Escribe el impo_consumo" required="" onkeyup="config.UperCase('impo_consumo');">
                                </div>

                                <div class="col-md-6">
                                    <label>sobre tasa (%)</label><br>
                                    <input type="text" maxlength="4" value="0" class="form-control" name="sobre_tasa" id="sobre_tasa" placeholder="Escribe el sobre_tasa" required="" onkeyup="config.UperCase('sobre_tasa');">
                                </div>
                                <div class="col-md-6">
                                    <label>descuento (%)</label><br>
                                    <input type="number" maxlength="4" value="0" class="form-control" name="descuento" id="descuento" placeholder="Escribe el descuento" required="" onkeyup="config.UperCase('descuento');">
                                </div>
                                <div class="col-md-6">
                                    <label>serie</label><br>
                                    <input type="text" value="NA" class="form-control" name="serie" id="serie" placeholder="Escribe el serie" required="" onkeyup="config.UperCase('serie');">
                                </div>
                                    <label>clasificacion</label><br>
                                    <select class="form-control" name="id_clasificacion" id="id_clasificacion">
                                    @foreach ($clasificaciones as $obj)
                                        <option value="{{ $obj['id'] }}">{{ $obj['nombre']}}</option>
                                    @endforeach
                                    </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12" >
                        <div>
                            <br>
                            <div class="panel-heading">
                                <h6>Datos 3</h6>
                            </div>
                            <div class="content">
                                
                                <div class="col-md-3">
                                    <label>precio1</label><br>
                                    <input type="text" class="form-control" value="0" name="precio1" id="precio1" placeholder="Escribe el precio1" required="" onkeyup="config.UperCase('precio1');">
                                </div>
                                <div class="col-md-3">
                                    <label>precio2</label><br>
                                    <input type="text" class="form-control" value="0" name="precio2" id="precio2" placeholder="Escribe el precio2" required="" onkeyup="config.UperCase('precio2');">
                                </div>
                                <div class="col-md-3">
                                    <label>precio3</label><br>
                                    <input type="text" class="form-control" value="0" name="precio3" id="precio3" placeholder="Escribe el precio3" required="" onkeyup="config.UperCase('precio3');">
                                </div>
                                <div class="col-md-3">
                                    <label>precio4</label><br>
                                    <input type="text" class="form-control" value="0" name="precio4" id="precio4" placeholder="Escribe el precio4" required="" onkeyup="config.UperCase('precio4');">
                                </div>

                                <label>estado</label><br>
                                <select class="form-control" name="estado" id="estado">
                                    <option value="ACTIVO">ACTIVO</option>
                                    <option value="INACTIVO">INACTIVO</option>
                                    <option value="SUSPENDIDO">SUSPENDIDO</option>
                                </select>

                                <label>hommologo</label><br>
                                <input type="text" class="form-control" name="hommologo" id="hommologo" placeholder="Escribe el hommologo" value="NA" required="" onkeyup="config.UperCase('hommologo');">

                                <div class="col-md-4">
                                    <label>costo</label><br>
                                    <input type="text" class="form-control" value="0" name="costo" id="costo" placeholder="Escribe el costo" required="" onkeyup="config.UperCase('costo');" disabled="">
                                </div>
                                <div class="col-md-4">
                                    <label>costo promedio</label><br>
                                    <input type="text" class="form-control" value="0" name="costo_promedio" id="costo_promedio" placeholder="Escribe el costo_promedio" required="" onkeyup="config.UperCase('costo_promedio');" disabled="">
                                </div>
                                <div class="col-md-4">
                                    <label>saldo</label><br>
                                    <input type="text" class="form-control" value="0" name="saldo" id="saldo" placeholder="Escribe el saldo" required="" onkeyup="config.UperCase('saldo');" disabled="">
                                </div>

                                <label>usuario creador</label><br>
                                <select class="form-control" name="usuario_creador" id="usuario_creador">
                                @foreach ($usuarios as $obj)
                                    <option value="{{ $obj['id'] }}">{{ $obj['nombre']}}</option>
                                @endforeach
                                </select>

                                <input  class="form-control" name="cuentaDB" id="cuentaDB" value="0" type="hidden">
                                
                                <input class="form-control" name="cuentaCR" id="cuentaCR" value="0" type="hidden"><br>

                                
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


</div>


<script>

$(document).ready(function() {
    usuarios.initial();
    var table = $('#tabla').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
});
referencias.initial( <?php echo json_encode($_GET); ?>);

</script>


@endsection()